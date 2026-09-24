<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Mail\SendAdminOtpMail;

class ForgotPasswordController extends Controller
{
    /**
     * Show form to request OTP for password reset.
     */
    public function showForgotForm()
    {
        return view('admin.auth.forgot_password');
    }

    /**
     * Send OTP to user's email for password reset.
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Silakan masukkan alamat email Anda.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $lockoutKey = 'admin_lockout_' . md5(strtolower($request->email));
        if (Cache::has($lockoutKey)) {
            $lockoutUntil = (int) Cache::get($lockoutKey);
            if ($lockoutUntil > time()) {
                $remaining = max(1, $lockoutUntil - time());
                return back()->withErrors([
                    'email' => "Akun ini sedang diblokir sementara ({$remaining} detik tersisa) karena 3x salah memasukkan kata sandi. Anda harus menunggu hingga waktu blokir berakhir sebelum kode OTP dapat dikirimkan ke Gmail.",
                ])->onlyInput('email');
            }
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Alamat email ini tidak terdaftar sebagai admin.',
            ])->onlyInput('email');
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        session([
            'reset_user_id' => $user->id,
            'reset_email' => $user->email,
            'lockout_otp_sent' => true,
        ]);

        try {
            Mail::to($user->email)->send(new SendAdminOtpMail($otp, $user->name, 'reset kata sandi', 'Kode OTP Reset Kata Sandi - Boutique Design'));
            return redirect()->route('admin.password.otp.form')
                ->with('success', 'Kode OTP 6-digit telah dikirim ke ' . $user->email . '. Periksa inbox email Anda.');
        } catch (\Exception $e) {
            Log::error('Error sending reset OTP email: ' . $e->getMessage());
            return redirect()->route('admin.password.otp.form')
                ->with('warning', 'Kode OTP dibuat, namun pengiriman email gagal: ' . $e->getMessage() . ' (Kode sementara: ' . $otp . ')');
        }
    }

    /**
     * Show form to verify OTP.
     */
    public function showResetOtpForm(Request $request)
    {
        if (!session()->has('reset_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Sesi reset kata sandi telah berakhir. Silakan masukkan email Anda kembali.');
        }

        $user = User::find(session('reset_user_id'));
        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Pengguna tidak ditemukan.');
        }

        $lockoutUntil = session('security_lockout_until');
        $isLocked = $lockoutUntil && ($lockoutUntil > time());
        $lockoutRemaining = $isLocked ? max(1, $lockoutUntil - time()) : 0;
        $otpSent = (bool) session('lockout_otp_sent', false);

        // Jika bukan dari alur blokir keamanan (misal forgot password biasa), OTP sudah otomatis terkirim
        if (!$lockoutUntil) {
            $otpSent = true;
        }

        // Jika akun terkena lockout dan waktu blokirnya SUDAH SELESAI, tetapi OTP belum dikirim:
        // Otomatis buat dan langsung kirimkan kode OTP ke Gmail sekarang!
        if ($lockoutUntil && time() >= $lockoutUntil && !$otpSent) {
            $otp = sprintf("%06d", mt_rand(100000, 999999));
            $user->otp_code = $otp;
            $user->otp_expires_at = now()->addMinutes(15);
            $user->save();

            session(['lockout_otp_sent' => true]);
            $otpSent = true;

            try {
                Mail::to($user->email)->send(new SendAdminOtpMail(
                    $otp,
                    $user->name,
                    'pemulihan keamanan akun setelah waktu blokir berakhir',
                    'Kode OTP Reset Kata Sandi (Waktu Blokir Selesai) - Boutique Design'
                ));
                session()->flash('success', 'Waktu blokir telah berakhir! Kode OTP 6-digit telah langsung dikirimkan ke Gmail ' . $user->email . '. Silakan periksa inbox/spam Gmail Anda.');
            } catch (\Exception $e) {
                Log::error('Error sending lockout expired OTP email: ' . $e->getMessage());
                session()->flash('warning', 'Waktu blokir telah berakhir. Kode OTP dibuat, namun pengiriman email gagal: ' . $e->getMessage());
            }
        }

        // Generate challenge token untuk reCAPTCHA
        $timestamp = time();
        $nonce = bin2hex(random_bytes(16));
        $payload = implode('|', [
            $timestamp,
            $request->ip(),
            substr(hash('sha256', (string) $request->header('User-Agent')), 0, 16),
            $nonce,
            config('app.key')
        ]);
        $recaptchaChallenge = Crypt::encryptString($payload);

        $lockoutTier = (int) session('lockout_tier', 1);
        $lockoutDuration = (int) session('lockout_duration', 60);

