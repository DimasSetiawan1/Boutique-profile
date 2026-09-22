<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Mail\SendAdminOtpMail;

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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
            ])->onlyInput('email');
        }

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

        if (empty($savedOtp) || $cleanOtp !== $savedOtp) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah. Pastikan memasukkan 6 digit kode terbaru dari email Anda.']);
        }

        if (!$user->otp_expires_at || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan klik "Kirim Ulang".']);
        }

        // Aktivasi akun baru!
        $user->email_verified_at = now();
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

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
