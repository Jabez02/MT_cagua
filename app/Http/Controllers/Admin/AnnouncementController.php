<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $status = $request->get('status', 'active');

        $announcements = Announcement::with('creator')
            ->when($type, fn($query) => $query->ofType($type))
            ->when($status === 'active', fn($query) => $query->active())
            ->when($status === 'expired', fn($query) => $query->expired())
            ->latest()
            ->paginate(15);

        $types = Announcement::getTypes();

        return view('admin.announcements.index', compact('announcements', 'types', 'type', 'status'));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        $types = Announcement::getTypes();
        return view('admin.announcements.create', compact('types'));
    }

    /**
     * Store a newly created announcement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:' . implode(',', Announcement::getTypes()),
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_active'] = $request->boolean('is_active', true);

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit(Announcement $announcement)
    {
        $types = Announcement::getTypes();
        return view('admin.announcements.edit', compact('announcement', 'types'));
    }

    /**
     * Update the specified announcement.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:' . implode(',', Announcement::getTypes()),
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
