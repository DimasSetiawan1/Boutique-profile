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
        $existingTitles = Portfolio::select('title_id', 'title_en')->distinct()->get();
        return view('admin.portfolios.create', compact('existingTitles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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

        $portfolio = Portfolio::create($validated);

        if ($request->hasFile('images')) {
            $destDir = public_path('uploads/portfolio');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/portfolio: ' . $e->getMessage());
                }
            }

            foreach ($request->file('images') as $index => $image) {
                try {
                    $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                    $image->move($destDir, $imageName);
                    $path = 'uploads/portfolio/' . $imageName;
                    
                    // Set the first image as the main image_path
                    if ($index === 0) {
                        $portfolio->update(['image_path' => $path]);
                    }
                    
                    // Add to portfolio_images table
                    $portfolio->images()->create(['image_path' => $path]);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Upload portfolio image failed: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $existingTitles = Portfolio::select('title_id', 'title_en')->distinct()->get();
        return view('admin.portfolios.edit', compact('portfolio', 'existingTitles'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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

        $portfolio->update($validated);

        if ($request->hasFile('images')) {
            $destDir = public_path('uploads/portfolio');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/portfolio: ' . $e->getMessage());
                }
            }

            foreach ($request->file('images') as $index => $image) {
                try {
                    $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                    $image->move($destDir, $imageName);
                    $path = 'uploads/portfolio/' . $imageName;
                    
                    // If no main image exists, set this as main image
                    if (!$portfolio->image_path) {
                        $portfolio->update(['image_path' => $path]);
                    }
                    
                    $portfolio->images()->create(['image_path' => $path]);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Upload portfolio image failed: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio) {
            return redirect()->route('admin.portfolios.edit', $portfolio->id);
        }
        return redirect()->route('admin.portfolios.index')->with('error', 'Item portofolio tidak ditemukan.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete images
        if ($portfolio->image_path && File::exists(public_path($portfolio->image_path))) {
            @unlink(public_path($portfolio->image_path));
        }
        foreach ($portfolio->images as $img) {
            if (File::exists(public_path($img->image_path))) {
                @unlink(public_path($img->image_path));
            }
        }
        
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = \App\Models\PortfolioImage::findOrFail($id);
        
        if (File::exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }

        // Check if this was the main image, if so set main image to another one or null
        $portfolio = $image->portfolio;
        if ($portfolio->image_path == $image->image_path) {
            $nextImage = $portfolio->images()->where('id', '!=', $id)->first();
            $portfolio->update(['image_path' => $nextImage ? $nextImage->image_path : null]);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
