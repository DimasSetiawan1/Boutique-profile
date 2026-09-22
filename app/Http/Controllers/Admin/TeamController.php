<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'role_en' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'quote_en' => 'nullable|string',
            'quote_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'priority' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/team'), $imageName);
            $validated['photo_path'] = 'uploads/team/' . $imageName;
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
            'role_en' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'quote_en' => 'nullable|string',
            'quote_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'priority' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old photo if exists
            if ($team->photo_path && File::exists(public_path($team->photo_path))) {
                File::delete(public_path($team->photo_path));
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/team'), $imageName);
            $validated['photo_path'] = 'uploads/team/' . $imageName;
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        // Delete photo if exists
        if ($team->photo_path && File::exists(public_path($team->photo_path))) {
            File::delete(public_path($team->photo_path));
        }

        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
