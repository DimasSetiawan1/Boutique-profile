<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Services\TranslationService;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description_en' => 'nullable|string',
            'description_id' => 'required|string',

        ]);

        // Auto-translate title and description if English fields are empty (store)
        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['description_en'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        // Always sync category with item title
        $validated['category_en'] = $validated['title_en'];
        $validated['category_id'] = $validated['title_id'];

        if ($request->hasFile('image')) {
            $destDir = public_path('uploads/portfolio');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/portfolio: ' . $e->getMessage());
                }
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($destDir, $imageName);
                $validated['image_path'] = 'uploads/portfolio/' . $imageName;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload portfolio image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal menyimpan gambar portofolio (Permission Denied). Folder uploads/portfolio tidak memiliki izin tulis di server.');
            }
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description_en' => 'nullable|string',
            'description_id' => 'required|string',
        ]);

        // Auto-translate title and description if English fields are empty (update)
        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['description_en'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        // Always sync category with item title
        $validated['category_en'] = $validated['title_en'];
        $validated['category_id'] = $validated['title_id'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($portfolio->image_path && File::exists(public_path($portfolio->image_path))) {
                @unlink(public_path($portfolio->image_path));
            }

            $destDir = public_path('uploads/portfolio');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/portfolio: ' . $e->getMessage());
                }
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($destDir, $imageName);
                $validated['image_path'] = 'uploads/portfolio/' . $imageName;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload portfolio image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal memperbarui gambar portofolio (Permission Denied). Folder uploads/portfolio tidak memiliki izin tulis di server.');
            }
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete image if exists
        if ($portfolio->image_path && File::exists(public_path($portfolio->image_path))) {
            File::delete(public_path($portfolio->image_path));
        }

        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item deleted successfully.');
    }
}
