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

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts and Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="min-vh-100 d-flex flex-column">
        @if(Auth::check() && Auth::user()->usertype === 'admin')
            @include('layouts.admin-navigation')
        @elseif(Auth::check() && Auth::user()->usertype !== 'admin')
            @include('layouts.user-navigation')
        @else
            @include('layouts.navigation')
        @endif

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="container py-4">
                {{-- Support both Blade components ($slot) and traditional @section('content') --}}
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>
        </main>
        @include('layouts.footer')
        @stack('scripts')
    </body>
</html>
