@push('styles')
<link href="{{ asset('css/guide-porter-selection.css') }}" rel="stylesheet">
<style>
    /* Modern UI Variables */
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --primary-light: #dbeafe;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1f2937;
        --gray: #6b7280;
        --light-gray: #f3f4f6;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius-sm: 0.375rem;
        --radius: 0.5rem;
        --radius-lg: 0.75rem;
    }

    /* Global Styles */
    body {
        background-color: #f8fafc;
        color: var(--dark);
    }

    .booking-container {
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Card Styles */
    .booking-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .booking-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .booking-card .card-body {
        padding: 1.75rem;
    }

    /* Header & Navigation */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        font-weight: 500;
        text-decoration: none;
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius);
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background-color: var(--primary-light);
        color: var(--primary-hover);
        transform: translateX(-3px);
    }

    /* Professional Single-Page Form Styles */
    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .form-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #e9ecef;
    }

    .form-header h1 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: #6c757d;
        font-size: 1.1rem;
        margin: 0;
    }

    .form-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        padding: 2rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        opacity: 1;
        transform: translateY(0);
        height: auto;
        overflow: visible;
        pointer-events: all;
    }

    .form-section:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .section-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .section-title {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        margin: 0.25rem 0 0 0;
    }

    /* Accordion Functionality */
    .section-header {
        cursor: pointer;
        user-select: none;
        position: relative;
    }

    .section-header:hover {
        background-color: #f8f9fa;
        border-radius: 8px;
        margin: -0.5rem;
        padding: 0.5rem;
    }

    .accordion-toggle {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 1rem;
        color: #6c757d;
    }

    .accordion-toggle:hover {
        background: #007bff;
        color: white;
    }

    .accordion-toggle.collapsed {
        transform: translateY(-50%) rotate(180deg);
    }

    .section-content {
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .section-content.collapsed {
        max-height: 0;
        opacity: 0;
        padding-top: 0;
        padding-bottom: 0;
        margin-top: 0;
        margin-bottom: 0;
    }

    .form-section.collapsed {
        padding-bottom: 1rem;
    }

    /* Form Controls */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .form-control {
        border-radius: var(--radius);
        padding: 0.625rem 0.875rem;
        border: 1px solid #d1d5db;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .input-group {
        border-radius: var(--radius);
        overflow: hidden;
    }

    .input-group .form-control {
        text-align: center;
        font-weight: 500;
    }

    .input-group .btn {
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 500;
    }

    /* Counter Controls */
    .counter-control {
        display: flex;
        align-items: center;
        border: 1px solid #d1d5db;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
    }
    
    .counter-control:hover {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }
    
    .counter-control:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    }

    .counter-btn {
        background: var(--light-gray);
        border: none;
        color: var(--dark);
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .counter-btn:hover {
        background-color: #e5e7eb;
        color: var(--primary);
    }

    .counter-btn:active {
        background-color: var(--primary-light);
        transform: scale(0.95);
    }

    .counter-input {
        border: none;
        text-align: center;
        font-weight: 500;
        width: 3rem;
        padding: 0.5rem;
        background: var(--white);
        color: var(--dark);
        appearance: textfield;
        -moz-appearance: textfield;
    }

    .counter-input::-webkit-outer-spin-button,
    .counter-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .counter-btn {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .counter-btn:hover {
        background: #f3f4f6;
    }

    .counter-input {
        width: 3rem;
        text-align: center;
        border: none;
        font-weight: 500;
        background: transparent;
    }

    /* Radio Toggles */
    .toggle-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .toggle-option {
        position: relative;
    }

    .toggle-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        border-radius: var(--radius);
        border: 1px solid #d1d5db;
        background: var(--white);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .toggle-input:checked + .toggle-label {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
    }

    .toggle-input:focus + .toggle-label {
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Order Summary */
    .order-summary {
        position: sticky;
        top: 1.5rem;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        border: none;
        margin-bottom: 1.5rem;
    }

    .summary-header {
        background: linear-gradient(135deg, var(--primary), #4f46e5);
        color: var(--white);
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1.125rem;
    }

    .summary-body {
        padding: 1.5rem;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        font-weight: 600;
        font-size: 1.125rem;
        color: var(--primary);
    }

    .summary-note {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        font-size: 0.875rem;
        color: var(--gray);
    }

    /* Buttons */
    .btn-primary {
        background: var(--primary);
        border: none;
        border-radius: var(--radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: var(--shadow-sm);
    }

    /* Alerts */
    .alert {
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid transparent;
    }

    .alert-warning {
        background-color: #fffbeb;
        border-color: #fef3c7;
        color: #92400e;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .booking-card .card-body {
            padding: 1.25rem;
        }

        .stepper::before {
            left: 10%;
            right: 10%;
        }

        .toggle-group {
            flex-direction: column;
        }

        .toggle-label {
            width: 100%;
            justify-content: center;
        }
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Sections */
    .form-section {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 0.5rem;
        font-size: 1.1em;
    }

    /* Loading State */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }

    .btn-loading .spinner {
        margin-right: 0.5rem;
    }



    /* Auto-save indicator */
    .auto-save-indicator {
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--success);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-size: 0.85rem;
        font-weight: 500;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: var(--shadow);
    }

    .auto-save-indicator.show {
        opacity: 1;
        transform: translateY(0);
    }

    .auto-save-indicator.saving {
        background: var(--warning);
    }

    /* Enhanced tooltips */
    .tooltip-trigger {
        position: relative;
        cursor: help;
        color: var(--primary);
        margin-left: 0.25rem;
    }

    .custom-tooltip {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: var(--dark);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius);
        font-size: 0.8rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        margin-bottom: 0.5rem;
    }

    .custom-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: var(--dark);
    }

    .tooltip-trigger:hover .custom-tooltip {
        opacity: 1;
        visibility: visible;
    }

    /* Enhanced form validation */
    .form-control.is-invalid {
        border-color: var(--danger);
        box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25);
    }

    .form-control.is-valid {
        border-color: var(--success);
        box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
    }

    .invalid-feedback {
        display: block;
        color: var(--danger);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .valid-feedback {
        display: block;
        color: var(--success);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Enhanced visual hierarchy and spacing */
    .form-section {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .form-section:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control, .form-select {
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--radius);
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        background-color: var(--white);
        transform: translateY(-1px);
    }

    .form-control:hover, .form-select:hover {
        border-color: #d1d5db;
        background-color: var(--white);
    }

    /* Enhanced toggle groups */
    .toggle-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 0.5rem;
    }

    .toggle-label {
        background: #f8fafc;
        border: 2px solid #e5e7eb;
        border-radius: var(--radius);
        padding: 1rem 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 120px;
        justify-content: center;
    }

    .toggle-label:hover {
        border-color: var(--primary);
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .toggle-input:checked + .toggle-label {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }

    /* Enhanced section headers */
    .section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem 0;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 2px solid #f1f5f9;
        margin-bottom: 1.5rem;
    }

    .section-header:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: var(--radius);
        padding: 1.5rem 1rem;
        margin: 0 -1rem 1.5rem -1rem;
    }

    .section-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: var(--shadow);
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .section-subtitle {
        color: var(--gray);
        font-size: 0.9rem;
        margin: 0.25rem 0 0 0;
        font-weight: 400;
    }

    /* Enhanced buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
        border: none;
        padding: 0.875rem 2rem;
        font-weight: 600;
        border-radius: var(--radius);
        transition: all 0.3s ease;
        box-shadow: var(--shadow);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-hover) 0%, #2563eb 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    /* Enhanced mobile responsiveness */
    @media (max-width: 768px) {
        .booking-container {
            padding: 1rem 0.5rem;
        }

        .form-section {
            padding: 1.5rem;
            margin-bottom: 2rem;
        }



        .toggle-group {
            flex-direction: column;
        }

        .toggle-label {
            width: 100%;
            min-width: auto;
        }

        .section-header {
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .auto-save-indicator {
            top: 10px;
            right: 10px;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .custom-tooltip {
            position: fixed;
            left: 50% !important;
            transform: translateX(-50%) !important;
            bottom: auto !important;
            top: 50% !important;
            white-space: normal;
            max-width: 280px;
            text-align: center;
        }
    }

    /* Touch-friendly interactions */
    @media (hover: none) and (pointer: coarse) {
        .toggle-label {
            padding: 1.2rem 1.5rem;
            font-size: 1rem;
        }

        .form-control, .form-select {
            padding: 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .section-header {
            padding: 1.75rem 0;
        }

        .accordion-toggle {
            padding: 0.5rem;
        }
    }
</style>
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <h2 class="fs-4 fw-semibold text-body mb-0">{{ __('Create Custom Booking') }}</h2>
            <a href="{{ route('user.bookings.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> 
                <span>{{ __('Back to Bookings') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-5 fade-in">
        <div class="booking-container">
            <div class="form-header">
                <h1>{{ __('Create Your Hiking Experience') }}</h1>
                <p>{{ __('Plan your perfect mountain adventure with our comprehensive booking system') }}</p>
            </div>



            <!-- Auto-save indicator -->
            <div class="auto-save-indicator" id="autoSaveIndicator">
                <i class="bi bi-check-circle me-1"></i>
                <span id="autoSaveText">{{ __('Saved') }}</span>
            </div>

            <div class="booking-card card">
                <div class="card-body">
                    
                    <!-- Display Validation Errors -->
                    @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <h6 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif
                    
                    <!-- Booking Form -->
                    <form action="{{ route('user.bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Left Column - Form Fields -->
                            <div class="col-lg-8">
                                <!-- Trek Details Section -->
                                <div class="form-section" id="trek-section">
                                    <div class="section-header" onclick="toggleAccordion('trek-section')">
                                        <div class="section-icon">
                                            <i class="bi bi-calendar-event"></i>
                                        </div>
                                        <div>
                                            <h3 class="section-title">{{ __('Trek Details') }}</h3>
                                            <p class="section-subtitle">{{ __('Choose your hiking experience') }}</p>
                                        </div>
                                        <div class="accordion-toggle">
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content"
                                    @if(!$hike)
                                    <!-- Custom Booking Type Selection -->
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-12">
                                            <label class="form-label">{{ __('Booking Type') }}</label>
                                            <div class="btn-group w-100" role="group" aria-label="Booking type">
                                                <input type="radio" class="btn-check" name="booking_type" id="custom_booking" value="custom" checked>
                                                <label class="btn btn-outline-primary" for="custom_booking">
                                                    <i class="bi bi-plus-circle me-2"></i>{{ __('Create Custom Booking') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <!-- Pre-selected Trek -->
                                    <input type="hidden" name="booking_type" value="custom">
                                    <div class="row g-4 mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">{{ __('Selected Trek') }}</label>
                                            <div class="bg-light p-3 rounded-3">
                                                <p class="mb-1">
                                                    <i class="bi bi-calendar3 text-primary me-2"></i>
                                                    <strong>{{ $hike->date->format('M d, Y') }} - {{ $hike->start_time->format('h:i A') }}</strong>
                                                </p>
                                                <p class="mb-1">
                                                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                                    <strong>{{ $hike->trail }}</strong>
                                                </p>
                                                <p class="mb-0">
                                                    <i class="bi bi-people text-primary me-2"></i>
                                                    {{ $hike->capacity - $hike->current_bookings }} slots available
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Custom Booking Fields -->
                                    <div class="row g-4 mb-3" id="custom-booking-section">
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle me-2"></i>
                                                {{ __('Create a custom booking by filling in the details below') }}
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="custom_trek_date" class="form-label">
                                                {{ __('Date of Trek') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="custom_trek_date" id="custom_trek_date" 
                                                value="{{ old('custom_trek_date') }}"
                                                class="form-control"
                                                min="{{ date('Y-m-d') }}">
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                {{ __('Select your preferred trek date') }}
                                            </small>
                                            @error('custom_trek_date')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="custom_start_time" class="form-label">
                                                {{ __('Start Time') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="custom_start_time" id="custom_start_time" class="form-select">
                                                <option value="">{{ __('Select start time') }}</option>
                                                <optgroup label="{{ __('Day Hike') }}">
                                                    <option value="05:30">5:30 AM</option>
                                                    <option value="06:00">6:00 AM</option>
                                                    <option value="07:00">7:00 AM</option>
                                                </optgroup>
                                                <optgroup label="{{ __('Overnight') }}">
                                                    <option value="10:00">10:00 AM</option>
                                                    <option value="11:00">11:00 AM</option>
                                                    <option value="12:00">12:00 PM</option>
                                                    <option value="13:00">1:00 PM</option>
                                                </optgroup>
                                            </select>
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                {{ __('Day Trek: 5:30-7:00 AM | Overnight: 10:00 AM-1:00 PM') }}
                                            </small>
                                            @error('custom_start_time')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label for="custom_trail" class="form-label">
                                                {{ __('Trail') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="custom_trail" id="custom_trail" class="form-select">
                                                <option value="">{{ __('Select trail') }}</option>
                                                <option value="Sta. Clara Trail (Back-Trail Only)">Sta. Clara Trail (Back-Trail Only)</option>
                                                <option value="Sta. Clara Trail (Front-Trail Only)">Sta. Clara Trail (Front-Trail Only)</option>
                                                <option value="Sta. Clara Trail (Full Trail)">Sta. Clara Trail (Full Trail)</option>
                                                <option value="Custom Trail">{{ __('Other (specify below)') }}</option>
                                            </select>
                                            @error('custom_trail')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12" id="custom-trail-input" style="display: none;">
                                            <label for="custom_trail_name" class="form-label">
                                                {{ __('Custom Trail Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="custom_trail_name" id="custom_trail_name" 
                                                value="{{ old('custom_trail_name') }}"
                                                class="form-control"
                                                placeholder="{{ __('Enter custom trail name') }}">
                                            @error('custom_trail_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row g-4 mb-3" id="trek-details" @if(!$hike) style="display: none;" @endif>
                                        <div class="col-md-6">
                                            <label for="trek_date" class="form-label">
                                                {{ __('Date of Trek') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="trek_date" id="trek_date" 
                                                value="{{ old('trek_date', $hike ? $hike->date->format('Y-m-d') : '') }}"
                                                class="form-control"
                                                {{ $hike ? 'readonly' : '' }}>
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                {{ __('Select your preferred trek date') }}
                                            </small>
                                            @error('trek_date')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="start_time" class="form-label">
                                                {{ __('Start Time') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="start_time" id="start_time" class="form-select" {{ $hike ? 'disabled' : '' }}>
                                                <option value="">{{ __('Select start time') }}</option>
                                                <optgroup label="{{ __('Day Trek') }}">
                                                    <option value="05:30" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '05:30' ? 'selected' : '' }}>5:30 AM</option>
                                                    <option value="06:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '06:00' ? 'selected' : '' }}>6:00 AM</option>
                                                    <option value="07:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '07:00' ? 'selected' : '' }}>7:00 AM</option>
                                                </optgroup>
                                                <optgroup label="{{ __('Overnight') }}">
                                                    <option value="10:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                                    <option value="11:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                                    <option value="12:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                                    <option value="13:00" {{ old('start_time', $hike ? $hike->start_time->format('H:i') : '') == '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                                </optgroup>
                                            </select>
                                            @if($hike)
                                                <input type="hidden" name="start_time" value="{{ $hike->start_time->format('H:i') }}">
                                            @endif
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                {{ __('Day Trek: 5:30-7:00 AM | Overnight: 10:00 AM-1:00 PM') }}
                                            </small>
                                            @error('start_time')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row g-4 mb-3" id="trail-info-section" @if(!$hike) style="display: none;" @endif>
                                        <div class="col-md-12">
                                            <label class="form-label" for="trail-info">{{ __('Trail') }}</label>
                                            <div class="bg-light p-3 rounded-3" id="trail-info">
                                                <p class="mb-0">
                                                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                                    <strong id="trail-name">{{ $hike ? $hike->trail : 'Sta. Clara Trail (Back-Trail Only)' }}</strong>
                                                </p>
                                                <small class="text-muted" id="trail-description">{{ $hike ? 'Selected from trek schedule' : 'Default trail for all bookings' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <!-- Guests Section -->
                                <div class="form-section" id="guests-section">
                                    <div class="section-header" onclick="toggleAccordion('guests-section')">
                                        <div class="section-icon">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div>
                                            <h3 class="section-title">{{ __('Guest Information') }}</h3>
                                            <p class="section-subtitle">{{ __('Specify the number of tourists') }}</p>
                                        </div>
                                        <div class="accordion-toggle">
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                    <div class="row g-4 mb-3">
                                        <div class="col-md-6">
                                            <label for="foreign_tourists" class="form-label">
                                                {{ __('Number of Foreign Tourists') }}
                                            </label>
                                            <div class="counter-control">
                                                <button type="button" class="counter-btn" data-counter="foreign_tourists" data-action="decrement">−</button>
                                                <input type="number" name="foreign_tourists" id="foreign_tourists" min="0"
                                                    value="{{ old('foreign_tourists', 0) }}"
                                                    class="counter-input"
                                                    aria-describedby="foreignHelp">
                                                <button type="button" class="counter-btn" data-counter="foreign_tourists" data-action="increment">+</button>
                                            </div>
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                ₱{{ number_format(config('payment.fees.tourist.foreign', 350), 0) }} per person
                                            </small>
                                            @error('foreign_tourists')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="local_tourists" class="form-label">
                                                {{ __('Number of Local Tourists') }}
                                            </label>
                                            <div class="counter-control">
                                                <button type="button" class="counter-btn" data-counter="local_tourists" data-action="decrement">−</button>
                                                <input type="number" name="local_tourists" id="local_tourists" min="0"
                                                    value="{{ old('local_tourists', 0) }}"
                                                    class="counter-input"
                                                    aria-describedby="localHelp">
                                                <button type="button" class="counter-btn" data-counter="local_tourists" data-action="increment">+</button>
                                            </div>
                                            <small class="text-muted d-block mt-2">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                ₱{{ number_format(config('payment.fees.tourist.local', 180), 0) }} per person
                                            </small>
                                            @error('local_tourists')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nationality Input for Foreign Tourists -->
                                    <div id="nationality-section" class="mb-3" style="display: none;">
                                        <label for="foreign_nationalities" class="form-label fw-semibold">
                                            {{ __('Nationalities of Foreign Tourists') }}
                                        </label>
                                        <input type="text" name="foreign_nationalities" id="foreign_nationalities"
                                               class="form-control @error('foreign_nationalities') is-invalid @enderror"
                                               value="{{ old('foreign_nationalities') }}"
                                               placeholder="{{ __('e.g., American, Japanese, Korean') }}">
                                        @error('foreign_nationalities')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @error('tourists')
                                        <p class="text-danger small mb-2">{{ $message }}</p>
                                    @enderror

                                    <div id="capacityWarning" class="alert alert-warning d-none" role="status" aria-live="polite">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        {{ __('Requested guests exceed available slots. Please reduce the count.') }}
                                    </div>
                                </div>
                                </div>

                                <!-- Preferences Section -->
                <div class="form-section" id="preferences-section">
                    <div class="section-header" onclick="toggleAccordion('preferences-section')">
                        <div class="section-icon">
                            <i class="bi bi-sliders"></i>
                        </div>
                        <div>
                            <h3 class="section-title">{{ __('Preferences') }}</h3>
                            <p class="section-subtitle">{{ __('Customize your hiking experience') }}</p>
                        </div>
                        <div class="accordion-toggle">
                            <i class="bi bi-chevron-up"></i>
                        </div>
                    </div>
                    
                    <div class="section-content">
                                    <!-- Length of Stay -->
                                    <div class="mb-4">
                                        <label class="form-label" for="length-of-stay-group">{{ __('Length of Stay') }}</label>
                                        <div class="toggle-group" id="length-of-stay-group">
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="length_of_stay" id="stay_day" value="day_hike" {{ old('length_of_stay', '') === 'day_hike' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="stay_day">
                                                    <i class="bi bi-sun"></i>
                                                    {{ __('Day Trek') }}
                                                </label>
                                            </div>
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="length_of_stay" id="stay_overnight" value="overnight" {{ old('length_of_stay', '') === 'overnight' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="stay_overnight">
                                                    <i class="bi bi-moon"></i>
                                                    {{ __('Overnight') }}
                                                </label>
                                            </div>
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="length_of_stay" id="stay_other" value="other" {{ old('length_of_stay', '') === 'other' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="stay_other">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ __('Other') }}
                                                </label>
                                            </div>
                                        </div>
                                        @error('length_of_stay')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Transportation -->
                                    <div class="mb-4">
                                        <label class="form-label" for="transportation-group">{{ __('Transportation') }}</label>
                                        <div class="toggle-group" id="transportation-group">
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="transportation" id="transport_own" value="own_vehicle" {{ old('transportation', '') === 'own_vehicle' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="transport_own">
                                                    <i class="bi bi-car-front"></i>
                                                    {{ __('Own Vehicle') }}
                                                </label>
                                            </div>
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="transportation" id="transport_trike" value="rent_trike" {{ old('transportation', '') === 'rent_trike' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="transport_trike">
                                                    <i class="bi bi-bicycle"></i>
                                                    {{ __('Rent Tricycle') }}
                                                    <small class="d-block text-muted">₱{{ number_format(config('payment.fees.tricycle_rental', 800), 0) }} ({{ __('up to 4 persons') }})</small>
                                                </label>
                                            </div>
                                        </div>
                                        @error('transportation')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Meeting Place -->
                                    <div class="mb-4">
                                        <label class="form-label" for="meeting-place-group">{{ __('Meeting Place') }}</label>
                                        <div class="toggle-group" id="meeting-place-group">
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="meeting_place" id="place_office" value="tourism_office" {{ old('meeting_place', '') === 'tourism_office' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="place_office">
                                                    <i class="bi bi-building"></i>
                                                    {{ __('Tourism Office') }}
                                                </label>
                                            </div>
                                            <div class="toggle-option">
                                                <input type="radio" class="toggle-input" name="meeting_place" id="place_museum" value="museum" {{ old('meeting_place', '') === 'museum' ? 'checked' : '' }}>
                                                <label class="toggle-label" for="place_museum">
                                                    <i class="bi bi-bank"></i>
                                                    {{ __('Museum') }}
                                                </label>
                                            </div>
                                        </div>
                                        @error('meeting_place')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                </div>

                                <!-- Staff Assignment Notice -->
                                <div class="form-section" id="staff-notice-section">
                                    <div class="alert alert-info d-flex align-items-center">
                                        <i class="bi bi-info-circle me-3 fs-4"></i>
                                        <div>
                                            <h5 class="mb-1">{{ __('Guide & Porter Assignment') }}</h5>
                                            <p class="mb-0">{{ __('Our team will assign the best available guide and porter for your custom hiking experience based on your preferences and requirements.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Health Section -->
                                <div class="form-section" id="health-section">
                                    <div class="section-header" onclick="toggleAccordion('health-section')">
                                        <div class="section-icon">
                                            <i class="bi bi-heart-pulse"></i>
                                        </div>
                                        <div>
                                            <h3 class="section-title">{{ __('Health & Notes') }}</h3>
                                            <p class="section-subtitle">{{ __('Help us ensure your safety') }}</p>
                                        </div>
                                        <div class="accordion-toggle">
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                    <!-- Health Issues -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            {{ __('Do you have any of the following health conditions?') }}
                                        </label>
                                        <input type="hidden" name="health_issues" value="">
                                        <div class="mb-2">
                                            <div class="form-check">
                                                <input type="checkbox" name="health_issues[]" id="asthma" value="asthma"
                                                       class="form-check-input" {{ in_array('asthma', old('health_issues', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="asthma">{{ __('Asthma') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="health_issues[]" id="hypertension" value="hypertension"
                                                       class="form-check-input" {{ in_array('hypertension', old('health_issues', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hypertension">{{ __('Hypertension') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="health_issues[]" id="cardiovascular" value="cardiovascular"
                                                       class="form-check-input" {{ in_array('cardiovascular', old('health_issues', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="cardiovascular">{{ __('Cardiovascular Disease') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="health_issues[]" id="none" value="none"
                                                       class="form-check-input" {{ in_array('none', old('health_issues', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="none">{{ __('None of the above') }}</label>
                                            </div>
                                        </div>

                                        <!-- Other health issues input -->
                                        <div class="mt-3">
                                            <label for="other_health_issues" class="form-label">{{ __('Other (please specify)') }}</label>
                                            <input type="text" name="other_health_issues" id="other_health_issues"
                                                   class="form-control"
                                                   placeholder="{{ __('Specify other health conditions...') }}"
                                                   value="{{ old('other_health_issues') }}">
                                        </div>
                                        
                                        @error('health_issues')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Special Requests -->
                                    <div class="mb-4">
                                        <label for="special_requests" class="form-label fw-semibold">{{ __('Special Requests or Notes') }}</label>
                                        <textarea name="special_requests" id="special_requests" rows="3"
                                            class="form-control"
                                            placeholder="{{ __('Any special requests or requests...') }}">{{ old('special_requests') }}</textarea>
                                        @error('special_requests')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                </div>

                                <!-- Payment Section -->
                                <div class="form-section" id="payment-section">
                                    <div class="section-header" onclick="toggleAccordion('payment-section')">
                                        <div class="section-icon">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                        <div>
                                            <h3 class="section-title">{{ __('Payment') }}</h3>
                                            <p class="section-subtitle">{{ __('Complete your booking') }}</p>
                                        </div>
                                        <div class="accordion-toggle">
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="section-content">
                                    <!-- Payment Method -->
                                    <div class="mb-4">
                                        <label for="payment_method" class="form-label fw-semibold">
                                            {{ __('Payment Method') }}
                                        </label>
                                        <select name="payment_method" id="payment_method" class="form-select" required>
                                            <option value="">{{ __('Select payment method') }}</option>
                                            @foreach($paymentMethods as $method)
                                                <option value="{{ $method->code }}"
                                                    data-fee-percentage="{{ $method->fee_percentage }}"
                                                    data-fee-fixed="{{ $method->fee_fixed }}"
                                                    {{ old('payment_method') == $method->code ? 'selected' : '' }}>
                                                    {{ $method->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('payment_method')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Terms and Conditions -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="terms_agreed" id="terms_agreed"
                                                class="form-check-input @error('terms_agreed') is-invalid @enderror"
                                                {{ old('terms_agreed') ? 'checked' : '' }}>
                                            <div class="ms-2">
                                                <label class="form-check-label" for="terms_agreed">
                                                    {{ __('I agree to the') }}
                                                    <a href="#" class="text-primary">{{ __('Terms and Conditions') }}</a>
                                                    {{ __('and') }}
                                                    <a href="#" class="text-primary">{{ __('Privacy Policy') }}</a>
                                                </label>
                                            </div>
                                        </div>
                                        @error('terms_agreed')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Right Column - Order Summary -->
                            <div class="col-lg-4">
                                <div class="order-summary">
                                    <div class="summary-header">
                                        <i class="bi bi-receipt me-2"></i>
                                        {{ __('Order Summary') }}
                                    </div>
                                    <div class="summary-body">
                                        <div class="summary-item">
                                            <span>{{ __('Tourist Fees') }}</span>
                                            <span>₱<span id="touristFees">0.00</span></span>
                                        </div>
                                        <div class="summary-item">
                                            <span>{{ __('Tricycle Fee') }}</span>
                                            <span>₱<span id="tricycleFee">0.00</span></span>
                                        </div>
                                        <div class="summary-item">
                                            <span>{{ __('Processing Fee') }}</span>
                                            <span>₱<span id="processingFee">0.00</span></span>
                                        </div>
                                        <div class="summary-total">
                                            <span>{{ __('Total Amount') }}</span>
                                            <span>₱<span id="totalAmount">0.00</span></span>
                                        </div>
                                        <div class="summary-note">
                                            <div class="mb-2">
                                                <strong>{{ __('Down Payment Required') }}: ₱<span id="downPayment">0.00</span></strong>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-info-circle text-primary"></i>
                                                <small class="text-muted">{{ __('Pay 50% now, remaining balance on-site') }}</small>
                                            </div>
                                            <div id="summaryCapacityNote" class="text-warning mt-2 d-none" aria-live="polite">
                                                <i class="bi bi-exclamation-triangle me-1"></i>
                                                <small>{{ __('Capacity limit reached') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-check-circle me-2"></i>
                                        {{ __('Complete Booking') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    const FEES = @json(config('payment.fees'));
    const DOWN_PAYMENT_PERCENTAGE = {{ config('payment.down_payment_percentage', 50) }};

    // Auto-save functionality
    let autoSaveTimeout;
    let formData = {};

    function showAutoSaveIndicator(saving = false) {
        const indicator = document.getElementById('autoSaveIndicator');
        const text = document.getElementById('autoSaveText');
        
        if (saving) {
            indicator.classList.add('saving');
            text.textContent = '{{ __("Saving...") }}';
        } else {
            indicator.classList.remove('saving');
            text.textContent = '{{ __("Saved") }}';
        }
        
        indicator.classList.add('show');
        setTimeout(() => {
            indicator.classList.remove('show');
        }, 2000);
    }

    function autoSaveForm() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            const form = document.getElementById('bookingForm');
            const currentData = new FormData(form);
            const dataObj = {};
            
            for (let [key, value] of currentData.entries()) {
                dataObj[key] = value;
            }
            
            // Only save if data has changed
            if (JSON.stringify(dataObj) !== JSON.stringify(formData)) {
                formData = dataObj;
                showAutoSaveIndicator(true);
                
                // Store in localStorage
                localStorage.setItem('bookingFormData', JSON.stringify(formData));
                
                setTimeout(() => {
                    showAutoSaveIndicator(false);
                }, 500);
            }
        }, 1000);
    }

    function loadSavedData() {
        const saved = localStorage.getItem('bookingFormData');
        if (saved) {
            try {
                const data = JSON.parse(saved);
                const form = document.getElementById('bookingForm');
                
                for (let [key, value] of Object.entries(data)) {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) {
                        if (field.type === 'radio' || field.type === 'checkbox') {
                            const specificField = form.querySelector(`[name="${key}"][value="${value}"]`);
                            if (specificField) specificField.checked = true;
                        } else {
                            field.value = value;
                        }
                    }
                }
                
                // Trigger change events to update calculations
                calculateTotal();
            } catch (e) {
                console.log('Error loading saved data:', e);
            }
        }
    }

    function addTooltips() {
        // Add tooltips to complex fields
        const tooltipFields = [
            {
                selector: 'label[for="emergency_contact_name"]',
                text: 'Person to contact in case of emergency during the trek'
            },
            {
                selector: 'label[for="medical_conditions"]',
                text: 'Any health conditions we should be aware of for your safety'
            },
            {
                selector: 'label[for="payment_method"]',
                text: 'Choose your preferred payment method. Processing fees may apply.'
            }
        ];
        
        tooltipFields.forEach(field => {
            const element = document.querySelector(field.selector);
            if (element) {
                const tooltip = document.createElement('span');
                tooltip.className = 'tooltip-trigger';
                tooltip.innerHTML = `<i class="bi bi-question-circle"></i>
                    <div class="custom-tooltip">${field.text}</div>`;
                element.appendChild(tooltip);
            }
        });
    }

    function enhanceValidation() {
        const form = document.getElementById('bookingForm');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                // Clear validation state on input
                this.classList.remove('is-invalid', 'is-valid');
                const feedback = this.parentNode.querySelector('.invalid-feedback, .valid-feedback');
                if (feedback) feedback.remove();
                
                // Trigger auto-save
                autoSaveForm();
            });
        });
    }

    function validateField(field) {
        const isValid = field.checkValidity();
        const existingFeedback = field.parentNode.querySelector('.invalid-feedback, .valid-feedback');
        
        if (existingFeedback) existingFeedback.remove();
        
        field.classList.remove('is-invalid', 'is-valid');
        
        if (!isValid) {
            field.classList.add('is-invalid');
            const feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            feedback.textContent = field.validationMessage;
            field.parentNode.appendChild(feedback);
        } else if (field.value.trim() !== '') {
            field.classList.add('is-valid');
        }
    }

    function getLengthOfStay() {
        const el = document.querySelector('input[name="length_of_stay"]:checked');
        return el ? el.value : '';
    }

    function calculateTotal() {
        const localTourists = parseInt(document.getElementById('local_tourists').value) || 0;
        const foreignTourists = parseInt(document.getElementById('foreign_tourists').value) || 0;
        const lengthOfStay = getLengthOfStay();
        const paymentMethod = document.getElementById('payment_method');
        const tricycleRental = document.querySelector('input[name="transportation"]:checked')?.value === 'rent_trike';

        const localFee = localTourists * FEES.tourist.local;
        const foreignFee = foreignTourists * FEES.tourist.foreign;
        const touristFees = localFee + foreignFee;

        const tricycleFee = tricycleRental ? FEES.tricycle_rental : 0;

        const subtotal = touristFees + tricycleFee;

        let processingFee = 0;
        if (paymentMethod && paymentMethod.value) {
            const selectedOption = paymentMethod.options[paymentMethod.selectedIndex];
            const feePercentage = parseFloat(selectedOption.dataset.feePercentage || 0);
            const feeFixed = parseFloat(selectedOption.dataset.feeFixed || 0);
            processingFee = (subtotal * (feePercentage / 100)) + feeFixed;
        }

        const total = subtotal + processingFee;
        const downPayment = total * (DOWN_PAYMENT_PERCENTAGE / 100);

        function fmt(n) {
            return n.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
        document.getElementById('touristFees').textContent = fmt(touristFees);
        document.getElementById('tricycleFee').textContent = fmt(tricycleFee);
        document.getElementById('processingFee').textContent = fmt(processingFee);
        document.getElementById('totalAmount').textContent = fmt(total);
        document.getElementById('downPayment').textContent = fmt(downPayment);

        updateCapacityWarning(localTourists + foreignTourists);
        updateSubmitState();
        
        // Show/hide nationality section based on foreigner count
        const nationalitySection = document.getElementById('nationality-section');
        if (foreignTourists > 0) {
            nationalitySection.style.display = 'block';
        } else {
            nationalitySection.style.display = 'none';
        }
    }

    function updateCapacityWarning(totalGuests) {
        // Capacity warnings removed for custom bookings
        const warn = document.getElementById('capacityWarning');
        const note = document.getElementById('summaryCapacityNote');
        if (warn) warn.classList.add('d-none');
        if (note) note.classList.add('d-none');
    }

    function hasRequiredSelections() {
        const length = getLengthOfStay();
        const trans = document.querySelector('input[name="transportation"]:checked');
        const meet = document.querySelector('input[name="meeting_place"]:checked');
        const localTourists = parseInt(document.getElementById('local_tourists').value) || 0;
        const foreignTourists = parseInt(document.getElementById('foreign_tourists').value) || 0;
        const paymentMethod = document.getElementById('payment_method');
        const terms = document.getElementById('terms_agreed');
        const totalGuests = localTourists + foreignTourists;

        if (!length || !trans || !meet) return false;
        if (totalGuests <= 0) return false;
        if (!paymentMethod || !paymentMethod.value) return false;
        if (!terms || !terms.checked) return false;
        
        // Check start time based on booking type
        const bookingType = document.querySelector('input[name="booking_type"]:checked');
        if (bookingType) {
            if (bookingType.value === 'existing') {
                const startTime = document.getElementById('start_time');
                if (!startTime || !startTime.value) return false;
            } else if (bookingType.value === 'custom') {
                const customStartTime = document.getElementById('custom_start_time');
                if (!customStartTime || !customStartTime.value) return false;
                
                // Also check custom trek date and trail
                const customTrekDate = document.getElementById('custom_trek_date');
                const customTrail = document.getElementById('custom_trail');
                if (!customTrekDate || !customTrekDate.value) return false;
                if (!customTrail || !customTrail.value) return false;
                
                // If custom trail is "Custom Trail", check custom trail name
                if (customTrail.value === 'Custom Trail') {
                    const customTrailName = document.getElementById('custom_trail_name');
                    if (!customTrailName || !customTrailName.value.trim()) return false;
                }
            }
        }
        
        // Check if nationality is required for foreigners
        if (foreignTourists > 0) {
            const nationalityInput = document.getElementById('foreign_nationalities');
            if (!nationalityInput || !nationalityInput.value.trim()) return false;
        }
        
        return true;
    }

    function updateSubmitState() {
        const btn = document.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = !hasRequiredSelections();
        }
    }

    // Booking type toggle functionality
    const bookingTypeRadios = document.querySelectorAll('input[name="booking_type"]');
    const customBookingSection = document.getElementById('custom-booking-section');
    const customTrailSelect = document.getElementById('custom_trail');
    const customTrailInput = document.getElementById('custom-trail-input');

    bookingTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const guestsSection = document.getElementById('guests-section');
            
            if (this.value === 'custom') {
                // Show custom booking
                if (customBookingSection) customBookingSection.style.display = 'block';
                
                // Show guests section for custom bookings
                if (guestsSection) guestsSection.style.display = 'block';
                
                // Hide trek details section since we're using custom fields
                const trekDetails = document.getElementById('trek-details');
                const trailInfoSection = document.getElementById('trail-info-section');
                if (trekDetails) trekDetails.style.display = 'none';
                if (trailInfoSection) trailInfoSection.style.display = 'none';
            }
            
            calculateTotal();
            updateSubmitState();
        });
    });

    // Custom trail selection handler
    if (customTrailSelect) {
        customTrailSelect.addEventListener('change', function() {
            if (this.value === 'Custom Trail') {
                if (customTrailInput) customTrailInput.style.display = 'block';
            } else {
                if (customTrailInput) customTrailInput.style.display = 'none';
                const customTrailName = document.getElementById('custom_trail_name');
                if (customTrailName) customTrailName.value = '';
            }
        });
    }

    function clearCustomBookingFields() {
        const customTrekDate = document.getElementById('custom_trek_date');
        const customStartTime = document.getElementById('custom_start_time');
        const customTrail = document.getElementById('custom_trail');
        const customTrailName = document.getElementById('custom_trail_name');
        
        if (customTrekDate) customTrekDate.value = '';
        if (customStartTime) customStartTime.value = '';
        if (customTrail) customTrail.value = '';
        if (customTrailName) customTrailName.value = '';
        if (customTrailInput) customTrailInput.style.display = 'none';
    }

    // Counter buttons
    document.querySelectorAll('.counter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.counter;
            const action = this.dataset.action;
            const input = document.getElementById(id);
            if (!input) return;
            let val = parseInt(input.value) || 0;
            if (action === 'increment') val += 1;
            if (action === 'decrement') val = Math.max(0, val - 1);
            input.value = val;
            calculateTotal();
        });
    });

    // Radio group listeners
    ['length_of_stay', 'transportation', 'meeting_place'].forEach(name => {
        document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
            el.addEventListener('change', () => {
                calculateTotal();
            });
        });
    });

    // Other inputs
    document.getElementById('local_tourists').addEventListener('input', calculateTotal);
    document.getElementById('foreign_tourists').addEventListener('input', calculateTotal);
    document.getElementById('start_time').addEventListener('change', updateSubmitState);
    document.getElementById('custom_start_time').addEventListener('change', updateSubmitState);
    document.getElementById('custom_trek_date').addEventListener('change', updateSubmitState);
    document.getElementById('custom_trail').addEventListener('change', updateSubmitState);
    document.getElementById('custom_trail_name').addEventListener('input', updateSubmitState);
    document.getElementById('foreign_nationalities').addEventListener('input', updateSubmitState);
    document.getElementById('payment_method').addEventListener('change', calculateTotal);
    document.getElementById('terms_agreed').addEventListener('change', updateSubmitState);

    // Accordion functionality
    window.toggleAccordion = function(sectionId) {
        const section = document.getElementById(sectionId);
        if (!section) return;
        
        const content = section.querySelector('.section-content');
        const toggle = section.querySelector('.accordion-toggle');
        const icon = toggle.querySelector('i');
        
        if (content.classList.contains('collapsed')) {
            // Expand
            content.classList.remove('collapsed');
            section.classList.remove('collapsed');
            toggle.classList.remove('collapsed');
            icon.className = 'bi bi-chevron-up';
        } else {
            // Collapse
            content.classList.add('collapsed');
            section.classList.add('collapsed');
            toggle.classList.add('collapsed');
            icon.className = 'bi bi-chevron-down';
        }
    };

    // Single-page form functionality - all sections are now visible
    const formSections = [
        document.getElementById('trek-section'),           // Trek Details section
        document.getElementById('guests-section'),         // Guests section
        document.getElementById('preferences-section'),    // Preferences section
        document.getElementById('staff-notice-section'),   // Staff Assignment Notice section
        document.getElementById('health-section'),         // Health section
        document.getElementById('payment-section')         // Payment section
    ];

    // Smooth scroll to section when clicking on section headers (optional enhancement)
    formSections.forEach((section) => {
        if (section) {
            const header = section.querySelector('.section-header');
            if (header) {
                header.style.cursor = 'pointer';
                header.addEventListener('click', () => {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }
        }
    });

    // Init
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize form for custom booking by default
        const customBookingSection = document.getElementById('custom-booking-section');
        const guestsSection = document.getElementById('guests-section');
        
        // Show custom booking sections by default
        if (customBookingSection) customBookingSection.style.display = 'block';
        if (guestsSection) guestsSection.style.display = 'block';
        
        calculateTotal();
        updateSubmitState();
        
        // Initialize UX enhancements
        loadSavedData();
        addTooltips();
        enhanceValidation();
        
        // Clear saved data on successful form submission
        const form = document.getElementById('bookingForm');
        form.addEventListener('submit', function() {
            localStorage.removeItem('bookingFormData');
        });
    });

    // Submit spinner
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            if (btn && !btn.classList.contains('btn-loading')) {
                btn.classList.add('btn-loading');
                btn.disabled = true;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + originalText;
            }
        });
    }
</script>


@endpush

</x-app-layout>