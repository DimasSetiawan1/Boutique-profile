<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class EmailVerifier
{
    /**
     * Common disposable / temporary email domains to reject.
     */
    protected static array $disposableDomains = [
        'mailinator.com', 'tempmail.com', '10minutemail.com', 'guerrillamail.com',
        'sharklasers.com', 'throwawaymail.com', 'yopmail.com', 'trashmail.com',
        'getairmail.com', 'dispostable.com', 'crazymailing.com'
    ];

    /**
     * Verify if an email is structurally valid and the mailbox actually exists.
     *
     * @param string $email
     * @return array ['valid' => bool, 'status' => string, 'badge' => string, 'message' => string]
     */
    public static function check(string $email): array
    {
        $email = trim(strtolower($email));

        if (empty($email)) {
            return [
                'valid' => false,
                'status' => 'empty',
                'badge' => '',
                'message' => '',
            ];
        }

        // 1. Basic format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_contains($email, '@')) {
            return [
                'valid' => false,
                'status' => 'invalid_format',
                'badge' => 'Format Tidak Valid',
                'message' => 'Format email tidak sesuai (contoh: nama@gmail.com).',
            ];
        }

        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return [
                'valid' => false,
                'status' => 'invalid_format',
                'badge' => 'Format Tidak Valid',
                'message' => 'Format email tidak sesuai.',
            ];
        }

        $username = $parts[0];
        $domain = $parts[1];

        if (empty($username) || empty($domain) || !str_contains($domain, '.') || strlen($domain) < 3) {
            return [
                'valid' => false,
                'status' => 'invalid_domain',
                'badge' => 'Email Tidak Sesuai',
                'message' => 'Domain email tidak lengkap atau tidak valid.',
            ];
        }

        // 2. Reject disposable / burner domains
        if (in_array($domain, self::$disposableDomains)) {
            return [
                'valid' => false,
                'status' => 'disposable',
                'badge' => 'Email Sementara / Dilarang',
                'message' => 'Email sementara/disposable tidak diperbolehkan. Harap gunakan email asli.',
            ];
        }

        // 3. Cache check (avoid repeatedly probing Gmail/Yahoo for the same email within 10 minutes)
        $cacheKey = 'email_verify_' . md5($email);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // 4. DNS MX lookup
        $mxRecords = [];
        if (!getmxrr($domain, $mxRecords) || empty($mxRecords)) {
            // Check fallback A record
            if (!checkdnsrr($domain, 'A')) {
                $res = [
                    'valid' => false,
                    'status' => 'no_mx',
                    'badge' => 'Domain Tidak Ditemukan',
                    'message' => 'Domain email ini tidak ditemukan atau tidak memiliki server email aktif.',
                ];
                Cache::put($cacheKey, $res, now()->addMinutes(10));
                return $res;
            }
            $mxRecords = [$domain];
        }

        // 5. Live SMTP Mailbox Probe (checks if user account exists on Gmail / Yahoo / server)
        $mailboxResult = self::probeSmtpMailbox($email, $mxRecords);

        if ($mailboxResult['exists'] === false) {
            $res = [
                'valid' => false,
                'status' => 'mailbox_not_found',
                'badge' => 'Email Tidak Terdaftar',
                'message' => 'Alamat email ini tidak terdaftar atau tidak ditemukan di ' . ucfirst($domain) . '. Harap gunakan email asli Anda.',
            ];
            Cache::put($cacheKey, $res, now()->addMinutes(10));
            return $res;
        }

        // If exists === true, or server doesn't support RCPT checking (catch-all or connection blocked)
        $res = [
            'valid' => true,
            'status' => 'valid',
            'badge' => 'Email Sesuai & Valid',
            'message' => 'Email ini aktif & terdaftar. Anda dapat mengirimkan pesan sekarang.',
        ];
        Cache::put($cacheKey, $res, now()->addMinutes(10));
        return $res;
    }

    /**
     * Probe SMTP server to see if recipient exists (RCPT TO check).
     */
    protected static function probeSmtpMailbox(string $email, array $mxRecords): array
    {
        // Try up to 2 MX hosts
        $hosts = array_slice($mxRecords, 0, 2);

        foreach ($hosts as $host) {
            $errno = 0;
            $errstr = '';
            $socket = @fsockopen($host, 25, $errno, $errstr, 3);

            if (!$socket) {
                continue;
            }

            stream_set_timeout($socket, 4);

            $greeting = fgets($socket, 1024);
            if (!$greeting || substr($greeting, 0, 3) !== '220') {
                fclose($socket);
                continue;
            }

            fputs($socket, "HELO check.boutiquedesign.id\r\n");
            $heloResp = fgets($socket, 1024);

            fputs($socket, "MAIL FROM: <verify@boutiquedesign.id>\r\n");
            $mailResp = fgets($socket, 1024);

            fputs($socket, "RCPT TO: <$email>\r\n");
            $rcptResp = fgets($socket, 1024);

            fputs($socket, "QUIT\r\n");
            fclose($socket);

            $rcptCode = substr((string)$rcptResp, 0, 3);

            // 550, 551, 553 means user doesn't exist / mailbox not found
            if ($rcptCode === '550' || $rcptCode === '551' || $rcptCode === '553' || 
                stripos($rcptResp, 'does not exist') !== false ||
                stripos($rcptResp, 'user unknown') !== false ||
                stripos($rcptResp, 'invalid recipient') !== false ||
                stripos($rcptResp, 'no such user') !== false) {
                return ['exists' => false, 'detail' => trim((string)$rcptResp)];
            }

            // 250 means recipient OK
            if ($rcptCode === '250') {
                return ['exists' => true, 'detail' => 'OK'];
            }
        }

        // If port 25 failed or server allows catch-all/deferred check, default to valid
        return ['exists' => true, 'detail' => 'Fallback MX OK'];
    }
}
