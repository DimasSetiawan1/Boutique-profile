<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Mail\SendAdminOtpMail;
use App\Services\CyberSecurityGuard;

class LoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Check if email is valid and registered in system (AJAX for live indicator).
     */
    public function checkEmail(Request $request)
    {
        $email = trim((string) $request->input('email', ''));

        // Anti SQL Injection Check
        if (CyberSecurityGuard::containsSqlInjection($email)) {
            CyberSecurityGuard::logThreat('SQL_INJECTION', "Admin checkEmail SQLi attempt: {$email}");
            return response()->json([
                'status' => 'blocked',
                'registered' => false,
                'badge' => 'Serangan Terdeteksi',
                'message' => 'Input mengandung karakter SQL Injection terlarang. Akses diblokir demi keamanan.',
            ], 403);
        }

        if (empty($email)) {
            return response()->json([
                'status' => 'empty',
                'registered' => false,
                'message' => '',
            ]);
        }

        // Validate basic email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status' => 'invalid_format',
                'registered' => false,
                'badge' => 'Format tidak valid',
                'message' => 'Format email ini tidak sesuai (contoh: nama@gmail.com).',
            ]);
        }

        $exists = User::where('email', $email)->exists();

        if ($exists) {
            return response()->json([
                'status' => 'valid',
                'registered' => true,
                'badge' => 'Sesuai / Terdaftar',
                'message' => 'Email ini sesuai & telah terdaftar sebagai admin.',
            ]);
        } else {
            return response()->json([
                'status' => 'not_found',
                'registered' => false,
                'badge' => 'Tidak sesuai / Belum terdaftar',
                'message' => 'Email ini tidak sesuai atau tidak pernah terdaftar di sistem.',
            ]);
        }
    }

    /**
     * Handle authentication attempt.
     * - Akun baru (email_verified_at masih null): Wajib verifikasi kode OTP email untuk aktivasi!
     * - Akun yang sudah terverifikasi: Langsung masuk ke dashboard (cepat dan praktis).
     */
    public function login(Request $request)
    {
        $email = strtolower(trim((string) $request->input('email', '')));

        // Anti SQL Injection Check
        if (CyberSecurityGuard::containsSqlInjection($email)) {
            CyberSecurityGuard::logThreat('SQL_INJECTION', "Admin login SQLi attempt: {$email}");
            return back()->withErrors([
                'email' => 'Upaya injeksi SQL terdeteksi dan diblokir secara otomatis oleh sistem keamanan.',
            ])->onlyInput('email');
        }

        $lockoutKey = 'admin_lockout_' . md5($email);
        $attemptsKey = 'login_failed_attempts_' . md5($email);
        $tierKey = 'admin_lockout_tier_' . md5($email);
        $requiresOtpKey = 'admin_requires_otp_' . md5($email);

        $currentTier = (int) Cache::get($tierKey, 1);
        if ($currentTier < 1) $currentTier = 1;

        // Skema Tingkat Keamanan (Tier):
        // Tier 1: 3x salah -> blokir 1 menit (60 detik)
        // Tier 2: 3x salah lagi tanpa verifikasi OTP -> blokir 5 menit (300 detik)
        // Tier 3: 3x salah lagi / mencoba masuk tanpa OTP -> blokir 1 jam (3600 detik)
        if ($currentTier === 1) {
            $lockoutSeconds = 60;
            $lockoutDesc = '1 menit';
            $nextTier = 2;
        } elseif ($currentTier === 2) {
            $lockoutSeconds = 300;
            $lockoutDesc = '5 menit';
            $nextTier = 3;
        } else {
            $lockoutSeconds = 3600;
            $lockoutDesc = '1 jam';
            $nextTier = 3; // Tetap di batas maksimal 1 jam
        }

        // 1. Periksa apakah akun sedang dalam masa blokir aktif
        if (Cache::has($lockoutKey)) {
            $lockoutUntil = (int) Cache::get($lockoutKey);
            $remaining = max(1, $lockoutUntil - time());

            if ($remaining >= 3600) {
                $hours = floor($remaining / 3600);
                $mins = ceil(($remaining % 3600) / 60);
                $timeText = "{$hours} jam {$mins} menit";
            } elseif ($remaining >= 60) {
                $mins = ceil($remaining / 60);
                $timeText = "{$mins} menit";
            } else {
                $timeText = "{$remaining} detik";
            }

            return back()->withErrors([
                'email' => "Akses sementara diblokir selama {$timeText} ({$remaining} detik) karena kesalahan login berulang. Anda harus menunggu hingga waktu blokir berakhir sebelum kode OTP dikirimkan ke Gmail.",
            ])->onlyInput('email')->with('lockout_seconds', $remaining);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah akun sedang diwajibkan verifikasi OTP dari insiden blokir sebelumnya
        $requiresOtp = Cache::get($requiresOtpKey, false);

        // 2. Jika email tidak terdaftar atau password salah
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            $attempts = (int) Cache::get($attemptsKey, 0) + 1;
            Cache::put($attemptsKey, $attempts, now()->addHours(24));

            // Jika mencapai 3 kali kesalahan pada tier saat ini
            if ($attempts >= 3) {
                $lockoutUntil = now()->addSeconds($lockoutSeconds)->timestamp;
                Cache::put($lockoutKey, $lockoutUntil, now()->addSeconds($lockoutSeconds));
                Cache::put($tierKey, $nextTier, now()->addHours(24));
                Cache::forget($attemptsKey);
                Cache::put($requiresOtpKey, true, now()->addHours(24));

                if ($user) {
                    // Sesuai aturan: Sebelum waktu blokir selesai, kode OTP belum dikirim ke Gmail.
                    // Pengguna harus menunggu waktu blokir selesai, baru kode OTP langsung dikirim ke Gmail.
                    $user->otp_code = null;
                    $user->otp_expires_at = null;
                    $user->save();

                    session([
                        'reset_user_id' => $user->id,
                        'reset_email' => $user->email,
                        'security_lockout_until' => $lockoutUntil,
                        'lockout_duration' => $lockoutSeconds,
                        'lockout_tier' => $currentTier,
                        'lockout_reason' => '3x_wrong_password',
                        'lockout_otp_sent' => false,
                    ]);

                    $tierTitles = [
                        1 => 'Peringatan Keamanan (Tingkat 1)',
                        2 => 'Peringatan Keamanan (Tingkat 2)',
                        3 => 'Peringatan Keamanan Maksimal (Tingkat 3)',
                    ];
                    $title = $tierTitles[$currentTier] ?? 'Peringatan Keamanan';

                    return redirect()->route('admin.password.otp.form')
                        ->with('warning', "{$title}: Terdeteksi 3x salah memasukkan kata sandi! Akses akun diblokir sementara selama {$lockoutDesc}. Kode OTP dari Gmail belum dikirimkan — Anda harus menunggu hingga hitungan mundur selesai terlebih dahulu, baru kode OTP akan langsung dikirim otomatis ke Gmail Anda.");
                }

                return back()->withErrors([
                    'email' => "Akses diblokir selama {$lockoutDesc} karena 3 kali kesalahan login.",
                ])->onlyInput('email');
            }

            $remainingAttempts = 3 - $attempts;
            return back()->withErrors([
                'email' => "Email atau kata sandi yang Anda masukkan salah. Percobaan tersisa: {$remainingAttempts} kali sebelum akses diblokir {$lockoutDesc}.",
            ])->onlyInput('email');
        }

        // 3. Password benar:
        // Jika akun mewajibkan verifikasi OTP dari insiden sebelumnya, cegah bypass login!
        if ($requiresOtp) {
            session([
                'reset_user_id' => $user->id,
                'reset_email' => $user->email,
            ]);
            return redirect()->route('admin.password.otp.form')
                ->with('warning', 'Akun Anda sedang dalam status pengamanan setelah kesalahan login sebelumnya. Anda wajib menyelesaikan verifikasi kode OTP dari Gmail untuk melanjutkan.');
        }

        // Jika lolos semua pemeriksaan: Bersihkan catatan kegagalan & tier
        Cache::forget($attemptsKey);
        Cache::forget($lockoutKey);
        Cache::forget($tierKey);
        Cache::forget($requiresOtpKey);

        // Jika AKUN BARU (belum pernah diverifikasi), wajib verifikasi OTP email!
        if (is_null($user->email_verified_at)) {
            // Periksa apakah sudah ada OTP aktif yang belum kadaluarsa
            $hasValidOtp = !empty($user->otp_code) && $user->otp_expires_at && now()->lessThanOrEqualTo($user->otp_expires_at);

            if (!$hasValidOtp) {
                $otp = sprintf("%06d", mt_rand(100000, 999999));
                $user->otp_code = $otp;
                $user->otp_expires_at = now()->addMinutes(15);
                $user->save();

                try {
                    Mail::to($user->email)->send(new SendAdminOtpMail($otp, $user->name, 'aktivasi akun admin baru', 'Kode OTP Aktivasi Akun Admin Baru - Boutique Design'));
                } catch (\Exception $e) {
                    Log::error('Error sending new account OTP email: ' . $e->getMessage());
                }
            }

            session([
                'new_account_otp_user_id' => $user->id,
                'new_account_otp_email' => $user->email,
                'new_account_otp_remember' => $request->has('remember'),
            ]);

            return redirect()->route('admin.account.otp.form')
                ->with('success', 'Akun baru terdeteksi! Kode OTP 6-digit telah dikirim ke ' . $user->email . ' untuk aktivasi akun.');
        }

        // Akun lama yang sudah terverifikasi -> langsung masuk ke dashboard
        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))
                         ->with('success', 'Selamat datang kembali di Dashboard Admin!');
    }

    /**
     * Show form to verify OTP for new account.
     */
    public function showNewAccountOtpForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        if (!session()->has('new_account_otp_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Sesi verifikasi telah berakhir. Silakan login kembali.');
        }

        return view('admin.auth.new_account_otp');
    }

    /**
     * Verify OTP for new account activation.
     */
    public function verifyNewAccountOtp(Request $request)
    {
        // Bersihkan input OTP dari spasi, strip, atau karakter non-angka
        $cleanOtp = preg_replace('/\D/', '', (string) $request->input('otp', ''));
        $request->merge(['otp' => $cleanOtp]);

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ], [
            'otp.required' => 'Masukkan 6 digit kode OTP.',
            'otp.size' => 'Kode OTP harus tepat 6 digit angka.',
        ]);

        if (!session()->has('new_account_otp_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Sesi verifikasi telah berakhir.');
        }

        $user = User::find(session('new_account_otp_user_id'));

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Pengguna tidak ditemukan.');
        }

        $savedOtp = trim((string) $user->otp_code);

        $otpAttemptsKey = 'new_acc_otp_attempts_' . md5(strtolower($user->email));
        $otpTierKey = 'new_acc_otp_tier_' . md5(strtolower($user->email));

        if (empty($savedOtp) || $cleanOtp !== $savedOtp) {
            $otpAttempts = (int) Cache::get($otpAttemptsKey, 0) + 1;
            Cache::put($otpAttemptsKey, $otpAttempts, now()->addHours(24));

            $currentOtpTier = (int) Cache::get($otpTierKey, 1);
            if ($currentOtpTier < 1) $currentOtpTier = 1;

            if ($currentOtpTier === 1) {
                $lockoutSeconds = 60; // 1 menit
                $lockoutDesc = '1 menit';
                $nextOtpTier = 2;
            } elseif ($currentOtpTier === 2) {
                $lockoutSeconds = 300; // 5 menit
                $lockoutDesc = '5 menit';
                $nextOtpTier = 3;
            } else {
                $lockoutSeconds = 3600; // 1 jam
                $lockoutDesc = '1 jam';
                $nextOtpTier = 3;
            }

            // Jika mencapai 3 kali salah memasukkan kode OTP
            if ($otpAttempts >= 3) {
                $lockoutUntil = now()->addSeconds($lockoutSeconds)->timestamp;
                Cache::put('admin_lockout_' . md5(strtolower($user->email)), $lockoutUntil, now()->addSeconds($lockoutSeconds));
                Cache::put($otpTierKey, $nextOtpTier, now()->addHours(24));
                Cache::forget($otpAttemptsKey);

                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->save();

                session([
                    'security_lockout_until' => $lockoutUntil,
                    'lockout_duration' => $lockoutSeconds,
                    'lockout_tier' => $currentOtpTier,
                    'lockout_reason' => '3x_wrong_otp',
                    'lockout_otp_sent' => false,
                ]);

                return back()->withErrors([
                    'otp' => "Anda telah 3 kali salah memasukkan kode OTP! Akses verifikasi diblokir selama {$lockoutDesc}. Kode OTP baru akan dikirimkan otomatis setelah waktu blokir berakhir.",
                ])->with('warning', "Peringatan Keamanan OTP: Terdeteksi 3x salah kode OTP! Verifikasi diblokir selama {$lockoutDesc}.");
            }

            $remainingAttempts = 3 - $otpAttempts;
            return back()->withErrors([
                'otp' => "Kode OTP yang Anda masukkan salah. Percobaan tersisa: {$remainingAttempts} kali sebelum verifikasi diblokir {$lockoutDesc}.",
            ]);
        }

        if (!$user->otp_expires_at || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan klik "Kirim Ulang".']);
        }

        // Aktivasi akun baru!
        $user->email_verified_at = now();
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        Cache::forget($otpAttemptsKey);
        Cache::forget($otpTierKey);

        $remember = session('new_account_otp_remember', false);
        session()->forget(['new_account_otp_user_id', 'new_account_otp_email', 'new_account_otp_remember']);

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))
                         ->with('success', 'Akun Anda berhasil diverifikasi dan diaktifkan! Selamat datang di Panel Admin, ' . $user->name . '.');
    }

    /**
     * Resend OTP for new account.
     */
    public function resendNewAccountOtp()
    {
        if (!session()->has('new_account_otp_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Sesi verifikasi telah berakhir.');
        }

        $user = User::find(session('new_account_otp_user_id'));

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Pengguna tidak ditemukan.');
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        try {
            Mail::to($user->email)->send(new SendAdminOtpMail($otp, $user->name, 'aktivasi akun admin baru', 'Kode OTP Aktivasi Akun Admin Baru - Boutique Design'));
            return back()->with('success', 'Kode OTP baru telah berhasil dikirim ke ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error resending new account OTP email: ' . $e->getMessage());
            return back()->with('warning', 'Pengiriman email gagal: ' . $e->getMessage() . ' (Kode sementara: ' . $otp . ')');
        }
    }

    /**
     * Log out the admin user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar (logout).');
    }
}
