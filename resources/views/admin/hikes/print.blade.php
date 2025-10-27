<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hike Schedule Details - {{ $hike->trail }} ({{ $hike->date }})</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: white;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c5530;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2c5530;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .schedule-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2c5530;
        }

        .info-section h3 {
            color: #2c5530;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px dotted #ddd;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            color: #555;
        }

        .info-value {
            color: #333;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-open { background: #d4edda; color: #155724; }
        .status-full { background: #fff3cd; color: #856404; }
        .status-closed { background: #f8d7da; color: #721c24; }

        .bookings-section {
            margin-top: 30px;
        }

        .bookings-section h3 {
            color: #2c5530;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bookings-table th {
            background: #2c5530;
            color: white;
            font-weight: bold;
        }

        .bookings-table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e9ecef;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2c5530;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        @media print {
            body {
                padding: 0;
            }
            
            .header {
                margin-bottom: 20px;
            }
            
            .schedule-info {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mt. Cagua Hiking Schedule</h1>
        <p>Detailed Schedule and Booking Information</p>
    </div>

    <div class="schedule-info">
        <div class="info-section">
            <h3>Schedule Details</h3>
            <div class="info-item">
                <span class="info-label">Date:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($hike->date)->format('F j, Y') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Start Time:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($hike->start_time)->format('g:i A') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Trail:</span>
                <span class="info-value">{{ $hike->trail }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Difficulty:</span>
                <span class="info-value">{{ ucfirst($hike->difficulty) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    <span class="status-badge status-{{ $hike->status }}">{{ ucfirst($hike->status) }}</span>
                </span>
            </div>
        </div>

        <div class="info-section">
            <h3>Capacity & Pricing</h3>
            <div class="info-item">
                <span class="info-label">Total Capacity:</span>
                <span class="info-value">{{ $hike->capacity }} hikers</span>
            </div>
            <div class="info-item">
                <span class="info-label">Current Bookings:</span>
                <span class="info-value">{{ $hike->current_bookings }} hikers</span>
            </div>
            <div class="info-item">
                <span class="info-label">Available Slots:</span>
                <span class="info-value">{{ $hike->capacity - $hike->current_bookings }} hikers</span>
            </div>
            <div class="info-item">
                <span class="info-label">Price per Person:</span>
                <span class="info-value">₱{{ number_format($hike->price, 2) }}</span>
            </div>
            @if($hike->notes)
            <div class="info-item">
                <span class="info-label">Notes:</span>
                <span class="info-value">{{ $hike->notes }}</span>
            </div>
            @endif
        </div>
    </div>

    @if($hike->bookings->count() > 0)
    <div class="bookings-section">
        <h3>Booking Details ({{ $hike->bookings->count() }} {{ Str::plural('booking', $hike->bookings->count()) }})</h3>
        
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Guest Name</th>
                    <th>Contact</th>
                    <th>Tourists</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hike->bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->user->contact_number }}</td>
                    <td>{{ $booking->foreign_tourists + $booking->local_tourists }}</td>
                    <td>₱{{ number_format($booking->total_amount, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $booking->status }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    </td>
                    <td>{{ $booking->created_at->format('M j, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $hike->capacity - $hike->current_bookings }}</div>
            <div class="stat-label">Available Slots</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">₱{{ number_format($hike->bookings->where('status', '!=', 'cancelled')->sum('total_amount'), 2) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $hike->bookings->whereIn('status', ['approved', 'completed'])->count() }}</div>
            <div class="stat-label">Confirmed Bookings</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $hike->bookings->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending Bookings</div>
        </div>
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('F j, Y \a\t g:i A') }} | Mt. Cagua Hiking Management System</p>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>