@push('styles')
<style>
    .btn-primary {
        @apply inline-flex px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .date-range-select {
        @apply bg-white border border-gray-300 rounded-md px-3 py-2 text-sm leading-5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500;
    }
    .stats-card {
        @apply p-4 rounded-lg shadow;
    }
    .stats-title {
        @apply text-gray-500;
    }
    .stats-value {
        @apply text-2xl font-bold;
    }
</style>
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analytics Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <select id="date-range" class="report-date-range-select">
                        <option value="7">{{ __('Last 7 Days') }}</option>
                        <option value="30" selected>{{ __('Last 30 Days') }}</option>
                        <option value="90">{{ __('Last 90 Days') }}</option>
                        <option value="365">{{ __('Last Year') }}</option>
                        <option value="custom">{{ __('Custom Range') }}</option>
                    </select>
                </div>
                <button id="export-report" class="report-btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('Export Report') }}
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Booking Statistics') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="report-stats-card">
                            <h4 class="report-stats-title">{{ __('Total Bookings') }}</h4>
                            <p class="report-stats-value">{{ $totalBookings }}</p>
                        </div>
                        <div class="report-stats-card">
                            <h4 class="report-stats-title">{{ __('Completed Bookings') }}</h4>
                            <p class="report-stats-value">{{ $completedBookings }}</p>
                        </div>
                        <div class="report-stats-card">
                            <h4 class="report-stats-title">{{ __('Pending Bookings') }}</h4>
                            <p class="report-stats-value">{{ $pendingBookings }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
