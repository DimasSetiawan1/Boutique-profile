<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use App\Services\CyberSecurityGuard;

class SecurityVerificationController extends Controller
{
    /**
     * Tampilkan Halaman Verifikasi Keamanan Pengunjung Asli (Human Verification)
     */
    public function showVerification(Request $request)
    {
        // Jika pengunjung sudah terverifikasi secara sah, langsung arahkan ke tujuan
        if ($this->isVerified($request)) {
            $redirectUrl = session('security_intended_url', route('home'));
            session()->forget('security_intended_url');
            return redirect($redirectUrl);
        }

        // Generate cryptographic one-time token dengan nonce, IP, dan timestamp
        $timestamp = time();
        $nonce = bin2hex(random_bytes(16));
        $uaHash = substr(hash('sha256', (string) $request->header('User-Agent')), 0, 16);
        
        $payload = implode('|', [
            $timestamp,
            $request->ip(),
            $uaHash,
            $nonce,
            config('app.key')
        ]);

        $verificationToken = Crypt::encryptString($payload);

        $settings = Setting::pluck('value', 'key')->toArray();

        return view('security.verification', [
            'verificationToken' => $verificationToken,
            'settings'          => $settings,
            'intendedUrl'       => session('security_intended_url', route('home')),
        ]);
    }

    /**
     * Proses Validasi Nyata (Real Human Verification Engine)
     */
    public function verifyHuman(Request $request)
    {
        $token = $request->input('verification_token') ?: $request->input('challenge_token');
        $botTrap = $request->input('bot_trap'); // Field honeypot tersembunyi
        $entropy = $request->input('entropy', []);

        // 1. Jebakan Bot / Honeypot: Bot otomatis selalu mengisi semua input yang ada di DOM
        if (!empty($botTrap)) {
            CyberSecurityGuard::logThreat('HONEYPOT_BOT', 'Bot terdeteksi mengisi hidden trap field.');
            return response()->json([
                'success' => false,
                'message' => 'Aktivitas bot otomatis terdeteksi dan diblokir.'
            ], 403);
        }

        // 2. Validasi Ketersediaan Token
        if (empty($token)) {
            return response()->json([
                'success' => false,
                'message' => 'Token verifikasi keamanan tidak ditemukan.'
            ], 400);
        }

        try {
            // Dekripsi payload keamanan
            $decrypted = Crypt::decryptString($token);
            $parts = explode('|', $decrypted);

            if (count($parts) < 5) {
                return response()->json(['success' => false, 'message' => 'Struktur token tidak valid.'], 400);
            }

            [$tokenTime, $tokenIp, $tokenUaHash, $nonce, $appKey] = $parts;
            $tokenTime = (int) $tokenTime;

            // 3. Validasi Masa Berlaku Token (Maksimal 10 menit untuk mencegah token reusing)
            $tokenAge = time() - $tokenTime;
            if ($tokenAge < 0 || $tokenAge > 600) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi verifikasi telah kedaluwarsa. Silakan muat ulang halaman.'
                ], 410);
            }

            // 4. Cegah Replay Attack (Satu token hanya boleh digunakan 1 kali)
            $cacheKey = 'used_sec_nonce_' . $nonce;
            if (Cache::has($cacheKey)) {
                CyberSecurityGuard::logThreat('REPLAY_ATTACK', 'Token verifikasi digunakan ulang (replay attempt).');
                return response()->json([
                    'success' => false,
                    'message' => 'Token verifikasi telah digunakan sebelumnya.'
                ], 403);
            }
            Cache::put($cacheKey, true, 600);

            // 5. Validasi Integritas IP & User-Agent (Mencegah pencurian token)
            $currentUaHash = substr(hash('sha256', (string) $request->header('User-Agent')), 0, 16);
            if ($tokenIp !== $request->ip() || $tokenUaHash !== $currentUaHash) {
                CyberSecurityGuard::logThreat('IP_UA_MISMATCH', 'Ketidakcocokan identitas jaringan saat verifikasi.');
                return response()->json([
                    'success' => false,
                    'message' => 'Ketidakcocokan identitas peramban atau jaringan.'
                ], 403);
            }

            // 6. Deteksi Headless Browser & Automated Puppeteer / Selenium Bot
            $isWebdriver = !empty($entropy['webdriver']);
            if ($isWebdriver) {
                CyberSecurityGuard::logThreat('HEADLESS_BOT', 'Headless browser automation (navigator.webdriver) terdeteksi.');
                return response()->json([
                    'success' => false,
                    'message' => 'Peramban otomatis / bot scripting terdeteksi.'
                ], 403);
            }

            // 7. Time-Gate Validation: Manusia normal butuh minimal 600ms untuk melihat dan mengeklik
            $clientElapsed = (int) ($entropy['elapsed'] ?? 0);
            if ($clientElapsed < 500 && $tokenAge < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Respons terlalu cepat. Harap tunggu sesaat dan klik kembali.'
                ], 429);
            }

            // 8. Sukses: Tetapkan status verified pada Session
            session([
                'human_verified'    => true,
                'human_verified_at' => now()->timestamp,
            ]);

            // 9. Terbitkan Secure Cookie bertanda tangan (Valid selama 24 jam)
            $cookiePayload = Crypt::encryptString(implode('|', [
                now()->timestamp,
                $request->ip(),
                $currentUaHash
            ]));

            // Cookie berlaku 1440 menit (24 jam), HttpOnly untuk perlindungan maksimal dari XSS
            $cookie = Cookie::make('b_human_pass', $cookiePayload, 1440, '/', null, false, true, false, 'Lax');

            $destination = session('security_intended_url', route('home'));
            session()->forget('security_intended_url');

            return response()->json([
                'success'  => true,
                'redirect' => $destination,
                'message'  => 'Verifikasi berhasil! Mengalihkan ke situs...'
            ])->withCookie($cookie);

        } catch (\Exception $e) {
            CyberSecurityGuard::logThreat('VERIFY_EXCEPTION', 'Exception during verification: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memverifikasi token keamanan.'
            ], 400);
        }
    }

    /**
     * Helper untuk memeriksa apakah pengunjung sudah terverifikasi secara valid
     */
    public static function isVerified(Request $request): bool
    {
        // 1. Cek Sesi Aktif
        if (session('human_verified') === true) {
            $verifiedAt = (int) session('human_verified_at', 0);
            if ((now()->timestamp - $verifiedAt) < 86400) {
                return true;
            }
        }

        // 2. Cek Cookie Terenkripsi (Jika pengunjung kembali setelah menutup browser)
        $cookie = $request->cookie('b_human_pass') ?: $request->cookie('b_shield_pass');
        if (!empty($cookie)) {
            try {
                $decrypted = Crypt::decryptString($cookie);
                $parts = explode('|', $decrypted);
                if (count($parts) >= 2) {
                    $cTime = (int) $parts[0];
                    $cIp = $parts[1];
                    
                    // Pastikan IP dan masa berlaku (24 jam) sesuai
                    if ($cIp === $request->ip() && (now()->timestamp - $cTime) < 86400) {
                        // Re-hydrate session
                        session([
                            'human_verified'    => true,
                            'human_verified_at' => $cTime
                        ]);
                        return true;
                    }
                }
            } catch (\Exception $e) {
                // Abaikan jika cookie dimanipulasi
            }
        }

        return false;
    }
}
