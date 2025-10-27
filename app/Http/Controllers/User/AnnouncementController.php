<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of active announcements.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');

        $announcements = Announcement::with('creator')
            ->active()
            ->when($type, fn($query) => $query->ofType($type))
            ->latest()
            ->paginate(15);

        $types = Announcement::getTypes();

        return view('user.announcements.index', compact('announcements', 'types', 'type'));
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        if (!$announcement->isActive()) {
            abort(404);
        }

        return view('user.announcements.show', compact('announcement'));
    }
}
