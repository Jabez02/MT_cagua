<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-bold text-primary mb-0">
                <i class="bi bi-compass me-2"></i>{{ __('Explore Available Hikes') }}
            </h2>
        </div>
    </x-slot>

    <style>
        .hike-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            border: none;
        }
        
        .hike-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .hike-date {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .hike-trail {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .hike-info {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #555;
        }
        
        .hike-info i {
            margin-right: 8px;
            color: #4e73df;
        }
        
        .book-btn {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(78, 115, 223, 0.25);
        }
        
        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(78, 115, 223, 0.3);
            background: linear-gradient(135deg, #3a5cc9 0%, #1a3a9c 100%);
        }
        
        .book-btn:active {
            transform: translateY(0);
        }
        
        .availability {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .availability.good {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }
        
        .availability.limited {
            background-color: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }
        
        .availability.low {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: #f8f9fc;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #b7b9cc;
            margin-bottom: 15px;
        }
        
        .pagination {
            justify-content: center;
        }
    </style>

    <div class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse ($hikes as $hike)
                    <div class="col-md-6 col-lg-4">
                        <div class="card hike-card shadow-sm">
                            <div class="card-body p-4">
                                <div class="hike-date">
                                    <div class="small text-white-50">{{ $hike->date->format('l') }}</div>
                                    <div class="fs-5">{{ $hike->date->format('M d, Y') }}</div>
                                </div>
                                
                                <h3 class="hike-trail">{{ $hike->trail }}</h3>
                                
                                <div class="hike-info">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $hike->start_time->format('h:i A') }} start time</span>
                                </div>
                                
                                <div class="hike-info">
                                    <i class="bi bi-people"></i>
                                    <span>
                                        @php
                                            $available = $hike->capacity - $hike->current_bookings;
                                            $percentFull = ($hike->current_bookings / $hike->capacity) * 100;
                                            $availabilityClass = $percentFull > 80 ? 'low' : ($percentFull > 50 ? 'limited' : 'good');
                                            $availabilityText = $percentFull > 80 ? 'Almost Full' : ($percentFull > 50 ? 'Filling Up' : 'Available');
                                        @endphp
                                        <strong>{{ $available }}</strong> of <strong>{{ $hike->capacity }}</strong> slots available
                                    </span>
                                </div>
                                
                                <div class="availability {{ $availabilityClass }}">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.6rem;"></i>
                                    {{ $availabilityText }}
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('user.bookings.create', $hike) }}" 
                                       class="btn btn-primary book-btn w-100">
                                        <i class="bi bi-calendar-check me-2"></i>Book This Hike
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-calendar-x"></i>
                            <h4 class="mt-2">No Available Hikes</h4>
                            <p class="text-muted">There are currently no scheduled hikes available for booking.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5">
                {{ $hikes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>