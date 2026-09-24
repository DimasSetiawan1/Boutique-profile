<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['product_images', 'products']);

        if ($request->hasFile('logo')) {
            $destLogo = public_path('uploads/clients');
            if (!File::exists($destLogo)) {
                try {
                    File::makeDirectory($destLogo, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/clients: ' . $e->getMessage());
                }
            }

            try {
                $file = $request->file('logo');
                $ext = $file->extension() ?: 'png';
                $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                $file->move($destLogo, $filename);
                $data['logo'] = 'uploads/clients/' . $filename;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload client logo failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal menyimpan logo klien (Permission Denied). Folder uploads/clients tidak memiliki izin tulis di server.');
            }
        }

        $client = Client::create($data);

        if ($request->hasFile('product_images')) {
            $destProducts = public_path('uploads/clients/products');
            if (!File::exists($destProducts)) {
                try {
                    File::makeDirectory($destProducts, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/clients/products: ' . $e->getMessage());
                }
            }

            foreach ($request->file('product_images') as $file) {
                try {
                    $ext = $file->extension() ?: 'jpg';
                    $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                    $file->move($destProducts, $filename);
                    $client->productImages()->create([
                        'image' => 'uploads/clients/products/' . $filename
                    ]);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Upload client product failed: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['product_images', 'products']);

        if ($request->hasFile('logo')) {
            // Delete old image
            if ($client->logo && File::exists(public_path($client->logo))) {
                @unlink(public_path($client->logo));
            }

            $destLogo = public_path('uploads/clients');
            if (!File::exists($destLogo)) {
                try {
                    File::makeDirectory($destLogo, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/clients: ' . $e->getMessage());
                }
            }

            try {
                $file = $request->file('logo');
                $ext = $file->extension() ?: 'png';
                $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                $file->move($destLogo, $filename);
                $data['logo'] = 'uploads/clients/' . $filename;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload client logo failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal memperbarui logo klien (Permission Denied). Folder uploads/clients tidak memiliki izin tulis di server.');
            }
        }

        $client->update($data);

        // Update product dimensions if provided
        if ($request->has('product_dimensions') && is_array($request->input('product_dimensions'))) {
            foreach ($request->input('product_dimensions') as $prodId => $dims) {
                $prod = \App\Models\ClientProduct::find($prodId);
                if ($prod && $prod->client_id == $client->id) {
                    $prod->update([
                        'width'  => !empty($dims['width']) ? (int) $dims['width'] : null,
                        'height' => !empty($dims['height']) ? (int) $dims['height'] : null,
                    ]);
                }
            }
        }

        if ($request->hasFile('product_images')) {
            $destProducts = public_path('uploads/clients/products');
            if (!File::exists($destProducts)) {
                try {
                    File::makeDirectory($destProducts, 0775, true, true);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Could not create directory uploads/clients/products: ' . $e->getMessage());
                }
            }

            foreach ($request->file('product_images') as $file) {
                try {
                    $ext = $file->extension() ?: 'jpg';
                    $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                    $file->move($destProducts, $filename);
                    $client->productImages()->create([
                        'image'  => 'uploads/clients/products/' . $filename,
                        'width'  => 120,
                        'height' => 100,
                    ]);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Upload client product failed: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo && File::exists(public_path($client->logo))) {
            File::delete(public_path($client->logo));
        }
        
        foreach ($client->productImages as $product) {
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
        }
        
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }

    public function deleteProductImage($id)
    {
        $product = \App\Models\ClientProduct::findOrFail($id);
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }
        $product->delete();
        return back()->with('success', 'Product image deleted.');
    }

    /**
     * AJAX endpoint to update product logo/image dimensions directly from resizer modal.
     */
    public function updateProductDimensionAjax(Request $request, $id)
    {
        $product = \App\Models\ClientProduct::findOrFail($id);
        $width = $request->input('width');
        $height = $request->input('height');

        $product->update([
            'width'  => !empty($width) ? (int) $width : null,
            'height' => !empty($height) ? (int) $height : null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Ukuran logo produk berhasil diperbarui!',
            'product_id' => $product->id,
            'width' => $product->width,
            'height' => $product->height,
        ]);
    }
}
