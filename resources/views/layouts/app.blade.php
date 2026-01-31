<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="theme-color" content="#16a34a">
    <meta name="description" content="Sistem Penerimaan Murid Baru SMK Al-Hidayah Lestari">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>@yield('title', 'SMK Al-Hidayah Lestari')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        @media (min-width: 768px) {
            body { font-size: 16px; }
        }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }
        
        /* Better touch targets on mobile */
        @media (max-width: 768px) {
            a, button { 
                min-height: 44px; 
                min-width: 44px; 
            }
            /* Reduce animation on mobile for better performance */
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            /* Keep essential animations */
            .animate-pulse, .animate-spin {
                animation-duration: 2s !important;
            }
        }
        
        /* Optimize images */
        img {
            max-width: 100%;
            height: auto;
            content-visibility: auto;
        }
        
        /* Reduce motion for users who prefer it */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800 pb-20 md:pb-0">

    @include('partials.header')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
    
    @include('partials.bottom-nav')

    <script src="{{ asset('js/validation.js') }}"></script>
</body>
</html>
