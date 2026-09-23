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
            'email'                   => 'required|email|max:255',
            'npwp'                    => 'required|string|max:255',
            'slogan_main_en'          => 'nullable|string',
            'slogan_main_id'          => 'required|string',
            'slogan_sub_en'           => 'nullable|string',
            'slogan_sub_id'           => 'required|string',
            'slogan_philosophy_en'    => 'nullable|string',
            'slogan_philosophy_id'    => 'required|string',
            'philosophy_desc_en'      => 'nullable|string',
            'philosophy_desc_id'      => 'nullable|string',
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
}
