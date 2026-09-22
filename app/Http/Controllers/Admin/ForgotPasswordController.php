<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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
    public function showResetOtpForm()
    {
        if (!session()->has('reset_user_id')) {
            return redirect()->route('admin.password.forgot')->with('error', 'Sesi reset kata sandi telah berakhir. Silakan masukkan email Anda kembali.');
        }

        return view('admin.auth.reset_password_otp');
    }

    /**
     * Verify OTP for password reset.
     */
    public function verifyResetOtp(Request $request)
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

        if (!session()->has('reset_user_id')) {
            return redirect()->route('admin.password.forgot')->with('error', 'Sesi telah berakhir.');
        }

        $user = User::find(session('reset_user_id'));

        if (!$user) {
            return redirect()->route('admin.password.forgot')->with('error', 'Pengguna tidak ditemukan.');
        }

        $savedOtp = trim((string) $user->otp_code);

        if (empty($savedOtp) || $cleanOtp !== $savedOtp) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah. Pastikan memasukkan 6 digit kode terbaru dari email Anda.']);
        }

        if (!$user->otp_expires_at || now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan klik "Kirim Ulang" di bawah.']);
        }

        // OTP Valid - Mark verified
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        session(['reset_otp_verified' => true]);

        return redirect()->route('admin.password.new.form')
            ->with('success', 'Kode OTP terverifikasi! Silakan buat kata sandi baru Anda.');
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

        session()->forget(['reset_user_id', 'reset_email', 'reset_otp_verified']);

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

        $user = User::find(session('reset_user_id'));

        if (!$user) {
            return redirect()->route('admin.password.forgot')->with('error', 'Pengguna tidak ditemukan.');
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        try {
            Mail::to($user->email)->send(new SendAdminOtpMail($otp, $user->name, 'reset kata sandi', 'Kode OTP Reset Kata Sandi - Boutique Design'));
            return back()->with('success', 'Kode OTP baru telah berhasil dikirim ke ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error resending reset OTP email: ' . $e->getMessage());
            return back()->with('warning', 'Pengiriman email gagal: ' . $e->getMessage() . ' (Kode sementara: ' . $otp . ')');
        }
    }
}
