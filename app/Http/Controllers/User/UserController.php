<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Announcement;
use App\Models\Payment;
use App\Models\Message;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Stats
        $upcomingCount = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        $completedCount = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $pendingVerificationCount = Payment::whereHas('booking', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'pending_verification')
            ->count();

        $unreadMessages = Message::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        // Lists
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $latestAnnouncements = Announcement::active()
            ->latest()
            ->take(3)
            ->get();

        $stats = [
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'pendingVerificationCount' => $pendingVerificationCount,
            'unreadMessages' => $unreadMessages,
        ];

        return view('user.dashboard', compact(
            'user',
            'stats',
            'upcomingBookings',
            'latestAnnouncements'
        ));
    }
}
