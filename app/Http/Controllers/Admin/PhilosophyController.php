<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Philosophy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Services\TranslationService;

class PhilosophyController extends Controller
{
    public function index()
    {
        $philosophies = Philosophy::orderBy('sort_order', 'asc')->get();
        return view('admin.philosophies.index', compact('philosophies'));
    }

    public function create()
    {
        return view('admin.philosophies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en'        => 'nullable|string|max:255',
            'title_id'        => 'required|string|max:255',
            'subtitle_en'     => 'nullable|string|max:255',
            'subtitle_id'     => 'nullable|string|max:255',
            'icon'            => 'nullable|string|max:100',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'description_en'  => 'nullable|string',
            'description_id'  => 'nullable|string',
            'is_highlighted'  => 'nullable|boolean',
            'sort_order'      => 'nullable|integer',
        ]);

        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['subtitle_en']) && !empty($validated['subtitle_id'])) {
            $validated['subtitle_en'] = TranslationService::translate($validated['subtitle_id']);
        }
        if (empty($validated['description_en']) && !empty($validated['description_id'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        $validated['is_highlighted'] = $request->has('is_highlighted');
        $validated['sort_order'] = $request->input('sort_order', (Philosophy::max('sort_order') ?? 0) + 1);
        $validated['icon'] = $request->input('icon') ?: 'bi-lightbulb-fill';
        $validated['key'] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $validated['title_en'])) . '_' . uniqid();

        if ($request->hasFile('image')) {
            $dest = public_path('uploads/philosophy');
            if (!File::exists($dest)) {
                try {
                    File::makeDirectory($dest, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/philosophy: ' . $e->getMessage());
                }
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($dest, $imageName);
                $validated['image_path'] = 'uploads/philosophy/' . $imageName;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload philosophy image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal menyimpan gambar filosofi (Permission Denied). Folder uploads/philosophy tidak memiliki izin tulis di server.');
            }
        }

        Philosophy::create($validated);

        return redirect()->route('admin.philosophies.index')->with('success', 'Philosophy item created successfully.');
    }

    public function edit(Philosophy $philosophy)
    {
        return view('admin.philosophies.edit', compact('philosophy'));
    }

    public function update(Request $request, Philosophy $philosophy)
    {
        $validated = $request->validate([
            'title_en'        => 'nullable|string|max:255',
            'title_id'        => 'required|string|max:255',
            'subtitle_en'     => 'nullable|string|max:255',
            'subtitle_id'     => 'nullable|string|max:255',
            'icon'            => 'nullable|string|max:100',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'description_en'  => 'nullable|string',
            'description_id'  => 'nullable|string',
            'is_highlighted'  => 'nullable|boolean',
            'sort_order'      => 'nullable|integer',
        ]);

        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['subtitle_en']) && !empty($validated['subtitle_id'])) {
            $validated['subtitle_en'] = TranslationService::translate($validated['subtitle_id']);
        }
        if (empty($validated['description_en']) && !empty($validated['description_id'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        $validated['is_highlighted'] = $request->has('is_highlighted');
        $validated['sort_order'] = $request->input('sort_order', $philosophy->sort_order ?? 1);
        $validated['icon'] = $request->input('icon') ?: 'bi-lightbulb-fill';

        if ($request->hasFile('image')) {
            $dest = public_path('uploads/philosophy');
            if (!File::exists($dest)) {
                try {
                    File::makeDirectory($dest, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/philosophy: ' . $e->getMessage());
                }
            }

            if ($philosophy->image_path && File::exists(public_path($philosophy->image_path))) {
                @unlink(public_path($philosophy->image_path));
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($dest, $imageName);
                $validated['image_path'] = 'uploads/philosophy/' . $imageName;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload philosophy image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal memperbarui gambar filosofi (Permission Denied). Folder uploads/philosophy tidak memiliki izin tulis di server.');
            }
        }

        $philosophy->update($validated);

        return redirect()->route('admin.philosophies.index')->with('success', 'Philosophy item updated successfully.');
    }

    public function destroy(Philosophy $philosophy)
    {
        if ($philosophy->image_path && File::exists(public_path($philosophy->image_path))) {
            File::delete(public_path($philosophy->image_path));
        }

        $philosophy->delete();
        return redirect()->route('admin.philosophies.index')->with('success', 'Philosophy item deleted successfully.');
    }
}
