<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\TranslationService;

class SettingController extends Controller
{
    public function index()
    {
        $settingsRaw = Setting::all();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s->key] = $s->value;
        }
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name'            => 'required|string|max:255',
            'address'                 => 'required|string',
            'phone'                   => 'required|string|max:255',
            'email'                   => 'nullable|string|max:255',
            'emails'                  => 'nullable|array',
            'emails.*'                => 'nullable|string|max:255',
            'npwp'                    => 'required|string|max:255',
            'slogan_main_en'          => 'nullable|string',
            'slogan_main_id'          => 'required|string',
            'slogan_sub_en'           => 'nullable|string',
            'slogan_sub_id'           => 'required|string',
            'slogan_philosophy_en'    => 'nullable|string',
            'slogan_philosophy_id'    => 'required|string',
            'philosophy_desc_en'      => 'nullable|string',
            'philosophy_desc_id'      => 'nullable|string',
            'contact_persons'         => 'nullable|array',
            'contact_persons.*.name'  => 'nullable|string|max:255',
            'contact_persons.*.phone' => 'nullable|string|max:255',
            'contact_person_1_name'   => 'nullable|string|max:255',
            'contact_person_1_phone'  => 'nullable|string|max:255',
            'contact_person_2_name'   => 'nullable|string|max:255',
            'contact_person_2_phone'  => 'nullable|string|max:255',
            'contact_person_3_name'   => 'nullable|string|max:255',
            'contact_person_3_phone'  => 'nullable|string|max:255',
            'contact_person_4_name'   => 'nullable|string|max:255',
            'contact_person_4_phone'  => 'nullable|string|max:255',
        ]);

        if (empty($validated['slogan_main_en']) && !empty($validated['slogan_main_id'])) {
            $validated['slogan_main_en'] = TranslationService::translate($validated['slogan_main_id']);
        }
        if (empty($validated['slogan_sub_en']) && !empty($validated['slogan_sub_id'])) {
            $validated['slogan_sub_en'] = TranslationService::translate($validated['slogan_sub_id']);
        }
        if (empty($validated['slogan_philosophy_en']) && !empty($validated['slogan_philosophy_id'])) {
            $validated['slogan_philosophy_en'] = TranslationService::translate($validated['slogan_philosophy_id']);
        }
        if (empty($validated['philosophy_desc_en']) && !empty($validated['philosophy_desc_id'])) {
            $validated['philosophy_desc_en'] = TranslationService::translate($validated['philosophy_desc_id']);
        }

        // Process dynamic Direct Contacts (Tambah, Edit, Hapus)
        $cleanContacts = [];
        if ($request->has('contact_persons') && is_array($request->input('contact_persons'))) {
            foreach ($request->input('contact_persons') as $cp) {
                $name = trim((string) ($cp['name'] ?? ''));
                $phone = trim((string) ($cp['phone'] ?? ''));
                if (!empty($name) || !empty($phone)) {
                    $cleanContacts[] = [
                        'name' => $name,
                        'phone' => $phone,
                    ];
                }
            }
        } elseif (!empty($validated['contact_person_1_name']) || !empty($validated['contact_person_1_phone'])) {
            for ($i = 1; $i <= 4; $i++) {
                $n = trim((string) ($validated["contact_person_{$i}_name"] ?? ''));
                $p = trim((string) ($validated["contact_person_{$i}_phone"] ?? ''));
                if (!empty($n) || !empty($p)) {
                    $cleanContacts[] = ['name' => $n, 'phone' => $p];
                }
            }
        }

        // Save JSON representation of all direct contacts
        Setting::updateOrCreate(
            ['key' => 'direct_contacts'],
            ['value' => json_encode($cleanContacts)]
        );

        // Sync legacy keys contact_person_1..4 for full backward compatibility
        for ($i = 1; $i <= 4; $i++) {
            $idx = $i - 1;
            $legacyName = isset($cleanContacts[$idx]) ? $cleanContacts[$idx]['name'] : '';
            $legacyPhone = isset($cleanContacts[$idx]) ? $cleanContacts[$idx]['phone'] : '';
            Setting::updateOrCreate(['key' => "contact_person_{$i}_name"], ['value' => $legacyName]);
            Setting::updateOrCreate(['key' => "contact_person_{$i}_phone"], ['value' => $legacyPhone]);
        }

        // Clean up contact fields before iterating through remaining settings
        unset($validated['contact_persons']);
        for ($i = 1; $i <= 4; $i++) {
            unset($validated["contact_person_{$i}_name"], $validated["contact_person_{$i}_phone"]);
        }

        // Process dynamic Company Emails (Tambah / Hapus)
        $cleanEmails = [];
        if ($request->has('emails') && is_array($request->input('emails'))) {
            foreach ($request->input('emails') as $em) {
                $em = trim((string) $em);
                if (!empty($em) && filter_var($em, FILTER_VALIDATE_EMAIL)) {
                    if (!in_array($em, $cleanEmails)) {
                        $cleanEmails[] = $em;
                    }
                }
            }
        }
        if (empty($cleanEmails) && !empty($request->input('email'))) {
            $em = trim((string) $request->input('email'));
            if (!empty($em) && filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $cleanEmails[] = $em;
            }
        }
        if (empty($cleanEmails)) {
            $cleanEmails = ['info@boutiquedesign.com'];
        }

        $primaryEmail = $cleanEmails[0];
        Setting::updateOrCreate(['key' => 'email'], ['value' => $primaryEmail]);
        Setting::updateOrCreate(['key' => 'company_emails'], ['value' => json_encode($cleanEmails)]);

        unset($validated['emails'], $validated['email']);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Company settings updated successfully.');
    }

    /**
     * Upload and replace the site logo.
     * Automatically removes any white/near-white background and auto-crops to content.
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|mimes:png,jpg,jpeg,gif|max:4096',
        ]);

        $file    = $request->file('logo');
        $tmpPath = $file->getRealPath();
        $mime    = $file->getMimeType();

        // Load image based on type
        if ($mime === 'image/png') {
            $src = imagecreatefrompng($tmpPath);
        } elseif (in_array($mime, ['image/jpeg', 'image/jpg'])) {
            $src = imagecreatefromjpeg($tmpPath);
        } elseif ($mime === 'image/gif') {
            $src = imagecreatefromgif($tmpPath);
        } else {
            return back()->with('logo_error', 'Unsupported image type.');
        }

        $w = imagesx($src);
        $h = imagesy($src);

        // Create transparent canvas
        $out = imagecreatetruecolor($w, $h);
        imagealphablending($out, false);
        imagesavealpha($out, true);
        $transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
        imagefilledrectangle($out, 0, 0, $w, $h, $transparent);

        // Remove white/near-white pixels (threshold 35)
        $threshold = 35;
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $rgba   = imagecolorat($src, $x, $y);
                $r      = ($rgba >> 16) & 0xFF;
                $g      = ($rgba >> 8)  & 0xFF;
                $b      =  $rgba        & 0xFF;
                $alpha  = ($rgba & 0x7F000000) >> 24; // 0=opaque, 127=transparent

                // If pixel is already transparent, keep transparent
                if ($alpha > 100) {
                    imagesetpixel($out, $x, $y, $transparent);
                    continue;
                }

                $distToWhite = sqrt(pow($r - 255, 2) + pow($g - 255, 2) + pow($b - 255, 2));
                if ($distToWhite < $threshold) {
                    imagesetpixel($out, $x, $y, $transparent);
                } else {
                    $color = imagecolorallocatealpha($out, $r, $g, $b, $alpha);
                    imagesetpixel($out, $x, $y, $color);
                }
            }
        }

        // Auto-crop to non-transparent bounding box
        $minX = $w; $maxX = 0; $minY = $h; $maxY = 0;
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $rgba  = imagecolorat($out, $x, $y);
                $alpha = ($rgba & 0x7F000000) >> 24;
                if ($alpha < 120) { // has visible content
                    if ($x < $minX) $minX = $x;
                    if ($x > $maxX) $maxX = $x;
                    if ($y < $minY) $minY = $y;
                    if ($y > $maxY) $maxY = $y;
                }
            }
        }

        if ($maxX > $minX && $maxY > $minY) {
            $cropW   = $maxX - $minX + 1;
            $cropH   = $maxY - $minY + 1;
            $cropped = imagecreatetruecolor($cropW, $cropH);
            imagealphablending($cropped, false);
            imagesavealpha($cropped, true);
            imagefilledrectangle($cropped, 0, 0, $cropW, $cropH, imagecolorallocatealpha($cropped, 0, 0, 0, 127));
            imagecopy($cropped, $out, 0, 0, $minX, $minY, $cropW, $cropH);
            imagedestroy($out);
            $out = $cropped;
        }

        // Save as PNG to public/uploads/logo.png
        $destDir = public_path('uploads');
        if (!file_exists($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        try {
            imagepng($out, $destDir . DIRECTORY_SEPARATOR . 'logo.png');
            imagedestroy($src);
            imagedestroy($out);
        } catch (\Throwable $e) {
            imagedestroy($src);
            imagedestroy($out);
            \Illuminate\Support\Facades\Log::error('Upload logo failed: ' . $e->getMessage());
            return back()->with('logo_error', 'Gagal menyimpan file logo (Permission Denied). Folder uploads tidak memiliki izin tulis di server.');
        }

        return back()->with('logo_success', 'Logo berhasil diperbarui!');
    }

    /**
     * Upload and update the Philosophy section image.
     */
    public function uploadPhilosophyImage(Request $request)
    {
        $request->validate([
            'philosophy_image' => 'required|file|mimes:png,jpg,jpeg,webp,svg,gif|max:8192',
        ]);

        $file = $request->file('philosophy_image');
        $destDir = public_path('uploads');
        if (!file_exists($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        // Generate clean unique filename
        $filename = 'philosophy_' . time() . '.' . $file->getClientOriginalExtension();
        try {
            $file->move($destDir, $filename);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Upload philosophy image setting failed: ' . $e->getMessage());
            return back()->with('philosophy_error', 'Gagal mengupload gambar filosofi (Permission Denied). Folder uploads tidak memiliki izin tulis di server.');
        }

        // Delete old image if exists
        $oldSetting = Setting::where('key', 'philosophy_image')->first();
        if ($oldSetting && !empty($oldSetting->value) && file_exists(public_path($oldSetting->value))) {
            @unlink(public_path($oldSetting->value));
        }

        Setting::updateOrCreate(['key' => 'philosophy_image'], ['value' => 'uploads/' . $filename]);

        return back()->with('philosophy_success', 'Gambar filosofi berhasil diupload dan diperbarui!');
    }

    /**
     * Delete custom Philosophy image and revert to default SVG diagram.
     */
    public function deletePhilosophyImage()
    {
        $oldSetting = Setting::where('key', 'philosophy_image')->first();
        if ($oldSetting && !empty($oldSetting->value) && file_exists(public_path($oldSetting->value))) {
            @unlink(public_path($oldSetting->value));
        }
        Setting::updateOrCreate(['key' => 'philosophy_image'], ['value' => '']);

        return back()->with('philosophy_success', 'Gambar filosofi berhasil dihapus, tampilan kembali menggunakan diagram standar.');
    }

    /**
     * Update Services / Layanan Background Media (Image, Video, Overlay settings).
     */
    public function updateServicesMedia(Request $request)
    {
        $request->validate([
            'services_bg_type'         => 'required|in:image,video,default',
            'services_image'           => 'nullable|file|mimes:jpeg,jpg,png,webp,gif,svg|max:15360',
            'services_video'           => 'nullable|file|mimes:mp4,webm,ogg,mov,m4v|max:40960',
            'services_video_url'       => 'nullable|url|max:500',
            'services_overlay_opacity' => 'nullable|integer|min:0|max:100',
            'services_overlay_color'   => 'nullable|in:light,dark',
        ], [
            'services_image.max' => 'Ukuran file gambar maksimal adalah 15MB.',
            'services_video.max' => 'Ukuran file video maksimal adalah 40MB. Untuk video dengan resolusi lebih besar, Anda dapat menggunakan kolom URL Video.',
        ]);

        $destDir = public_path('uploads/services');
        if (!file_exists($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        $bgType = $request->input('services_bg_type', 'image');

        // Handle Image Upload
        if ($request->hasFile('services_image')) {
            $file = $request->file('services_image');
            $filename = 'services_img_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);

                // Remove old custom services image if not the default one
                $oldImg = Setting::where('key', 'services_bg_image')->first();
                if ($oldImg && !empty($oldImg->value) && $oldImg->value !== 'uploads/services-bg.jpg' && file_exists(public_path($oldImg->value))) {
                    @unlink(public_path($oldImg->value));
                }

                Setting::updateOrCreate(['key' => 'services_bg_image'], ['value' => 'uploads/services/' . $filename]);
                $bgType = 'image';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload services image failed: ' . $e->getMessage());
                return back()->with('services_media_error', 'Gagal mengupload gambar background layanan: ' . $e->getMessage());
            }
        }

        // Handle Video Upload
        if ($request->hasFile('services_video')) {
            $file = $request->file('services_video');
            $filename = 'services_vid_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);

                // Remove old custom services video
                $oldVid = Setting::where('key', 'services_bg_video')->first();
                if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
                    @unlink(public_path($oldVid->value));
                }

                Setting::updateOrCreate(['key' => 'services_bg_video'], ['value' => 'uploads/services/' . $filename]);
                $bgType = 'video';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload services video failed: ' . $e->getMessage());
                return back()->with('services_media_error', 'Gagal mengupload video background layanan: ' . $e->getMessage());
            }
        }

        // Handle Video URL
        if ($request->has('services_video_url')) {
            $videoUrl = trim((string)$request->input('services_video_url', ''));
            Setting::updateOrCreate(
                ['key' => 'services_bg_video_url'],
                ['value' => $videoUrl]
            );
            if (!empty($videoUrl) && !$request->hasFile('services_image')) {
                if ($request->input('services_bg_type') === 'video') {
                    $bgType = 'video';
                }
            }
        }

        // Update Overlay Settings
        if ($request->has('services_overlay_opacity')) {
            Setting::updateOrCreate(
                ['key' => 'services_overlay_opacity'],
                ['value' => (int) $request->input('services_overlay_opacity', 85)]
            );
        }

        if ($request->has('services_overlay_color')) {
            Setting::updateOrCreate(
                ['key' => 'services_overlay_color'],
                ['value' => $request->input('services_overlay_color', 'light')]
            );
        }

        // Save active background type
        Setting::updateOrCreate(['key' => 'services_bg_type'], ['value' => $bgType]);

        return back()->with('services_media_success', 'Pengaturan background layanan (gambar/video) berhasil diperbarui!');
    }

    /**
     * Reset Services background to default curated image.
     */
    public function resetServicesMedia()
    {
        Setting::updateOrCreate(['key' => 'services_bg_type'], ['value' => 'image']);
        Setting::updateOrCreate(['key' => 'services_bg_image'], ['value' => 'uploads/services-bg.jpg']);
        Setting::updateOrCreate(['key' => 'services_overlay_opacity'], ['value' => '85']);
        Setting::updateOrCreate(['key' => 'services_overlay_color'], ['value' => 'light']);

        return back()->with('services_media_success', 'Background layanan berhasil direset ke gambar standar percetakan!');
    }

    /**
     * Delete uploaded services video.
     */
    public function deleteServicesVideo()
    {
        $oldVid = Setting::where('key', 'services_bg_video')->first();
        if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
            @unlink(public_path($oldVid->value));
        }
        Setting::updateOrCreate(['key' => 'services_bg_video'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'services_bg_video_url'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'services_bg_type'], ['value' => 'image']);

        return back()->with('services_media_success', 'File video background layanan berhasil dihapus. Mode dialihkan kembali ke gambar.');
    }

    /**
     * Update About / Tentang Kami Background Media (Image, Video, Overlay settings).
     */
    public function updateAboutMedia(Request $request)
    {
        $request->validate([
            'about_bg_type'         => 'required|in:image,video,default',
            'about_image'           => 'nullable|file|mimes:jpeg,jpg,png,webp,gif,svg|max:15360',
            'about_video'           => 'nullable|file|mimes:mp4,webm,ogg,mov,m4v|max:40960',
            'about_video_url'       => 'nullable|url|max:500',
            'about_overlay_opacity' => 'nullable|integer|min:0|max:100',
            'about_overlay_color'   => 'nullable|in:light,dark',
        ], [
            'about_image.max' => 'Ukuran file gambar maksimal adalah 15MB.',
            'about_video.max' => 'Ukuran file video maksimal adalah 40MB. Untuk video dengan resolusi lebih besar, Anda dapat menggunakan kolom URL Video.',
        ]);

        $destDir = public_path('uploads/about');
        if (!file_exists($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        $bgType = $request->input('about_bg_type', 'image');

        // Handle Image Upload
        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = 'about_img_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);

                // Remove old custom about image if not the default one
                $oldImg = Setting::where('key', 'about_bg_image')->first();
                if ($oldImg && !empty($oldImg->value) && $oldImg->value !== 'uploads/about-bg.jpg' && file_exists(public_path($oldImg->value))) {
                    @unlink(public_path($oldImg->value));
                }

                Setting::updateOrCreate(['key' => 'about_bg_image'], ['value' => 'uploads/about/' . $filename]);
                $bgType = 'image';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload about image failed: ' . $e->getMessage());
                return back()->with('about_media_error', 'Gagal mengupload gambar background tentang kami: ' . $e->getMessage());
            }
        }

        // Handle Video Upload
        if ($request->hasFile('about_video')) {
            $file = $request->file('about_video');
            $filename = 'about_vid_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);

                // Remove old custom about video
                $oldVid = Setting::where('key', 'about_bg_video')->first();
                if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
                    @unlink(public_path($oldVid->value));
                }

                Setting::updateOrCreate(['key' => 'about_bg_video'], ['value' => 'uploads/about/' . $filename]);
                $bgType = 'video';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload about video failed: ' . $e->getMessage());
                return back()->with('about_media_error', 'Gagal mengupload video background tentang kami: ' . $e->getMessage());
            }
        }

        // Handle Video URL
        if ($request->has('about_video_url')) {
            $videoUrl = trim((string)$request->input('about_video_url', ''));
            Setting::updateOrCreate(
                ['key' => 'about_bg_video_url'],
                ['value' => $videoUrl]
            );
            if (!empty($videoUrl) && !$request->hasFile('about_image')) {
                if ($request->input('about_bg_type') === 'video') {
                    $bgType = 'video';
                }
            }
        }

        // Update Overlay Settings
        if ($request->has('about_overlay_opacity')) {
            Setting::updateOrCreate(
                ['key' => 'about_overlay_opacity'],
                ['value' => (int) $request->input('about_overlay_opacity', 88)]
            );
        }

        if ($request->has('about_overlay_color')) {
            Setting::updateOrCreate(
                ['key' => 'about_overlay_color'],
                ['value' => $request->input('about_overlay_color', 'light')]
            );
        }

        // Save active background type
        Setting::updateOrCreate(['key' => 'about_bg_type'], ['value' => $bgType]);

        return back()->with('about_media_success', 'Pengaturan background Tentang Kami (gambar/video) berhasil diperbarui!');
    }

    /**
     * Reset About background to default curated image.
     */
    public function resetAboutMedia()
    {
        Setting::updateOrCreate(['key' => 'about_bg_type'], ['value' => 'image']);
        Setting::updateOrCreate(['key' => 'about_bg_image'], ['value' => 'uploads/about-bg.jpg']);
        Setting::updateOrCreate(['key' => 'about_overlay_opacity'], ['value' => '88']);
        Setting::updateOrCreate(['key' => 'about_overlay_color'], ['value' => 'light']);

        return back()->with('about_media_success', 'Background Tentang Kami berhasil direset ke gambar standar percetakan!');
    }

    /**
     * Delete uploaded about video.
     */
    public function deleteAboutVideo()
    {
        $oldVid = Setting::where('key', 'about_bg_video')->first();
        if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
            @unlink(public_path($oldVid->value));
        }
        Setting::updateOrCreate(['key' => 'about_bg_video'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'about_bg_video_url'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'about_bg_type'], ['value' => 'image']);

        return back()->with('about_media_success', 'File video background Tentang Kami berhasil dihapus. Mode dialihkan kembali ke gambar.');
    }

    /**
     * Update Hero / Beranda Background Media (Image, Video, Overlay settings).
     */
    public function updateHeroMedia(Request $request)
    {
        $request->validate([
            'hero_bg_type'         => 'required|in:image,video,default',
            'hero_image'           => 'nullable|file|mimes:jpeg,jpg,png,webp,gif,svg|max:15360',
            'hero_video'           => 'nullable|file|mimes:mp4,webm,ogg,mov,m4v|max:40960',
            'hero_video_url'       => 'nullable|url|max:500',
            'hero_overlay_opacity' => 'nullable|integer|min:0|max:100',
            'hero_overlay_color'   => 'nullable|in:light,dark',
        ], [
            'hero_image.max' => 'Ukuran file gambar maksimal adalah 15MB.',
            'hero_video.max' => 'Ukuran file video maksimal adalah 40MB. Untuk video dengan resolusi lebih besar, Anda dapat menggunakan kolom URL Video.',
        ]);

        $destDir = public_path('uploads/hero');
        if (!file_exists($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        $bgType = $request->input('hero_bg_type', 'image');

        // Handle Image Upload
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $filename = 'hero_img_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);
                
                // Remove old custom hero image if not the default one
                $oldImg = Setting::where('key', 'hero_bg_image')->first();
                if ($oldImg && !empty($oldImg->value) && $oldImg->value !== 'uploads/hero-bg.png' && file_exists(public_path($oldImg->value))) {
                    @unlink(public_path($oldImg->value));
                }

                Setting::updateOrCreate(['key' => 'hero_bg_image'], ['value' => 'uploads/hero/' . $filename]);
                $bgType = 'image';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload hero image failed: ' . $e->getMessage());
                return back()->with('hero_media_error', 'Gagal mengupload gambar background: ' . $e->getMessage());
            }
        }

        // Handle Video Upload
        if ($request->hasFile('hero_video')) {
            $file = $request->file('hero_video');
            $filename = 'hero_vid_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            try {
                $file->move($destDir, $filename);

                // Remove old custom hero video
                $oldVid = Setting::where('key', 'hero_bg_video')->first();
                if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
                    @unlink(public_path($oldVid->value));
                }

                Setting::updateOrCreate(['key' => 'hero_bg_video'], ['value' => 'uploads/hero/' . $filename]);
                $bgType = 'video';
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload hero video failed: ' . $e->getMessage());
                return back()->with('hero_media_error', 'Gagal mengupload video background: ' . $e->getMessage());
            }
        }

        // Handle Video URL
        if ($request->has('hero_video_url')) {
            $videoUrl = trim((string)$request->input('hero_video_url', ''));
            Setting::updateOrCreate(
                ['key' => 'hero_bg_video_url'],
                ['value' => $videoUrl]
            );
            if (!empty($videoUrl) && !$request->hasFile('hero_image')) {
                // If admin provided a video url and selected video type, keep it video
                if ($request->input('hero_bg_type') === 'video') {
                    $bgType = 'video';
                }
            }
        }

        // Update Overlay Settings
        if ($request->has('hero_overlay_opacity')) {
            Setting::updateOrCreate(
                ['key' => 'hero_overlay_opacity'],
                ['value' => (int) $request->input('hero_overlay_opacity', 82)]
            );
        }

        if ($request->has('hero_overlay_color')) {
            Setting::updateOrCreate(
                ['key' => 'hero_overlay_color'],
                ['value' => $request->input('hero_overlay_color', 'light')]
            );
        }

        // Save active background type
        Setting::updateOrCreate(['key' => 'hero_bg_type'], ['value' => $bgType]);

        return back()->with('hero_media_success', 'Pengaturan background beranda (gambar/video) berhasil diperbarui!');
    }

    /**
     * Reset Hero background to default curated image.
     */
    public function resetHeroMedia()
    {
        Setting::updateOrCreate(['key' => 'hero_bg_type'], ['value' => 'image']);
        Setting::updateOrCreate(['key' => 'hero_bg_image'], ['value' => 'uploads/hero-bg.png']);
        Setting::updateOrCreate(['key' => 'hero_overlay_opacity'], ['value' => '82']);
        Setting::updateOrCreate(['key' => 'hero_overlay_color'], ['value' => 'light']);

        return back()->with('hero_media_success', 'Background beranda berhasil direset ke gambar default!');
    }

    /**
     * Delete uploaded hero video.
     */
    public function deleteHeroVideo()
    {
        $oldVid = Setting::where('key', 'hero_bg_video')->first();
        if ($oldVid && !empty($oldVid->value) && file_exists(public_path($oldVid->value))) {
            @unlink(public_path($oldVid->value));
        }
        Setting::updateOrCreate(['key' => 'hero_bg_video'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'hero_bg_video_url'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'hero_bg_type'], ['value' => 'image']);

        return back()->with('hero_media_success', 'File video background berhasil dihapus. Mode background otomatis dialihkan ke gambar.');
    }

    /**
     * Fix upload and storage directory permissions directly from the admin dashboard.
     */
    public function fixPermissions()
    {
        $dirs = [
            public_path('uploads'),
            public_path('uploads/hero'),
            public_path('uploads/about'),
            public_path('uploads/services'),
            public_path('uploads/settings'),
            public_path('uploads/team'),
            public_path('uploads/philosophy'),
            public_path('uploads/portfolio'),
            public_path('uploads/clients'),
            public_path('uploads/clients/products'),
            storage_path(),
            storage_path('app'),
            storage_path('app/public'),
            storage_path('app/temp_backups'),
            storage_path('framework'),
            storage_path('framework/cache'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($dirs as $d) {
            if (!\Illuminate\Support\Facades\File::exists($d)) {
                try {
                    \Illuminate\Support\Facades\File::makeDirectory($d, 0777, true, true);
                } catch (\Throwable $e) {}
            }
            @chmod($d, 0777);

            if (\Illuminate\Support\Facades\File::isDirectory($d)) {
                foreach (\Illuminate\Support\Facades\File::allFiles($d) as $file) {
                    @chmod($file->getPathname(), 0666);
                }
            }
        }

        // Try shell_exec if available on Linux
        if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            @shell_exec('chmod -R 777 ' . escapeshellarg(public_path('uploads')));
            @shell_exec('chmod -R 777 ' . escapeshellarg(storage_path()));
            @shell_exec('chmod -R 777 ' . escapeshellarg(base_path('bootstrap/cache')));
        }

        // Re-check
        $stillFailed = [];
        foreach ($dirs as $d) {
            if (!is_writable($d)) {
                $stillFailed[] = str_replace(base_path(), '', $d);
            }
        }

        if (empty($stillFailed)) {
            return back()->with('success', 'Semua folder upload dan storage sistem berhasil diperbaiki dan siap digunakan (Writable)!');
        } else {
            return back()->with('error', 'Sebagian folder belum bisa ditulis otomatis oleh web server: ' . implode(', ', $stillFailed) . '. Harap jalankan perintah di terminal server hosting: sudo chmod -R 775 ' . public_path('uploads') . ' ' . storage_path());
        }
    }

    /**
     * AJAX endpoint to save direct contacts immediately (Tambah, Edit, Hapus).
     */
    public function saveContactsAjax(Request $request)
    {
        $cleanContacts = [];
        if ($request->has('contact_persons') && is_array($request->input('contact_persons'))) {
            foreach ($request->input('contact_persons') as $cp) {
                $name = trim((string) ($cp['name'] ?? ''));
                $phone = trim((string) ($cp['phone'] ?? ''));
                if (!empty($name) || !empty($phone)) {
                    $cleanContacts[] = [
                        'name' => $name,
                        'phone' => $phone,
                    ];
                }
            }
        }

        // Save JSON representation
        Setting::updateOrCreate(
            ['key' => 'direct_contacts'],
            ['value' => json_encode($cleanContacts)]
        );

        // Sync legacy keys up to 10
        for ($i = 1; $i <= 10; $i++) {
            $idx = $i - 1;
            $legacyName = isset($cleanContacts[$idx]) ? $cleanContacts[$idx]['name'] : '';
            $legacyPhone = isset($cleanContacts[$idx]) ? $cleanContacts[$idx]['phone'] : '';
            Setting::updateOrCreate(['key' => "contact_person_{$i}_name"], ['value' => $legacyName]);
            Setting::updateOrCreate(['key' => "contact_person_{$i}_phone"], ['value' => $legacyPhone]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar kontak berhasil diperbarui dan disimpan secara instan!',
            'count' => count($cleanContacts),
            'contacts' => $cleanContacts
        ]);
    }
}
