<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes to improve performance
        $dashboardData = Cache::remember('admin_dashboard_data', 300, function () {
            return $this->getDashboardData();
        });

        return view('admin.dashboard', $dashboardData);
    }

    private function getDashboardData()
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();
        $lastWeek = $now->copy()->subWeek();
        $today = $now->copy()->startOfDay();
        $yesterday = $today->copy()->subDay();

        // Current Statistics
        $stats = [
            'total_users' => User::count(),
            'total_bookings' => Booking::count(),
            'pending_reviews' => Review::where('is_verified', false)->count(),
            'revenue_this_month' => Booking::whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year)
                ->sum('total_amount') ?? 0,
        ];

        // Historical data for percentage calculations
        $previousStats = [
            'users_last_month' => User::where('created_at', '<', $lastMonth->endOfMonth())->count(),
            'bookings_last_week' => Booking::where('created_at', '<', $lastWeek->endOfWeek())->count(),
            'revenue_last_month' => Booking::whereMonth('created_at', $lastMonth->month)
                ->whereYear('created_at', $lastMonth->year)
                ->sum('total_amount') ?? 0,
            'bookings_yesterday' => Booking::whereDate('created_at', $yesterday)->count(),
            'bookings_today' => Booking::whereDate('created_at', $today)->count(),
        ];

        // Calculate percentage changes
        $percentageChanges = [
            'users_change' => $this->calculatePercentageChange($previousStats['users_last_month'], $stats['total_users']),
            'bookings_change' => $this->calculatePercentageChange($previousStats['bookings_last_week'], $stats['total_bookings']),
            'revenue_change' => $this->calculatePercentageChange($previousStats['revenue_last_month'], $stats['revenue_this_month']),
            'reviews_change' => $this->calculateDailyChange($previousStats['bookings_yesterday'], $previousStats['bookings_today']),
        ];

        // Chart data - Last 30 days bookings
        $bookingsChartData = $this->getBookingsChartData();
        
        // Chart data - Last 6 months revenue
        $revenueChartData = $this->getRevenueChartData();

        // Combine chart data into expected structure
        $chartData = [
            'bookings' => $bookingsChartData,
            'revenue' => $revenueChartData
        ];

        // Recent activity
        $recentBookings = Booking::with('user')
            ->latest()
            ->take(5)
            ->get();

        return compact(
            'stats',
            'percentageChanges',
            'chartData',
            'recentBookings'
        );
    }

    private function calculatePercentageChange($oldValue, $newValue)
    {
        if ($oldValue == 0) {
            return $newValue > 0 ? 100 : 0;
        }
        
        return round((($newValue - $oldValue) / $oldValue) * 100, 1);
    }

    private function calculateDailyChange($yesterday, $today)
    {
        if ($yesterday == 0) {
            return $today > 0 ? 100 : 0;
        }
        
        return round((($today - $yesterday) / $yesterday) * 100, 1);
    }

    private function getBookingsChartData()
    {
        $data = [];
        $labels = [];
        
        // Get last 4 weeks of booking data
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();
            
            $bookingCount = Booking::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            
            $data[] = $bookingCount;
            $labels[] = 'Week ' . (4 - $i);
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getRevenueChartData()
    {
        $data = [];
        $labels = [];
        
        // Get last 6 months of revenue data
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
            $monthEnd = $monthStart->copy()->endOfMonth();
            
            $revenue = Booking::whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('total_amount') ?? 0;
            
            $data[] = (float) $revenue;
            $labels[] = $monthStart->format('M');
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
