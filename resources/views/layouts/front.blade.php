<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="min-vh-100">
        <!-- Modern Navigation Component -->
        <x-home-navigation />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-sm mt-auto py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="fw-bold mb-3">{{ __('About Us') }}</h5>
                        <p class="text-muted">{{ __('Experience the thrill of hiking with our expert guides and well-planned trails.') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-bold mb-3">{{ __('Quick Links') }}</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="text-decoration-none text-muted">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('hikes.index') }}" class="text-decoration-none text-muted">{{ __('Hikes') }}</a></li>
                            <li><a href="{{ route('about') }}" class="text-decoration-none text-muted">{{ __('About') }}</a></li>
                            <li><a href="{{ route('contact') }}" class="text-decoration-none text-muted">{{ __('Contact') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-bold mb-3">{{ __('Contact Info') }}</h5>
                        <ul class="list-unstyled text-muted">
                            <li>{{ __('Email: ') }}{{ $contactSettings['email_address'] ?? 'info@mtcagua.com' }}</li>
                            <li>{{ __('Phone: ') }}{{ $contactSettings['phone_number'] ?? '+63 912 345 6789' }}</li>
                            <li>{{ __('Address: ') }}{{ $contactSettings['office_address'] ?? 'Gonzaga, Cagayan Valley' }}</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="text-center text-muted">
                    <small>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}</small>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>