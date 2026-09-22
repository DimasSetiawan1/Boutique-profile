<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Portfolio;
use App\Models\Philosophy;
use App\Models\ContactMessage;
use App\Models\Client;

use App\Services\EmailVerifier;
use App\Services\PhoneVerifier;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Load all database items for frontend display
        $settingsRaw = Setting::all();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s->key] = $s->value;
        }

        $services = Service::all();
        $team = TeamMember::orderBy('priority', 'asc')->get();
        $portfolios = Portfolio::all();
        $philosophies = Philosophy::orderBy('sort_order', 'asc')->get();
        $clients = Client::all();

        return view('welcome', compact('settings', 'services', 'team', 'portfolios', 'philosophies', 'clients'));
    }

    /**
     * Live AJAX check for contact form email validation with real-time mailbox check.
     */
    public function checkContactEmail(Request $request)
    {
        $email = trim((string) $request->input('email', ''));
        $result = EmailVerifier::check($email);
        return response()->json($result);
    }

    /**
     * Live AJAX check for contact form phone validation with anti-spam check.
     */
    public function checkContactPhone(Request $request)
    {
        $phone = trim((string) $request->input('phone', ''));
        $result = PhoneVerifier::check($phone);
        return response()->json($result);
    }

    /**
     * Handle the contact form submission with strict email, phone, anti-judol & cyber security validation.
     */
    public function submitContact(Request $request)
    {
        // 1. Anti-Bot Honeypot Trap (Silent discard for bots)
        if ($request->filled('b_security_verification_field')) {
            \App\Services\CyberSecurityGuard::logThreat('HONEYPOT_TRAP', 'Spam bot filled honeypot trap field');
            return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah berhasil kami terima. Kami akan segera menghubungi Anda.');
        }

        // 2. Anti-Bot Fast Submit Time-Gate (< 2 seconds)
        $renderedAt = (int) $request->input('_sec_token_time', 0);
        if ($renderedAt > 0 && (time() - $renderedAt < 2)) {
            \App\Services\CyberSecurityGuard::logThreat('BOT_FAST_SUBMIT', 'Form submitted abnormally fast (< 2s)');
            return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah berhasil kami terima. Kami akan segera menghubungi Anda.');
        }

        // 3. Anti-Judi Online, Anti-Spam & Cyber Threat Inspection
        $secCheck = \App\Services\CyberSecurityGuard::inspectInputs($request->only(['name', 'email', 'phone', 'subject', 'message']));
        if (!$secCheck['safe']) {
            return redirect()->back()->withErrors([
                'message' => $secCheck['reason'] ?: 'Pesan tidak dapat dikirim karena terdeteksi indikasi spam judi online / konten berbahaya.',
            ])->withInput();
        }

        $email = trim((string) $request->input('email', ''));
        $phone = trim((string) $request->input('phone', ''));

        // 4. Verify Email
        $emailCheck = EmailVerifier::check($email);
        if (!$emailCheck['valid']) {
            return redirect()->back()->withErrors([
                'email' => $emailCheck['message'] ?: 'Email ini tidak sesuai atau tidak terdaftar. Harap masukkan email yang sebenarnya.',
            ])->withInput();
        }

        // 5. Verify Phone
        $phoneCheck = PhoneVerifier::check($phone);
        if (!$phoneCheck['valid']) {
            return redirect()->back()->withErrors([
                'phone' => $phoneCheck['message'] ?: 'Nomor telepon tidak sesuai atau terdeteksi asal-asalan. Harap gunakan nomor HP aktif.',
            ])->withInput();
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        // 6. Sanitize inputs against Stored XSS / HTML injection
        $validated['name'] = \App\Services\CyberSecurityGuard::sanitizeString($validated['name']);
        if (!empty($validated['subject'])) {
            $validated['subject'] = \App\Services\CyberSecurityGuard::sanitizeString($validated['subject']);
        }
        $validated['message'] = \App\Services\CyberSecurityGuard::sanitizeString($validated['message']);

        $contactMessage = ContactMessage::create($validated);

        // 7. Kirim notifikasi email ke seluruh akun admin yang terdaftar (Gmail)
        try {
            $adminEmails = \App\Models\User::whereNotNull('email')
                ->pluck('email')
                ->filter()
                ->unique()
                ->values()
                ->toArray();

            if (!empty($adminEmails)) {
                \Illuminate\Support\Facades\Mail::to($adminEmails)
                    ->send(new \App\Mail\ContactMessageReceivedMail($contactMessage));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim notifikasi email pesan kontak ke admin: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah berhasil kami terima. Kami akan segera menghubungi Anda.');
    }
}