        return view('admin.auth.reset_password_otp', compact('recaptchaChallenge', 'isLocked', 'lockoutRemaining', 'otpSent', 'lockoutTier', 'lockoutDuration'));
    }

    /**
     * Send OTP when lockout countdown completes (called automatically by AJAX when timer hits 0).
     */
    public function sendLockoutOtp(Request $request)
    {
        if (!session()->has('reset_user_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi telah berakhir. Silakan muat ulang halaman.',
            ], 403);
        }

        $lockoutUntil = session('security_lockout_until');
        if ($lockoutUntil && time() < $lockoutUntil) {
            $remaining = max(1, $lockoutUntil - time());
            return response()->json([
                'success' => false,
                'message' => "Waktu blokir belum selesai ({$remaining} detik tersisa). Harap tunggu hingga hitungan selesai.",
                'remaining' => $remaining,
            ], 400);
        }

        $user = User::find(session('reset_user_id'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan.',
            ], 404);
        }

        // Generate fresh 6-digit OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        session(['lockout_otp_sent' => true]);

        try {
            Mail::to($user->email)->send(new SendAdminOtpMail(
                $otp,
                $user->name,
                'pemulihan keamanan akun setelah waktu blokir berakhir',
                'Kode OTP Reset Kata Sandi (Waktu Blokir Selesai) - Boutique Design'
            ));

            return response()->json([
                'success' => true,
                'message' => 'Waktu blokir telah selesai! Kode OTP 6-digit telah langsung dikirim ke Gmail ' . $user->email . '.',
                'email' => $user->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending lockout expired OTP email via AJAX: ' . $e->getMessage());
            return response()->json([
                'success' => true,
                'message' => 'Waktu blokir telah selesai! Kode OTP dibuat: ' . $otp . ' (Pengiriman email: ' . $e->getMessage() . ')',
                'email' => $user->email,
            ]);
        }
    }

    /**
     * Verify OTP for password reset.
     */
    public function verifyResetOtp(Request $request)
    {
        // Periksa apakah waktu blokir masih berjalan
        $lockoutUntil = session('security_lockout_until');
        if ($lockoutUntil && time() < $lockoutUntil) {
            $remaining = max(1, $lockoutUntil - time());
            return back()->withErrors([
                'otp' => "Waktu blokir belum selesai ({$remaining} detik tersisa). Anda harus menunggu hingga waktu blokir berakhir sebelum dapat memasukkan kode OTP dari Gmail.",
            ]);
        }

        if (session()->has('security_lockout_until') && !session('lockout_otp_sent')) {
            return back()->withErrors([
                'otp' => "Kode OTP dari Gmail belum dikirimkan. Harap tunggu hingga waktu blokir berakhir untuk menerima kode OTP.",
            ]);
        }

        // 1. Validasi reCAPTCHA
        $recaptchaToken = $request->input('recaptcha_token');
        if (empty($recaptchaToken)) {
            return back()->withErrors(['recaptcha' => 'Silakan centang reCAPTCHA "Saya bukan robot" untuk melanjutkan.']);
        }

        try {
            $decrypted = Crypt::decryptString($recaptchaToken);
            $parts = explode('|', $decrypted);
            if (count($parts) < 4 || (time() - (int)$parts[0] > 900)) {
                return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA telah kedaluwarsa. Silakan centang kembali.']);
            }
        } catch (\Throwable $e) {
            return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA tidak valid.']);
        }

        // 2. Bersihkan input OTP dari spasi, strip, atau karakter non-angka
        $cleanOtp = preg_replace('/\D/', '', (string) $request->input('otp', ''));
        $request->merge(['otp' => $cleanOtp]);

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ], [
            'otp.required' => 'Masukkan 6 digit kode OTP.',
            'otp.size' => 'Kode OTP harus tepat 6 digit angka.',
        ]);

        if (!session()->has('reset_user_id')) {
            return redirect()->route('admin.login')->with('error', 'Sesi telah berakhir.');
        }

        $user = User::find(session('reset_user_id'));

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Pengguna tidak ditemukan.');
        }

        $savedOtp = trim((string) $user->otp_code);

        $otpAttemptsKey = 'otp_failed_attempts_' . md5(strtolower($user->email));
        $otpTierKey = 'otp_lockout_tier_' . md5(strtolower($user->email));

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

                // Dikosongkan agar kode lama tidak bisa ditebak lagi; kode baru dikirim setelah timer berakhir
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

                $tierTitles = [
                    1 => 'Peringatan Keamanan OTP (Tingkat 1)',
                    2 => 'Peringatan Keamanan OTP (Tingkat 2)',
                    3 => 'Peringatan Keamanan OTP Maksimal (Tingkat 3)',
                ];
                $title = $tierTitles[$currentOtpTier] ?? 'Peringatan Keamanan OTP';

                return back()->withErrors([
                    'otp' => "{$title}: Anda telah 3 kali salah memasukkan kode OTP! Akses verifikasi diblokir selama {$lockoutDesc}. Harap tunggu hingga hitungan mundur selesai terlebih dahulu, baru kode OTP baru akan langsung dikirim otomatis ke Gmail Anda.",
                ])->with('warning', "{$title}: Terdeteksi 3x salah memasukkan kode OTP! Akses verifikasi diblokir sementara selama {$lockoutDesc}.");
            }

            $remainingAttempts = 3 - $otpAttempts;
            return back()->withErrors([
                'otp' => "Kode OTP yang Anda masukkan salah. Percobaan tersisa: {$remainingAttempts} kali sebelum verifikasi diblokir {$lockoutDesc}.",
            ]);
        }

        if (!$user->otp_expires_at || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan klik "Kirim Ulang" di bawah.']);
        }

        // OTP Valid - Mark verified and clear security lockout & OTP attempt counters
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        Cache::forget('admin_lockout_' . md5(strtolower($user->email)));
        Cache::forget('login_failed_attempts_' . md5(strtolower($user->email)));
        Cache::forget('admin_lockout_tier_' . md5(strtolower($user->email)));
        Cache::forget('admin_requires_otp_' . md5(strtolower($user->email)));
        Cache::forget($otpAttemptsKey);
        Cache::forget($otpTierKey);

        session([
            'reset_otp_verified' => true,
            'security_password_reset_required' => true,
        ]);

        return redirect()->route('admin.password.new.form')
            ->with('success', 'Kode OTP dan reCAPTCHA berhasil diverifikasi! Demi meminimalisir risiko peretasan, silakan buat kata sandi baru untuk akun Anda.');
    }

    /**
     * Show form to set new password.
     */
    public function showNewPasswordForm()
    {
        if (!session()->has('reset_user_id') || !session()->has('reset_otp_verified')) {
            return redirect()->route('admin.password.forgot')->with('error', 'Sesi tidak valid. Silakan ulangi proses reset kata sandi.');
        }

        return view('admin.auth.new_password');
    }

    /**
     * Save new password.
     */
    public function updateNewPassword(Request $request)
    {
        if (!session()->has('reset_user_id') || !session()->has('reset_otp_verified')) {
            return redirect()->route('admin.password.forgot')->with('error', 'Sesi telah berakhir.');
        }

        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::find(session('reset_user_id'));

        if (!$user) {
            return redirect()->route('admin.password.forgot')->with('error', 'Pengguna tidak ditemukan.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget('admin_lockout_' . md5(strtolower($user->email)));
        Cache::forget('login_failed_attempts_' . md5(strtolower($user->email)));
        Cache::forget('admin_lockout_tier_' . md5(strtolower($user->email)));
        Cache::forget('admin_requires_otp_' . md5(strtolower($user->email)));
        Cache::forget('otp_failed_attempts_' . md5(strtolower($user->email)));
        Cache::forget('otp_lockout_tier_' . md5(strtolower($user->email)));

        session()->forget([
            'reset_user_id',
            'reset_email',
            'reset_otp_verified',
            'security_lockout_until',
            'lockout_reason',
            'lockout_tier',
            'lockout_duration',
            'lockout_otp_sent',
            'security_password_reset_required',
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan login dengan kata sandi baru Anda.');
    }

    /**
     * Resend OTP for reset password.
     */
    public function resendResetOtp()
    {
        if (!session()->has('reset_user_id')) {
            return redirect()->route('admin.password.forgot')->with('error', 'Sesi telah berakhir.');
        }

        $lockoutUntil = session('security_lockout_until');
        if ($lockoutUntil && time() < $lockoutUntil) {
            $remaining = max(1, $lockoutUntil - time());
            return back()->with('error', "Waktu blokir belum selesai ({$remaining} detik tersisa). Kode OTP dari Gmail belum dapat dikirimkan sebelum waktu blokir berakhir.");
        }

        $user = User::find(session('reset_user_id'));

        if (!$user) {
            return redirect()->route('admin.password.forgot')->with('error', 'Pengguna tidak ditemukan.');
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        session(['lockout_otp_sent' => true]);

        try {
            Mail::to($user->email)->send(new SendAdminOtpMail($otp, $user->name, 'reset kata sandi', 'Kode OTP Reset Kata Sandi - Boutique Design'));
            return back()->with('success', 'Kode OTP baru telah berhasil dikirim ke ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error resending reset OTP email: ' . $e->getMessage());
            return back()->with('warning', 'Pengiriman email gagal: ' . $e->getMessage() . ' (Kode sementara: ' . $otp . ')');
        }
    }
}
