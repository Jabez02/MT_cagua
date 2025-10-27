<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Hike;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index(Request $request)
    {
        // Get date range from request or default to last 30 days
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);

        // Get booking statistics
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        return view('admin.reports.index', compact(
            'totalBookings',
            'completedBookings',
            'pendingBookings'
        ));
    }
}



