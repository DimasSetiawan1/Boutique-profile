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

class ProfileController extends Controller
{
    /**
     * Display the profile, password change, and admin accounts management page.
     */
    public function index()
    {
        $user = Auth::user();
        $admins = User::orderBy('id', 'asc')->get();
        return view('admin.profile.index', compact('user', 'admins'));
    }

    /**
     * Update current admin user profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
        ]);

        $user->name = $validated['name'];
        $user->save();

        return back()->with('profile_success', 'Nama profil berhasil diperbarui.');
    }

    /**
     * Update current admin password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi baru minimal harus 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Kata sandi saat ini tidak cocok dengan data kami.',
            ])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', 'Kata sandi berhasil diperbarui! Silakan gunakan kata sandi baru ini untuk login berikutnya.');
    }

    /**
     * Create a new admin account and automatically dispatch OTP email via Gmail.
     */
    public function storeAdmin(Request $request)
    {
        // Auto-complete @gmail.com if omitted by user (e.g. "huseinahmad119" -> "huseinahmad119@gmail.com")
        $rawEmail = trim($request->input('email', ''));
        if (!empty($rawEmail) && !str_contains($rawEmail, '@')) {
            $rawEmail .= '@gmail.com';
            $request->merge(['email' => $rawEmail]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Nama admin wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email harus benar dan valid (contoh: nama@gmail.com).',
            'email.unique' => 'Email ini sudah terdaftar sebagai akun admin.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $otp = sprintf("%06d", mt_rand(100000, 999999));

        $newAdmin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => null, // Akun baru harus verifikasi OTP saat login pertama kali
            'otp_code' => $otp,
            'otp_expires_at' => now()->addHours(24),
        ]);

        try {
            Mail::to($newAdmin->email)->send(new SendAdminOtpMail(
                $otp,
                $newAdmin->name,
                'aktivasi akun admin baru',
                'Kode OTP Aktivasi Akun Admin Baru - Boutique Design'
            ));

            return back()->with('admin_created_success', 'Akun admin baru (' . $newAdmin->email . ') berhasil didaftarkan! Kode OTP 6-digit telah langsung dikirimkan ke email Gmail tersebut.');
        } catch (\Exception $e) {
            Log::error('Error sending OTP to new admin: ' . $e->getMessage());
            return back()->with('admin_created_success', 'Akun admin baru (' . $newAdmin->email . ') berhasil dibuat! (Catatan: Pengiriman email gagal: ' . $e->getMessage() . '. Kode OTP sementara: ' . $otp . ')');
        }
    }

    /**
     * Delete an admin account.
     */
    public function destroyAdmin(User $admin)
    {
        if ($admin->id === Auth::id()) {
            return back()->with('admin_error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if (User::count() <= 1) {
            return back()->with('admin_error', 'Tidak dapat menghapus, minimal harus ada 1 akun admin aktif.');
        }

        $adminEmail = $admin->email;
        $admin->delete();

        return back()->with('admin_deleted_success', 'Akun admin ' . $adminEmail . ' berhasil dihapus.');
    }
}
