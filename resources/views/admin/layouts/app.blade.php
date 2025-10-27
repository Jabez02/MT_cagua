<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

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
        @include('layouts.admin-navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="container py-4">
                <h2 class="h4 mb-0">
                    Admin Dashboard
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow-1">
            <div class="container py-4">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
        
        @include('layouts.footer')
        
        @stack('scripts')
    </body>
</html>