<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\TranslationService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_id' => 'required|string',
        ]);

        $validated['category'] = $request->input('category') ?: 'General';

        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['description_en'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_id' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_id' => 'required|string',
        ]);

        $validated['category'] = $request->input('category') ?: ($service->category ?? 'General');

        if (empty($validated['title_en'])) {
            $validated['title_en'] = TranslationService::translate($validated['title_id']);
        }
        if (empty($validated['description_en'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
