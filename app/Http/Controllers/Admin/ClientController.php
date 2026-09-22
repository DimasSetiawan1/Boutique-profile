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
            $file = $request->file('logo');
            $ext = $file->extension() ?: 'png';
            $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
            $file->move(public_path('uploads/clients'), $filename);
            $data['logo'] = 'uploads/clients/' . $filename;
        }

        $client = Client::create($data);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $ext = $file->extension() ?: 'jpg';
                $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                $file->move(public_path('uploads/clients/products'), $filename);
                $client->productImages()->create([
                    'image' => 'uploads/clients/products/' . $filename
                ]);
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
                File::delete(public_path($client->logo));
            }

            $file = $request->file('logo');
            $ext = $file->extension() ?: 'png';
            $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
            $file->move(public_path('uploads/clients'), $filename);
            $data['logo'] = 'uploads/clients/' . $filename;
        }

        $client->update($data);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $ext = $file->extension() ?: 'jpg';
                $filename = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . $ext;
                $file->move(public_path('uploads/clients/products'), $filename);
                $client->productImages()->create([
                    'image' => 'uploads/clients/products/' . $filename
                ]);
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
}
