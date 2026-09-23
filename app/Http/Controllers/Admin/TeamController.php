<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Services\TranslationService;

class TeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('priority', 'asc')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'role_id' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'quote_en' => 'nullable|string',
            'quote_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'priority' => 'required|integer',
        ]);

        // Auto-translate if English fields are empty
        if (empty($validated['role_en']) && !empty($validated['role_id'])) {
            $validated['role_en'] = TranslationService::translate($validated['role_id']);
        }
        if (empty($validated['quote_en']) && !empty($validated['quote_id'])) {
            $validated['quote_en'] = TranslationService::translate($validated['quote_id']);
        }
        if (empty($validated['description_en']) && !empty($validated['description_id'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        if ($request->hasFile('image')) {
            $destDir = public_path('uploads/team');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    Log::warning('Could not create directory uploads/team: ' . $e->getMessage());
                }
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($destDir, $imageName);
                $validated['photo_path'] = 'uploads/team/' . $imageName;
            } catch (\Throwable $e) {
                Log::error('Upload team image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal menyimpan foto tim (Permission Denied). Folder uploads/team tidak dapat ditulis oleh web server di server Linux. Mohon periksa hak akses folder di server.');
            }
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        // Route model binding matches $team
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'role_id' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'quote_en' => 'nullable|string',
            'quote_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'priority' => 'required|integer',
        ]);

        if (empty($validated['role_en']) && !empty($validated['role_id'])) {
            $validated['role_en'] = TranslationService::translate($validated['role_id']);
        }
        if (empty($validated['quote_en']) && !empty($validated['quote_id'])) {
            $validated['quote_en'] = TranslationService::translate($validated['quote_id']);
        }
        if (empty($validated['description_en']) && !empty($validated['description_id'])) {
            $validated['description_en'] = TranslationService::translate($validated['description_id']);
        }

        if ($request->hasFile('image')) {
            // Delete old photo if exists
            if ($team->photo_path && File::exists(public_path($team->photo_path))) {
                @unlink(public_path($team->photo_path));
            }

            $destDir = public_path('uploads/team');
            if (!File::exists($destDir)) {
                try {
                    File::makeDirectory($destDir, 0775, true, true);
                } catch (\Throwable $e) {
                    Log::warning('Could not create directory uploads/team: ' . $e->getMessage());
                }
            }

            try {
                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($destDir, $imageName);
                $validated['photo_path'] = 'uploads/team/' . $imageName;
            } catch (\Throwable $e) {
                Log::error('Upload team image failed: ' . $e->getMessage());
                return back()->withInput()->with('error', 'Gagal memperbarui foto tim (Permission Denied). Folder uploads/team tidak dapat ditulis oleh web server di server Linux. Mohon periksa hak akses folder di server.');
            }
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        // Delete photo if exists
        if ($team->photo_path && File::exists(public_path($team->photo_path))) {
            @unlink(public_path($team->photo_path));
        }

        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
