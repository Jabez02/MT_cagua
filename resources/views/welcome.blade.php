@extends('layouts.front')

@section('meta')
<meta name="description" content="{{ __('Welcome to MT Cagua! Explore our services and offerings.') }}">
@endsection

@section('title')
<title>{{ __('Welcome to MT Cagua') }}</title>
@endsection

@section('style')
<style>
    .welcome-container {
        @apply min-h-screen flex items-center justify-center;
    }
    .welcome-content {
        @apply text-center;
    }
    .welcome-title {
        @apply text-4xl font-bold mb-4 text-gray-900;
    }
    .welcome-subtitle {
        @apply text-lg text-gray-700 max-w-2xl mx-auto;
    }
</style>
@endsection

@section('content')
<div class="welcome-container">
    <div class="welcome-content">
        <h1 class="welcome-title">{{ __('Welcome to MT Cagua!') }}</h1>
        <p class="welcome-subtitle">{{ __('Explore our services and offerings.') }}</p>
    </div>
</div>
@endsection

@section('script')
    <script>    
        // Custom JavaScript if needed
    </script>   
@endsection
