<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CyberSecurityGuard
{
    /**
     * Comprehensive list of Indonesian and International online gambling / slot / casino keywords.
     * Often used by automated judol bots to inject backdoors, SEO spam, and defacements.
     */
    protected static $judolKeywords = [
        // Slot & Judi Online terms
        'slot gacor', 'slot online', 'judi online', 'judi bola', 'togel online',
        'bandar togel', 'bandar judi', 'agen slot', 'agen judi', 'situs slot',
        'situs judi', 'link alternatif', 'daftar slot', 'login slot', 'rtp slot',
        'rtp live', 'bocoran slot', 'pola slot', 'pola gacor', 'jam gacor',
        'maxwin', 'anti rungkad', 'pasti menang', 'gampang menang', 'gampang maxwin',
        'scatter hitam', 'scatter emas', 'pragmatic play', 'gates of olympus',
        'kakek zeus', 'sweet bonanza', 'starlight princess', 'mahjong ways',
        'habanero', 'microgaming', 'spadegaming', 'joker123', 'pg soft',
        'sensational', 'jackpot paus', 'jackpot terbesar', 'depo pulsa',
        'depo tanpa potongan', 'bonus new member', 'bonus deposit', 'freebet',
        'garansi kekalahan', 'rollingan', 'cashback', 'turnover', 'to kecil',
        'live casino', 'roulette online', 'baccarat online', 'sicbo online',
        'dragon tiger', 'poker online', 'dominoqq', 'bandarq', 'capsa susun',
        'sabung ayam', 'sv388', 's128', 'sbobet', 'maxbet', 'cmd368',
        'slot88', 'slot777', 'mpo slot', 'nexus engine', 'infini88',
        'pay4d', 'hoki slot', 'raja slot', 'dewa slot', 'sultan slot',
        'ceme keliling', 'gaple online', 'tembak ikan', 'dingdong online',
        'totomacau', 'toto macau', 'singapore pools', 'hongkong pools',
        'sydney pools', 'togel singapore', 'togel hongkong', 'togel sydney',
        'angkakeramat', 'prediksi togel', 'bocoran togel', 'syair togel',
        'shio togel', 'colok jitu', 'colok bebas', '4d 3d 2d',
    ];

    /**
     * Suspicious spam / gambling link indicators
     */
    protected static $spamLinkPatterns = [
        '/https?:\/\/[^\s]+(\.xyz|\.top|\.vip|\.icu|\.buzz|\.bid|\.club|\.online|\.site|\.live|\.monster|\.rest|\.beauty|\.hair|\.cfd|\.lat)/i',
        '/https?:\/\/(t\.me|telegram\.me|wa\.me|api\.whatsapp\.com|bit\.ly|tinyurl\.com|s\.id|linktr\.ee)\/[a-z0-9_\-\.\/]+/i',
        '/href\s*=\s*["\'][^"\']*(slot|judi|gacor|zeus|olympus|maxwin|togel)[^"\']*["\']/i',
        '/\[url=[^\]]*(slot|judi|gacor|zeus|olympus|maxwin|togel)[^\]]*\]/i',
    ];

    /**
     * Comprehensive SQL Injection attack signatures
     */
    protected static $sqliSignatures = [
        // 1. Union-based SQL injection
        '/\bunion\s+(?:all\s+|distinct\s+)?select\b/i',

        // 2. Database schemas & system tables
        '/\b(information_schema|sys\.databases|sys\.tables|sys\.sysobjects)\b/i',
        '/\bselect\s+(?:schema_name|table_name|column_name)\b/i',

        // 3. Time-based blind SQL injection
        '/\b(sleep|pg_sleep)\s*\(\s*\d+\s*\)/i',
        '/\bbenchmark\s*\(\s*\d+\s*,/i',
        '/\bwaitfor\s+delay\s+[\'"]/i',

        // 4. File access & OS command execution
        '/\b(load_file|into\s+(?:out|dump)file)\b/i',
        '/\b(xp_cmdshell|exec\s+master\.\.xp_cmdshell)\b/i',

        // 5. Stacked SQL queries (drop, truncate, delete, update, insert)
        '/;\s*(?:drop\s+table|alter\s+table|truncate\s+table|delete\s+from|insert\s+into|update\s+\w+\s+set)\b/i',

        // 6. Error-based & XML injection functions
        '/\b(extractvalue|updatexml)\s*\(/i',

        // 7. Boolean-based tautologies (e.g. ' OR '1'='1', ' OR 'x'='x', OR 1=1, ' OR true)
        '/(?:[\'"])\s*(?:or|and)\s+[\'"]?([a-zA-Z0-9_-]+)[\'"]?\s*=\s*[\'"]?\1[\'"]?/i',
        '/\b(?:or|and)\s+1\s*=\s*1\b/i',
        '/(?:[\'"])\s*(?:or|and)\s+(?:true|false)\b/i',

        // 8. SQL comment evasions after quote / input break (e.g. admin'--, admin' #, admin'/*)
        '/(?:[\'"])\s*(?:--|#|\/\*)/',
        '/\/\*.*?\*\//s',
    ];

    /**
     * Cross-Site Scripting (XSS) & Code Execution signatures
     */
    protected static $xssSignatures = [
        '/<\s*script\b[^>]*>/i',
        '/<\/\s*script\s*>/i',
        '/javascript\s*:\s*/i',
        '/vbscript\s*:\s*/i',
        '/data\s*:\s*text\/html/i',
        '/on(load|error|click|focus|blur|mouseover|submit|keydown|keyup)\s*=/i',
        '/<\s*(iframe|embed|object|base|link|meta)\b/i',
        '/<\s*svg\b[^>]*\sonload\s*=/i',
        '/<\s*img\b[^>]*\sonerror\s*=/i',
        '/<\?php/i',
        '/<\?=/i',
        '/\b(eval|assert|passthru|shell_exec|system|base64_decode)\s*\(/i',
    ];

    /**
     * Check if text contains Judi Online / Gambling spam keywords.
     */
    public static function containsJudolSpam($text)
    {
        if (empty($text) || !is_string($text)) {
            return false;
        }

        $normalized = mb_strtolower($text, 'UTF-8');

        // Check against judol keyword dictionary
        foreach (self::$judolKeywords as $keyword) {
            if (mb_strpos($normalized, $keyword) !== false) {
                return $keyword;
            }
        }

        // Check against spam link patterns
        foreach (self::$spamLinkPatterns as $pattern) {
            if (preg_match($pattern, $text)) {
                return 'suspicious_link_pattern';
            }
        }

        return false;
    }

    /**
     * Check if input contains SQL Injection signatures.
     */
    public static function containsSqlInjection($text)
    {
        if (empty($text) || !is_string($text)) {
            return false;
        }

        foreach (self::$sqliSignatures as $pattern) {
            if (preg_match($pattern, $text)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if input contains XSS or Malicious Script signatures.
     */
    public static function containsMaliciousScript($text)
    {
        if (empty($text) || !is_string($text)) {
            return false;
        }

        foreach (self::$xssSignatures as $pattern) {
            if (preg_match($pattern, $text)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Thorough audit of an array of inputs (e.g. from contact form).
     * Returns array with [ 'safe' => bool, 'threat' => string|null, 'reason' => string|null ]
     */
    public static function inspectInputs(array $inputs)
    {
        foreach ($inputs as $key => $val) {
            if (is_array($val)) {
                $sub = self::inspectInputs($val);
                if (!$sub['safe']) {
                    return $sub;
                }
                continue;
            }

            if (!is_string($val)) {
                continue;
            }

            // 1. Check Judol spam
            if ($matchedJudol = self::containsJudolSpam($val)) {
                self::logThreat('JUDOL_SPAM', "Keyword '$matchedJudol' detected in field '$key'");
                return [
                    'safe' => false,
                    'threat' => 'JUDOL_SPAM',
                    'reason' => 'Pesan Anda terdeteksi mengandung indikasi spam judi online / tautan terlarang.'
                ];
            }

            // 2. Check SQL Injection
            if (self::containsSqlInjection($val)) {
                self::logThreat('SQL_INJECTION', "SQLi signature detected in field '$key'");
                return [
                    'safe' => false,
                    'threat' => 'SQL_INJECTION',
                    'reason' => 'Karakter tidak aman atau indikasi serangan injeksi terdeteksi.'
                ];
            }

            // 3. Check XSS / Code execution
            if (self::containsMaliciousScript($val)) {
                self::logThreat('XSS_SCRIPT', "XSS / Script signature detected in field '$key'");
                return [
                    'safe' => false,
                    'threat' => 'XSS_SCRIPT',
                    'reason' => 'Tag skrip atau kode berbahaya terdeteksi dan diblokir.'
                ];
            }
        }

        return ['safe' => true, 'threat' => null, 'reason' => null];
    }

    /**
     * Deep sanitize string to eliminate any potential stored XSS or HTML injection.
     */
    public static function sanitizeString($input)
    {
        if (is_null($input)) {
            return null;
        }
        // Strip tags then encode HTML special characters safely
        $clean = strip_tags((string) $input);
        return htmlspecialchars($clean, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Log cyber security events to dedicated security log file (storage/logs/security.log)
     * keeping laravel.log clean for application system errors only.
     */
    public static function logThreat($type, $details)
    {
        try {
            $ip = request()->ip() ?? 'UNKNOWN_IP';
            $url = request()->fullUrl() ?? 'UNKNOWN_URL';
            $ua = request()->header('User-Agent') ?? 'UNKNOWN_UA';
            $date = date('Y-m-d H:i:s');
            $line = "[{$date}] [CYBER_SECURITY_GUARD] Blocked {$type}: {$details} | IP: {$ip} | URL: {$url} | UA: {$ua}" . PHP_EOL;

            $logPath = storage_path('logs/security.log');
            @file_put_contents($logPath, $line, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $e) {
            // Silently suppress logging failures
        }
    }
}
