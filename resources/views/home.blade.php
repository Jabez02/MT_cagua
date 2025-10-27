<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mt. Cagua Adventures') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('head')
    @stack('styles')
</head>
<body>
    <!-- Home Navigation Component -->
    <x-home-navigation />
    
    <!-- Main Content -->
    <main>
        @php
            // Define hero image variables at the top for use throughout the template
            $heroImage = App\Models\HeroImage::getActive();
            $heroImageUrl = $heroImage ? asset('storage/' . $heroImage->file_path) : 
                       (isset($generalSettings['hero_image']) ? 'data:' . $generalSettings['mime_type'] . ';base64,' . $generalSettings['hero_image'] : 
                       asset('images/placeholder-hero.jpg'));
        @endphp
    
    @push('head')
        <!-- Preload critical desktop banner image for performance -->
        @if($heroImage)
            <!-- Desktop banner preload (1920x600px) -->
            <link rel="preload" as="image" href="{{ $heroImageUrl }}" media="(min-width: 1200px)" imagesrcset="{{ $heroImageUrl }} 1920w" imagesizes="(min-width: 1920px) 1920px, (min-width: 1440px) 1440px, 100vw">
            <!-- Mobile preload (360x200px) -->
            <link rel="preload" as="image" href="{{ $heroImageUrl }}" media="(max-width: 767px)" imagesrcset="{{ $heroImageUrl }} 360w" imagesizes="360px">
        @endif
        
        <!-- DNS prefetch for image optimization -->
        <link rel="dns-prefetch" href="{{ parse_url(asset('storage'), PHP_URL_HOST) }}">
        
        <!-- Google Fonts - Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @endpush

    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden" role="banner" aria-label="Main hero section"
    >
        <!-- Background Image with Responsive Handling -->
        <div class="hero-background" 
             @if($heroImage)
                 style="background-image: url('{{ $heroImageUrl }}');"
             @elseif(isset($generalSettings['hero_image']) && strpos($generalSettings['hero_image'], 'data:image') === false)
                 style="background-image: url('{{ asset($generalSettings['hero_image']) }}');"
             @elseif(isset($generalSettings['hero_image']))
                 style="background-image: url('data:{{ App\Models\SystemSetting::where('key', 'hero_image')->first()->mime_type ?? 'image/jpeg' }};base64,{{ $generalSettings['hero_image'] }}');"
             @else
                 style="background-image: url('{{ asset('images/placeholder-mountain.svg') }}');"
             @endif
             role="img"
             aria-label="Hero background image"
             aria-hidden="true">
            
            <!-- Responsive Image Element for Better Performance -->
             @if($heroImage)
                 <picture class="hero-responsive-image">
                     <!-- High-resolution displays -->
                     <source media="(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="720px"
                             type="image/webp">
                     
                     <!-- Mobile: 360x200px (16:9) -->
                     <source media="(max-width: 767px)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="360px"
                             type="image/webp">
                     
                     <!-- Tablet: Intermediate sizing with high-res support -->
                     <source media="(min-width: 768px) and (max-width: 1199px) and (-webkit-min-device-pixel-ratio: 2)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="(max-width: 1199px) 100vw"
                             type="image/webp">
                     
                     <!-- Tablet: Intermediate sizing -->
                     <source media="(min-width: 768px) and (max-width: 1199px)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="100vw"
                             type="image/webp">
                     
                     <!-- Desktop: High-resolution displays (3.2:1 aspect ratio) -->
             <source media="(min-width: 1200px) and (-webkit-min-device-pixel-ratio: 2)" 
                     srcset="{{ $heroImageUrl }}" 
                     sizes="(min-width: 1920px) 1920px, (min-width: 1440px) 1440px, 100vw"
                     type="image/webp">
             
             <!-- Desktop: Standard resolution banner (1920x600px or 1440x450px) -->
             <source media="(min-width: 1200px)" 
                     srcset="{{ $heroImageUrl }}" 
                     sizes="(min-width: 1920px) 1920px, (min-width: 1440px) 1440px, 100vw"
                     type="image/webp">
                     
                     <!-- Fallback for browsers that don't support WebP -->
                     <source media="(max-width: 767px)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="360px">
                     
                     <source media="(min-width: 768px) and (max-width: 1199px)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="100vw">
                     
                     <source media="(min-width: 1200px)" 
                             srcset="{{ $heroImageUrl }}" 
                             sizes="(min-width: 1920px) 1920px, (min-width: 1440px) 1440px, 100vw">
                     
                     <!-- Fallback image with performance attributes for desktop banner -->
                     <img src="{{ $heroImageUrl }}" 
                          alt="Mt. Cagua desktop banner - Experience breathtaking mountain views" 
                          class="hero-fallback-image"
                          loading="eager"
                          decoding="async"
                          fetchpriority="high"
                          width="1920"
                          height="600"
                          style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; pointer-events: none;">
                 </picture>
             @endif
        </div>
        <!-- Banner Overlay -->
        <div class="hero-banner-overlay" aria-hidden="true">
            <img src="https://res.cloudinary.com/dzdvd3dtz/image/upload/v1760850970/Barabara_2_uh1gqx.png" 
                 alt="Love Philippines promotional banner" 
                 class="hero-banner-image">
        </div>

        <!-- Responsive Tour Operator Information -->
        <div class="tour-operator-info">
            <p class="tour-operator-text">
                We are a DOT-accredited tour operator for Mt. Cagua in Gonzaga, Cagayan Valley. Our tours to the volcano, waterfalls, and natural hot springs are accessible within 2-3 hours from Tuguegarao or 30 minutes from downtown Gonzaga. We offer safe, secure, and convenient online booking and payment for all adventure packages.
            </p>
        </div>


    </section>
    
    <style>
        /* ===== CSS CUSTOM PROPERTIES (DESIGN SYSTEM) ===== */
        :root {
            /* Typography Scale */
            --font-family-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-family-heading: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            
            /* Font Weights */
            --font-weight-light: 300;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;
            
            /* Font Sizes */
            --font-size-xs: 0.75rem;    /* 12px */
            --font-size-sm: 0.875rem;   /* 14px */
            --font-size-base: 1rem;     /* 16px */
            --font-size-lg: 1.125rem;   /* 18px */
            --font-size-xl: 1.25rem;    /* 20px */
            --font-size-2xl: 1.5rem;    /* 24px */
            --font-size-3xl: 1.875rem;  /* 30px */
            --font-size-4xl: 2.25rem;   /* 36px */
            --font-size-5xl: 3rem;      /* 48px */
            
            /* Line Heights */
            --line-height-tight: 1.25;
            --line-height-snug: 1.375;
            --line-height-normal: 1.5;
            --line-height-relaxed: 1.625;
            --line-height-loose: 2;
            
            /* Color Palette */
            --color-primary-50: #eff6ff;
            --color-primary-100: #dbeafe;
            --color-primary-200: #bfdbfe;
            --color-primary-300: #93c5fd;
            --color-primary-400: #60a5fa;
            --color-primary-500: #3b82f6;
            --color-primary-600: #2563eb;
            --color-primary-700: #1d4ed8;
            --color-primary-800: #1e40af;
            --color-primary-900: #1e3a8a;
            
            --color-success-500: #10b981;
            --color-warning-500: #f59e0b;
            --color-danger-500: #ef4444;
            --color-info-500: #06b6d4;
            
            /* Neutral Colors */
            --color-gray-50: #f9fafb;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-300: #d1d5db;
            --color-gray-400: #9ca3af;
            --color-gray-500: #6b7280;
            --color-gray-600: #4b5563;
            --color-gray-700: #374151;
            --color-gray-800: #1f2937;
            --color-gray-900: #111827;
            
            /* Spacing Scale */
            --space-1: 0.25rem;   /* 4px */
            --space-2: 0.5rem;    /* 8px */
            --space-3: 0.75rem;   /* 12px */
            --space-4: 1rem;      /* 16px */
            --space-5: 1.25rem;   /* 20px */
            --space-6: 1.5rem;    /* 24px */
            --space-8: 2rem;      /* 32px */
            --space-10: 2.5rem;   /* 40px */
            --space-12: 3rem;     /* 48px */
            --space-16: 4rem;     /* 64px */
            --space-20: 5rem;     /* 80px */
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* ===== GLOBAL TYPOGRAPHY ===== */
        body {
            font-family: var(--font-family-primary);
            font-weight: var(--font-weight-normal);
            line-height: var(--line-height-normal);
            color: var(--color-gray-800);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-family-heading);
            font-weight: var(--font-weight-bold);
            line-height: var(--line-height-tight);
            color: var(--color-gray-900);
            margin-bottom: var(--space-4);
        }
        
        .section-title {
            font-weight: var(--font-weight-extrabold);
            letter-spacing: -0.025em;
        }
        
        .section-subtitle {
            font-weight: var(--font-weight-medium);
            color: var(--color-gray-600);
        }
        
        /* ===== HERO SECTION ===== */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
            z-index: 2;
        }
        
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
            /* Ensure 16:9 aspect ratio is maintained */
            aspect-ratio: 16/9;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* ===== RESPONSIVE HERO IMAGE HANDLING ===== */
        .hero-responsive-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .hero-fallback-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        
        /* ===== TOUR OPERATOR INFO STYLING ===== */
        .tour-operator-info {
            position: absolute;
            bottom: var(--space-8);
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 800px;
            z-index: 4;
            text-align: center;
        }
        
        .tour-operator-text {
            background: none;
            padding: var(--space-6);
            margin: 0;
            font-size: var(--font-size-base);
            line-height: var(--line-height-relaxed);
            color: white;
            font-weight: var(--font-weight-bold);
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9), 1px 1px 3px rgba(0, 0, 0, 0.7);
            text-align: center;
        }
        
        /* Mobile devices: Responsive mobile design */
        @media (max-width: 767.98px) {
            .hero-section {
                min-height: 100vh;
                height: auto;
                padding: var(--space-4);
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .hero-background {
                width: 100%;
                height: 100vh;
                background-size: cover;
                background-position: center;
                background-attachment: scroll;
                /* Full viewport coverage for mobile */
                aspect-ratio: auto;
                object-fit: cover;
            }
            
            .hero-text-content {
                position: static;
                margin-top: var(--space-8);
                padding: 0 var(--space-4);
                text-align: center;
            }
            
            .hero-content-card {
                max-width: 100%;
                width: 100%;
                padding: var(--space-6) !important;
                margin: 0 auto;
                background: rgba(255, 255, 255, 0.9) !important;
                backdrop-filter: blur(8px);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-lg);
            }
            
            .hero-title {
                font-size: var(--font-size-2xl);
                margin-bottom: var(--space-4);
                line-height: var(--line-height-tight);
            }
            
            .hero-subtitle {
                font-size: var(--font-size-base);
                margin-bottom: var(--space-6);
                line-height: var(--line-height-relaxed);
            }
            
            /* Show banner on mobile with optimized sizing */
            .hero-banner-overlay {
                display: block;
                position: absolute;
                top: 20%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 3;
                pointer-events: none;
            }
            
            .hero-banner-image {
                max-width: min(280px, 85vw);
                height: auto;
                filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.25));
                animation: float 6s ease-in-out infinite;
            }
            
            /* Mobile tour operator info styling */
            .tour-operator-info {
                bottom: var(--space-4);
                width: 95%;
                max-width: none;
            }
            
            .tour-operator-text {
                font-size: var(--font-size-sm);
                padding: var(--space-4);
                line-height: var(--line-height-normal);
                background: none;
                color: white;
                font-weight: var(--font-weight-bold);
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.95), 1px 1px 3px rgba(0, 0, 0, 0.8);
            }
        }
        
        /* Tablet devices: Enhanced responsive design */
        @media (min-width: 768px) and (max-width: 1199.98px) {
            .hero-section {
                min-height: 70vh;
                padding: var(--space-6);
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .hero-background {
                width: 100%;
                height: 70vh;
                background-size: cover;
                background-position: center;
                background-attachment: scroll;
                /* Maintain responsive aspect ratio */
                aspect-ratio: 16/9;
                object-fit: cover;
            }
            
            .hero-text-content {
                position: static;
                padding: 0 var(--space-6);
                text-align: center;
                margin-top: var(--space-8);
            }
            
            .hero-content-card {
                max-width: 500px;
                width: 90%;
                margin: 0 auto;
                padding: var(--space-8) !important;
                background: rgba(255, 255, 255, 0.85) !important;
                backdrop-filter: blur(10px);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-lg);
            }
            
            .hero-title {
                font-size: var(--font-size-3xl);
                margin-bottom: var(--space-5);
                line-height: var(--line-height-tight);
            }
            
            .hero-subtitle {
                font-size: var(--font-size-lg);
                margin-bottom: var(--space-6);
                line-height: var(--line-height-relaxed);
            }
            
            .hero-banner-overlay {
                display: block;
                position: absolute;
                top: 15%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 3;
                pointer-events: none;
            }
            
            .hero-banner-image {
                max-width: min(350px, 70vw);
                height: auto;
                filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.2));
                animation: float 6s ease-in-out infinite;
            }
            
            /* Tablet tour operator info styling */
            .tour-operator-info {
                bottom: var(--space-6);
                width: 92%;
                max-width: 700px;
            }
            
            .tour-operator-text {
                font-size: var(--font-size-base);
                padding: var(--space-5);
                line-height: var(--line-height-relaxed);
                background: none;
                color: white;
                font-weight: var(--font-weight-bold);
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9), 1px 1px 3px rgba(0, 0, 0, 0.7);
            }
        }
        
        /* Desktop Banner: Precise dimensions for optimal display */
        @media (min-width: 1200px) {
            .hero-section {
                /* Desktop banner with precise height for better visual hierarchy */
                min-height: 600px;
                max-height: 600px;
                height: 600px;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
            }
            
            .hero-background {
                /* Primary desktop banner: 1920x600px (3.2:1 aspect ratio) */
                width: 100%;
                max-width: 1920px;
                height: 600px;
                background-size: cover;
                background-position: center;
                /* Maintain precise aspect ratio for desktop banner */
                aspect-ratio: 3.2/1;
                object-fit: cover;
                /* Center the banner on ultra-wide screens */
                margin: 0 auto;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .hero-content-card {
                /* Optimize content positioning for banner layout */
                max-width: 600px;
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.95) !important;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            /* Desktop tour operator info styling */
            .tour-operator-info {
                bottom: var(--space-8);
                width: 85%;
                max-width: 800px;
            }
            
            .tour-operator-text {
                font-size: var(--font-size-lg);
                padding: var(--space-6);
                line-height: var(--line-height-relaxed);
                background: none;
                color: white;
                font-weight: var(--font-weight-bold);
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.85), 1px 1px 3px rgba(0, 0, 0, 0.6);
            }
        }
        
        /* Large desktop screens: Maintain banner proportions */
        @media (min-width: 1440px) {
            .hero-background {
                /* Alternative sizing for larger screens: 1440x450px */
                max-width: 1440px;
                height: 450px;
                aspect-ratio: 3.2/1;
            }
            
            .hero-section {
                min-height: 450px;
                max-height: 450px;
                height: 450px;
            }
        }
        
        /* Ultra-wide desktop screens: Premium banner display */
        @media (min-width: 1920px) {
            .hero-background {
                /* Premium desktop banner: Full 1920x600px */
                width: 1920px;
                height: 600px;
                max-width: 1920px;
                max-height: 600px;
                aspect-ratio: 3.2/1;
            }
            
            .hero-section {
                min-height: 600px;
                max-height: 600px;
                height: 600px;
            }
        }
        
        /* Performance optimizations for desktop banner display */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .hero-background {
                /* High DPI displays get better quality images for banner */
                background-size: cover;
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
                /* Ensure banner maintains sharpness on retina displays */
                background-image: image-set(
                    url('{{ $heroImageUrl }}') 1x,
                    url('{{ $heroImageUrl }}') 2x
                );
            }
        }
        
        /* Desktop banner quality enhancements */
        .hero-background {
            /* Optimize banner image rendering */
            image-rendering: optimizeQuality;
            image-rendering: -webkit-optimize-contrast;
            /* Smooth scaling for banner dimensions */
            background-size: cover;
            background-position: center center;
            /* Prevent banner distortion */
            background-repeat: no-repeat;
        }
        
        /* Banner container for precise aspect ratio control */
        .hero-banner-container {
            position: relative;
            width: 100%;
            /* Desktop banner aspect ratio: 3.2:1 */
            aspect-ratio: 3.2/1;
            overflow: hidden;
            max-width: 1920px;
            margin: 0 auto;
        }
        
        /* Reduced motion preferences */
        @media (prefers-reduced-motion: reduce) {
            .hero-background {
                background-attachment: scroll;
            }
            
            .hero-banner-image {
                animation: none;
            }
        }
        
        /* Aspect ratio container for consistent 16:9 display */
        .hero-aspect-container {
            position: relative;
            width: 100%;
            aspect-ratio: 16/9;
            overflow: hidden;
        }
        
        /* Preload critical images for performance */
        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
        }
        
        .hero-banner-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            pointer-events: none;
        }
        
        .hero-banner-image {
            max-width: min(850px, 90vw);
            height: auto;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.3));
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .hero-text-content {
            position: absolute;
            bottom: var(--space-20);
            left: 0;
            right: 0;
            z-index: 4;
            text-align: center;
        }
        
        .hero-content-card {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .hero-title {
            font-size: clamp(var(--font-size-3xl), 5vw, var(--font-size-5xl));
            font-weight: var(--font-weight-extrabold);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: var(--space-6);
        }
        
        .hero-subtitle {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-medium);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            margin-bottom: var(--space-8);
        }
        
        .hero-cta-primary,
        .hero-cta-secondary {
            font-weight: var(--font-weight-semibold);
            border-radius: var(--radius-xl);
            transition: var(--transition-base);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .hero-cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .hero-cta-secondary:hover {
            transform: translateY(-2px);
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* ===== SECTION STYLING ===== */
        section {
            padding: var(--space-20) 0;
        }
        
        .features-section,
        .testimonials-section {
            background-color: var(--color-gray-50);
        }
        
        /* ===== CARD COMPONENTS ===== */
        .feature-card,
        .hike-card,
        .testimonial-card {
            border-radius: var(--radius-xl);
            transition: var(--transition-base);
            border: 1px solid var(--color-gray-200);
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }
        
        .feature-icon {
            width: 4rem;
            height: 4rem;
            font-size: var(--font-size-2xl);
        }
        
        .hike-image {
            height: 250px;
            object-fit: cover;
            transition: var(--transition-base);
        }
        
        .hike-card:hover .hike-image {
            transform: scale(1.05);
        }
        
        .hike-image-container {
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }
        
        .hike-difficulty-badge .badge {
            font-weight: var(--font-weight-semibold);
            border-radius: var(--radius-full);
        }
        
        .author-avatar {
            width: 3rem;
            height: 3rem;
            font-size: var(--font-size-lg);
        }
        
        /* ===== CTA SECTION ===== */
        .cta-section {
            background: linear-gradient(135deg, var(--color-primary-600) 0%, var(--color-primary-800) 100%);
        }
        
        .cta-primary,
        .cta-secondary {
            font-weight: var(--font-weight-semibold);
            border-radius: var(--radius-xl);
            transition: var(--transition-base);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background-color: var(--color-gray-100) !important;
        }
        
        .cta-secondary:hover {
            transform: translateY(-2px);
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* ===== ACCESSIBILITY ENHANCEMENTS ===== */
        .visually-hidden {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
        
        /* Focus styles for keyboard navigation */
        .feature-card:focus,
        .hike-card:focus,
        .testimonial-card:focus {
            outline: 2px solid var(--color-primary-500);
            outline-offset: 2px;
        }
        
        .btn:focus {
            outline: 2px solid var(--color-primary-300);
            outline-offset: 2px;
        }
        
        /* ===== ENHANCED MOBILE RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 100vh;
                padding: var(--space-4);
            }
            
            .hero-text-content {
                position: static;
                padding: 0 var(--space-4);
                margin-top: var(--space-8);
                text-align: center;
            }
            
            .hero-content-card {
                max-width: 100%;
                width: 100%;
                margin: 0 auto;
                padding: var(--space-6) !important;
                background: rgba(255, 255, 255, 0.9) !important;
                backdrop-filter: blur(8px);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-lg);
            }
            
            .hero-title {
                font-size: var(--font-size-2xl);
                margin-bottom: var(--space-4);
                line-height: var(--line-height-tight);
            }
            
            .hero-subtitle {
                font-size: var(--font-size-base);
                margin-bottom: var(--space-6);
                line-height: var(--line-height-relaxed);
            }
            
            .hero-actions {
                flex-direction: column;
                align-items: center;
                gap: var(--space-3);
            }
            
            .hero-cta-primary,
            .hero-cta-secondary {
                width: 100%;
                justify-content: center;
                max-width: 280px;
                padding: var(--space-3) var(--space-6);
                font-size: var(--font-size-base);
            }
            
            section {
                padding: var(--space-12) var(--space-4);
            }
            
            .section-title {
                font-size: var(--font-size-2xl);
                text-align: center;
                margin-bottom: var(--space-8);
            }
            
            .cta-actions {
                flex-direction: column;
                align-items: center;
                gap: var(--space-3);
            }
            
            .cta-primary,
            .cta-secondary {
                width: 100%;
                justify-content: center;
                max-width: 280px;
                padding: var(--space-3) var(--space-6);
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                min-height: 100vh;
                padding: var(--space-3);
            }
            
            .hero-banner-image {
                max-width: min(250px, 80vw);
            }
            
            .hero-text-content {
                padding: 0 var(--space-3);
                margin-top: var(--space-6);
            }
            
            .hero-content-card {
                padding: var(--space-4) !important;
                margin: 0 var(--space-2);
            }
            
            .hero-title {
                font-size: var(--font-size-xl);
                margin-bottom: var(--space-3);
            }
            
            .hero-subtitle {
                font-size: var(--font-size-sm);
                margin-bottom: var(--space-4);
            }
            
            .hero-cta-primary,
            .hero-cta-secondary {
                max-width: 240px;
                padding: var(--space-2) var(--space-4);
                font-size: var(--font-size-sm);
            }
            
            section {
                padding: var(--space-8) var(--space-3);
            }
            
            .section-title {
                font-size: var(--font-size-xl);
                margin-bottom: var(--space-6);
            }
            
            /* Small mobile tour operator info styling */
            .tour-operator-info {
                bottom: var(--space-3);
                width: 98%;
                max-width: none;
            }
            
            .tour-operator-text {
                font-size: var(--font-size-xs);
                padding: var(--space-3);
                line-height: var(--line-height-snug);
                background: none;
                color: white;
                font-weight: var(--font-weight-bold);
                text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.98), 2px 2px 4px rgba(0, 0, 0, 0.85);
            }
        }
            
            .feature-icon {
                width: 3rem;
                height: 3rem;
                font-size: var(--font-size-xl);
            }
        }
        
        /* ===== PERFORMANCE OPTIMIZATIONS ===== */
        .hero-background {
            will-change: transform;
        }
        
        .hover-lift {
            will-change: transform;
        }
        
        /* Reduce motion for users who prefer it */
        @media (prefers-reduced-motion: reduce) {
            .hero-banner-image {
                animation: none;
            }
            
            .hover-lift:hover {
                transform: none;
            }
            
            .hero-cta-primary:hover,
            .hero-cta-secondary:hover,
            .cta-primary:hover,
            .cta-secondary:hover {
                transform: none;
            }
        }
        
        /* ===== DESKTOP SECTION HEADING ALIGNMENT ===== */
        /* Apply to all screen sizes first, then override for mobile if needed */
        .section-title {
            text-align: center !important;
            margin-left: auto;
            margin-right: auto;
        }
        
        .section-subtitle {
            text-align: center !important;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Ensure parent containers are also centered */
        .features-section .col-12,
        .featured-hikes-section .col-12,
        .testimonials-section .col-12 {
            text-align: center !important;
        }
        
        /* Override Bootstrap display classes that might interfere */
        .display-5.section-title {
            text-align: center !important;
        }
        
        /* Ensure h2 elements with section-title class are centered */
        h2.section-title {
            text-align: center !important;
            display: block;
            width: 100%;
        }
        
        /* ===== CTA FEATURES ICON ALIGNMENT ===== */
        .cta-features .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .cta-features .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            margin: 0 auto;
        }
        
        .cta-features .feature-icon i {
            display: block;
            text-align: center;
            line-height: 1;
        }
        
        .cta-features .feature-title {
            text-align: center;
            margin-top: var(--space-2);
        }
        
        .cta-features .feature-text {
            text-align: center;
        }
        
        /* ===== PARTNER LOGOS STYLING ===== */
        .partner-logos {
            margin-top: var(--space-12);
            padding-top: var(--space-8);
        }
        
        .logos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: var(--space-8);
            padding: var(--space-6) 0;
        }
        
        .logo-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: var(--space-2) 0;
        }
        
        .partner-logo {
            width: 150px;
            height: auto;
            max-height: 150px;
            object-fit: contain;
            opacity: 0.9;
            transition: var(--transition-base);
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 10px;
        }
        
        .partner-logo:hover {
            opacity: 1;
            transform: scale(1.05);
        }
        
        /* Mobile responsive adjustments */
        @media (max-width: 767.98px) {
            .logos-container {
                gap: var(--space-6);
                padding: var(--space-4) 0;
            }
            
            .partner-logo {
                width: 120px;
                max-height: 60px;
            }
            
            .logo-item {
                margin: var(--space-3) 0;
            }
        }
        
        /* Tablet adjustments */
        @media (min-width: 768px) and (max-width: 1199.98px) {
            .partner-logo {
                width: 130px;
                max-height: 70px;
            }
        }
    </style>

    <!-- Features Section -->
    <section class="features-section py-5 bg-light" role="region" aria-labelledby="features-heading">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 id="features-heading" class="section-title display-5 fw-bold text-dark mb-3">
                        Why Choose Mt. Cagua Adventures?
                    </h2>
                    <p class="section-subtitle lead text-muted mb-0">
                        Experience the difference with our professional hiking services
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card card h-100 border-0 shadow-sm hover-lift" tabindex="0">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" aria-hidden="true">
                                <i class="fas fa-person-hiking text-white fs-3"></i>
                            </div>
                            <h3 class="feature-title h5 fw-semibold mb-3">Expert Guides</h3>
                            <p class="feature-description text-muted mb-0">
                                Our certified mountain guides ensure your safety and provide rich knowledge about the local flora, fauna, and history.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card card h-100 border-0 shadow-sm hover-lift" tabindex="0">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" aria-hidden="true">
                                <i class="fas fa-mountain text-white fs-3"></i>
                            </div>
                            <h3 class="feature-title h5 fw-semibold mb-3">Prime Locations</h3>
                            <p class="feature-description text-muted mb-0">
                                Access exclusive trails and viewpoints that showcase the most spectacular vistas Mt. Cagua has to offer.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card card h-100 border-0 shadow-sm hover-lift" tabindex="0">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" aria-hidden="true">
                                <i class="fas fa-calendar-check text-white fs-3"></i>
                            </div>
                            <h3 class="feature-title h5 fw-semibold mb-3">Flexible Booking</h3>
                            <p class="feature-description text-muted mb-0">
                                Easy online booking system with flexible scheduling to accommodate your preferred dates and group size.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Hikes Section -->
    <section class="featured-hikes-section py-5" role="region" aria-labelledby="featured-hikes-heading">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 id="featured-hikes-heading" class="section-title display-5 fw-bold text-dark mb-3">
                        Featured Hiking Adventures
                    </h2>
                    <p class="section-subtitle lead text-muted mb-0">
                        Discover our most popular trails and breathtaking destinations
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @forelse($featuredHikes ?? [] as $hike)
                    <div class="col-lg-4 col-md-6">
                        <article class="hike-card card h-100 border-0 shadow-sm hover-lift" tabindex="0">
                            @if($hike->images && $hike->images->isNotEmpty())
                                <div class="hike-image-container position-relative overflow-hidden">
                                    <img src="{{ Storage::url($hike->images->first()->image_path) }}" 
                                         class="card-img-top hike-image" 
                                         alt="{{ $hike->name }} hiking trail"
                                         loading="lazy">
                                    <div class="hike-difficulty-badge position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-{{ $hike->difficulty === 'easy' ? 'success' : ($hike->difficulty === 'moderate' ? 'warning' : 'danger') }} px-3 py-2">
                                            {{ ucfirst($hike->difficulty) }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="hike-image-container position-relative overflow-hidden">
                                    <img src="{{ $hike->image_url ?? asset('images/placeholder-mountain.svg') }}" 
                                         class="card-img-top hike-image" 
                                         alt="{{ $hike->name }} hiking trail"
                                         loading="lazy">
                                    <div class="hike-difficulty-badge position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-{{ $hike->difficulty === 'easy' ? 'success' : ($hike->difficulty === 'moderate' ? 'warning' : 'danger') }} px-3 py-2">
                                            {{ ucfirst($hike->difficulty) }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <h3 class="hike-title card-title h5 fw-semibold mb-3">
                                    <a href="{{ route('hikes.show', $hike) }}" class="text-decoration-none text-dark stretched-link"
                                       aria-label="View details for {{ $hike->name }}">
                                        {{ $hike->name }}
                                    </a>
                                </h3>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-geo-alt me-1"></i> {{ $hike->location }}
                                    <span class="mx-2">•</span>
                                    <i class="bi bi-clock me-1"></i> {{ $hike->duration }} hours
                                </p>
                                <p class="hike-description card-text text-muted mb-3">
                                    {{ Str::limit($hike->description, 120) }}
                                </p>
                                <div class="hike-meta d-flex justify-content-between align-items-center">
                                    <div class="hike-price fw-semibold text-primary">
                                        ₱{{ number_format($hike->price, 2) }}
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="empty-state-icon mb-3" aria-hidden="true">
                                <i class="bi bi-mountain text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h3 class="h5 text-muted mb-2">No Featured Hikes Available</h3>
                            <p class="text-muted mb-4">Check back soon for exciting hiking adventures!</p>
                            <a href="{{ route('hikes.index') }}" class="btn btn-outline-primary">
                                Browse All Hikes
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            @if(($featuredHikes ?? collect())->isNotEmpty())
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('hikes.index') }}" class="btn btn-primary btn-lg px-5 py-3"
                           aria-label="View all available hiking tours">
                            <i class="bi bi-arrow-right me-2" aria-hidden="true"></i>
                            <span>View All Hikes</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5 bg-light" role="region" aria-labelledby="testimonials-heading">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 id="testimonials-heading" class="section-title display-5 fw-bold text-dark mb-3">
                        What Our Adventurers Say
                    </h2>
                    <p class="section-subtitle lead text-muted mb-0">
                        Real experiences from our hiking community
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @forelse($testimonials ?? [] as $testimonial)
                    <div class="col-lg-4 col-md-6">
                        <article class="testimonial-card card h-100 border-0 shadow-sm" tabindex="0">
                            <div class="card-body p-4">
                                <div class="testimonial-rating mb-3" aria-label="Rating: {{ $testimonial->rating ?? 5 }} out of 5 stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= ($testimonial->rating ?? 5) ? '-fill' : '' }} text-warning" aria-hidden="true"></i>
                                    @endfor
                                    <span class="visually-hidden">{{ $testimonial->rating ?? 5 }} out of 5 stars</span>
                                </div>
                                <blockquote class="testimonial-content mb-4">
                                    <p class="text-muted mb-0 fst-italic">
                                        "{{ $testimonial->content ?? 'Amazing experience! The guides were very knowledgeable and the views were breathtaking. Highly recommended!' }}"
                                    </p>
                                </blockquote>
                                <footer class="testimonial-author d-flex align-items-center">
                                    <div class="author-avatar bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" aria-hidden="true">
                                        <span class="text-white fw-semibold">
                                            {{ strtoupper(substr($testimonial->user->name ?? 'John Doe', 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <cite class="author-name fw-semibold text-dark d-block">
                                            {{ $testimonial->user->name ?? 'John Doe' }}
                                        </cite>
                                        <small class="author-location text-muted">
                                            {{ $testimonial->created_at?->diffForHumans() ?? '2 days ago' }}
                                        </small>
                                    </div>
                                </footer>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="empty-state-icon mb-3" aria-hidden="true">
                                <i class="bi bi-chat-quote text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h3 class="h5 text-muted mb-2">No Testimonials Available</h3>
                            <p class="text-muted mb-4">Be the first to share your hiking experience!</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                                Share Your Story
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-success bg-gradient text-white" role="region" aria-labelledby="cta-heading">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 id="cta-heading" class="cta-title display-4 fw-bold mb-4">
                        Ready for Your Next Adventure?
                    </h2>
                    <p class="cta-subtitle lead mb-5 opacity-90">
                        Join thousands of satisfied hikers who have discovered the beauty of Mt. Cagua. 
                        Book your unforgettable hiking experience today and create memories that will last a lifetime.
                    </p>
                    <div class="cta-actions d-flex flex-wrap justify-content-center gap-3" role="group" aria-labelledby="cta-heading">
                        <a href="{{ route('hikes.index') }}" class="btn btn-light btn-lg px-5 py-3 cta-primary"
                           aria-label="Book your hiking adventure now">
                            <i class="bi bi-calendar-plus me-2" aria-hidden="true"></i>
                            <span>Book Your Adventure</span>
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-5 py-3 cta-secondary"
                           aria-label="Contact us for more information">
                            <i class="bi bi-telephone me-2" aria-hidden="true"></i>
                            <span>Contact Us</span>
                        </a>
                    </div>
                    
                    <!-- Partner Logos Section -->
                    <div class="partner-logos mt-5 pt-4">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="logos-container d-flex flex-wrap justify-content-center align-items-center gap-4">
                                    <!-- Gonzaga Logo -->
                                    <div class="logo-item">
                                        <img src="https://www.gonzaga.gov.ph/wp-content/uploads/2025/07/cropped-Logo-GONZAGA.png" 
                                             alt="Municipality of Gonzaga Logo" 
                                             class="partner-logo"
                                             loading="lazy">
                                    </div>
                                    
                                    <!-- Philippine Transparency Seal -->
                                    <div class="logo-item">
                                        <img src="https://www.gonzaga.gov.ph/wp-content/uploads/2025/07/Philippine_Transparency_Seal.png" 
                                             alt="Philippine Transparency Seal" 
                                             class="partner-logo"
                                             loading="lazy">
                                    </div>
                                    
                                    <!-- Bagong Pilipinas Logo -->
                                    <div class="logo-item">
                                        <img src="https://www.tourism.gov.ph/assets/icons/bagong-pilipinas.svg" 
                                             alt="Bagong Pilipinas Logo" 
                                             class="partner-logo"
                                             loading="lazy">
                                    </div>
                                    
                                    <!-- Department of Tourism Logo -->
                                    <div class="logo-item">
                                        <img src="https://www.tourism.gov.ph/assets/icons/dot.svg" 
                                             alt="Department of Tourism Logo" 
                                             class="partner-logo"
                                             loading="lazy">
                                    </div>
                                    
                                    <!-- Cagayan State University Logo -->
                                    <div class="logo-item">
                                        <img src="https://csu.edu.ph/img/csulogo.png" 
                                             alt="Cagayan State University Logo" 
                                             class="partner-logo"
                                             loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cta-features mt-5">
                        <div class="row g-4 text-center">
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <div class="feature-icon mb-3 text-center" aria-hidden="true">
                                        <i class="fas fa-shield-halved fs-1 text-white"></i>
                                    </div>
                                    <h3 class="feature-title h6 fw-semibold mb-1">Safe & Secure</h3>
                                    <p class="feature-text small opacity-75 mb-0">Professional guides & safety equipment</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <div class="feature-icon mb-3 text-center" aria-hidden="true">
                                        <i class="fas fa-calendar-check fs-1 text-white"></i>
                                    </div>
                                    <h3 class="feature-title h6 fw-semibold mb-1">Easy Booking</h3>
                                    <p class="feature-text small opacity-75 mb-0">Simple online reservation system</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <div class="feature-icon mb-3 text-center" aria-hidden="true">
                                        <i class="fas fa-star fs-1 text-white"></i>
                                    </div>
                                    <h3 class="feature-title h6 fw-semibold mb-1">Best Experience</h3>
                                    <p class="feature-text small opacity-75 mb-0">Unforgettable memories guaranteed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary" id="loginModalLabel">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        
                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="login_email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input id="login_email" class="form-control border-start-0 ps-0" type="email" name="email" 
                                       value="{{ old('email') }}" required autofocus autocomplete="username" 
                                       placeholder="Enter your email address">
                            </div>
                            <div class="invalid-feedback" id="login_email_error"></div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="login_password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input id="login_password" class="form-control border-start-0 ps-0" type="password" 
                                       name="password" required autocomplete="current-password" 
                                       placeholder="Enter your password">
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleLoginPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="login_password_error"></div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <div class="text-center w-100">
                        <p class="mb-0 small text-muted">
                            Don't have an account? 
                            <a href="#" class="text-decoration-none fw-semibold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">
                                Sign up here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary" id="registerModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Create Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="register_name" class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input id="register_name" class="form-control border-start-0 ps-0" type="text" name="name" 
                                           value="{{ old('name') }}" required autofocus autocomplete="name" 
                                           placeholder="Enter your full name">
                                </div>
                                <div class="invalid-feedback" id="register_name_error"></div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6 mb-3">
                                <label for="register_email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input id="register_email" class="form-control border-start-0 ps-0" type="email" name="email" 
                                           value="{{ old('email') }}" required autocomplete="username" 
                                           placeholder="Enter your email address">
                                </div>
                                <div class="invalid-feedback" id="register_email_error"></div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Contact Number -->
                            <div class="col-md-6 mb-3">
                                <label for="register_contact_number" class="form-label fw-semibold">Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-phone text-muted"></i>
                                    </span>
                                    <input id="register_contact_number" class="form-control border-start-0 ps-0" type="tel" 
                                           name="contact_number" value="{{ old('contact_number') }}" required 
                                           autocomplete="tel" placeholder="Enter your contact number">
                                </div>
                                <div class="invalid-feedback" id="register_contact_number_error"></div>
                            </div>

                            <!-- Nationality -->
                            <div class="col-md-6 mb-3">
                                <label for="register_nationality" class="form-label fw-semibold">Nationality</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-flag text-muted"></i>
                                    </span>
                                    <select id="register_nationality" class="form-control border-start-0 ps-0" 
                                           name="nationality" required>
                                        <option value="">Select Nationality</option>
                                        <option value="local" {{ old('nationality') == 'local' ? 'selected' : '' }}>Local</option>
                                        <option value="foreign" {{ old('nationality') == 'foreign' ? 'selected' : '' }}>Foreign</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback" id="register_nationality_error"></div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="register_address" class="form-label fw-semibold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                </span>
                                <textarea id="register_address" class="form-control border-start-0 ps-0" name="address" 
                                          required autocomplete="street-address" rows="2" 
                                          placeholder="Enter your complete address">{{ old('address') }}</textarea>
                            </div>
                            <div class="invalid-feedback" id="register_address_error"></div>
                        </div>

                        <div class="row">
                            <!-- Emergency Contact Name -->
                            <div class="col-md-6 mb-3">
                                <label for="register_emergency_contact_name" class="form-label fw-semibold">Emergency Contact Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user-friends text-muted"></i>
                                    </span>
                                    <input id="register_emergency_contact_name" class="form-control border-start-0 ps-0" type="text" 
                                           name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required 
                                           autocomplete="name" placeholder="Enter emergency contact name">
                                </div>
                                <div class="invalid-feedback" id="register_emergency_contact_name_error"></div>
                            </div>

                            <!-- Emergency Contact Number -->
                            <div class="col-md-6 mb-3">
                                <label for="register_emergency_contact_number" class="form-label fw-semibold">Emergency Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-phone-alt text-muted"></i>
                                    </span>
                                    <input id="register_emergency_contact_number" class="form-control border-start-0 ps-0" type="tel" 
                                           name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" required 
                                           autocomplete="tel" placeholder="Enter emergency contact number">
                                </div>
                                <div class="invalid-feedback" id="register_emergency_contact_number_error"></div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="register_password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input id="register_password" class="form-control border-start-0 ps-0" type="password" 
                                           name="password" required autocomplete="new-password" 
                                           placeholder="Create a password">
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleRegisterPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="register_password_error"></div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="register_password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input id="register_password_confirmation" class="form-control border-start-0 ps-0" type="password" 
                                           name="password_confirmation" required autocomplete="new-password" 
                                           placeholder="Confirm your password">
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleRegisterPasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="register_password_confirmation_error"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <div class="text-center w-100">
                        <p class="mb-0 small text-muted">
                            Already have an account? 
                            <a href="#" class="text-decoration-none fw-semibold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Modal Styles -->
    <style>
        /* Modal Backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
        }

        /* Modal Content */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Modal Header */
        .modal-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem 1.5rem 1rem;
        }

        .modal-title {
            color: #2c3e50;
            font-size: 1.25rem;
        }

        .modal-title i {
            color: #3498db;
        }

        /* Modal Body */
        .modal-body {
            padding: 1rem 1.5rem 1.5rem;
            background-color: #ffffff;
        }

        /* Form Styling */
        .form-label {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }

        .form-control {
            border-color: #dee2e6;
            padding: 0.75rem 0.75rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .input-group .form-control.border-start-0 {
            border-left: none;
        }

        .input-group .input-group-text.border-end-0 {
            border-right: none;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1f5f8b 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-outline-secondary {
            border-color: #dee2e6;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #495057;
        }

        /* Modal Footer */
        .modal-footer {
            background-color: #f8f9fa;
            padding: 1rem 1.5rem 1.5rem;
        }

        .modal-footer a {
            color: #3498db;
            transition: color 0.2s ease;
        }

        .modal-footer a:hover {
            color: #2980b9;
        }

        /* Form Check */
        .form-check-input:checked {
            background-color: #3498db;
            border-color: #3498db;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #e74c3c;
            margin-top: 0.25rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 1rem;
            }
            
            .modal-header,
            .modal-body,
            .modal-footer {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .modal-title {
                font-size: 1.1rem;
            }
        }

        /* Animation */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Modal JavaScript Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            function setupPasswordToggle(toggleId, inputId) {
                const toggleBtn = document.getElementById(toggleId);
                const passwordInput = document.getElementById(inputId);
                
                if (toggleBtn && passwordInput) {
                    toggleBtn.addEventListener('click', function() {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        
                        const icon = this.querySelector('i');
                        if (type === 'text') {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    });
                }
            }

            // Setup password toggles
            setupPasswordToggle('toggleLoginPassword', 'login_password');
            setupPasswordToggle('toggleRegisterPassword', 'register_password');
            setupPasswordToggle('toggleRegisterPasswordConfirm', 'register_password_confirmation');

            // Form validation and submission
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            // Clear validation errors when modal is hidden
            function clearValidationErrors(modalId) {
                const modal = document.getElementById(modalId);
                modal.addEventListener('hidden.bs.modal', function() {
                    const form = this.querySelector('form');
                    const inputs = form.querySelectorAll('.form-control');
                    const errorDivs = form.querySelectorAll('.invalid-feedback');
                    
                    inputs.forEach(input => {
                        input.classList.remove('is-invalid');
                        input.value = '';
                    });
                    
                    errorDivs.forEach(div => {
                        div.textContent = '';
                    });

                    // Reset checkboxes
                    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
            }

            clearValidationErrors('loginModal');
            clearValidationErrors('registerModal');

            // Handle form submissions with AJAX
            function handleFormSubmission(form, modalId) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    
                    // Clear previous errors
                    const inputs = this.querySelectorAll('.form-control');
                    inputs.forEach(input => input.classList.remove('is-invalid'));
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json().catch(() => {
                                // If response is not JSON, it might be a redirect
                                window.location.reload();
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.errors) {
                            // Display validation errors
                            Object.keys(data.errors).forEach(field => {
                                const input = document.getElementById(modalId === 'loginModal' ? `login_${field}` : `register_${field}`);
                                const errorDiv = document.getElementById(modalId === 'loginModal' ? `login_${field}_error` : `register_${field}_error`);
                                
                                if (input && errorDiv) {
                                    input.classList.add('is-invalid');
                                    errorDiv.textContent = data.errors[field][0];
                                }
                            });
                        } else if (data.success) {
                            // Success - redirect to the URL provided by the server
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                window.location.reload();
                            }
                        } else {
                            // Fallback - reload page
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show generic error message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger mt-3';
                        alertDiv.textContent = 'An error occurred. Please try again.';
                        form.insertBefore(alertDiv, form.firstChild);
                        
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 5000);
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    });
                });
            }

            // Setup form handlers
            if (loginForm) {
                handleFormSubmission(loginForm, 'loginModal');
            }
            
            if (registerForm) {
                handleFormSubmission(registerForm, 'registerModal');
            }

            // Handle modal switching
            const loginModal = document.getElementById('loginModal');
            const registerModal = document.getElementById('registerModal');

            // When switching from login to register
            loginModal.addEventListener('hidden.bs.modal', function() {
                if (registerModal.classList.contains('show')) {
                    return; // Don't clear if register modal is opening
                }
            });

            // When switching from register to login
            registerModal.addEventListener('hidden.bs.modal', function() {
                if (loginModal.classList.contains('show')) {
                    return; // Don't clear if login modal is opening
                }
            });

            // Focus management
            loginModal.addEventListener('shown.bs.modal', function() {
                document.getElementById('login_email').focus();
            });

            registerModal.addEventListener('shown.bs.modal', function() {
                document.getElementById('register_name').focus();
            });

            // Real-time validation for password confirmation
            const registerPassword = document.getElementById('register_password');
            const registerPasswordConfirm = document.getElementById('register_password_confirmation');
            
            if (registerPassword && registerPasswordConfirm) {
                registerPasswordConfirm.addEventListener('input', function() {
                    if (this.value && registerPassword.value) {
                        if (this.value !== registerPassword.value) {
                            this.classList.add('is-invalid');
                            document.getElementById('register_password_confirmation_error').textContent = 'Passwords do not match.';
                        } else {
                            this.classList.remove('is-invalid');
                            document.getElementById('register_password_confirmation_error').textContent = '';
                        }
                    }
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>