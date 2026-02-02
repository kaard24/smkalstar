<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="theme-color" content="#0EA5E9">
    <meta name="description" content="Sistem Penerimaan Murid Baru SMK Al-Hidayah Lestari">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Preconnect to origins -->
    <link rel="preconnect" href="<?php echo e(url('/')); ?>">
    <link rel="dns-prefetch" href="<?php echo e(url('/')); ?>">
    
    <title><?php echo $__env->yieldContent('title', 'SMK Al-Hidayah Lestari'); ?></title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="<?php echo e(asset('fonts/inter/inter-regular.woff2')); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo e(asset('fonts/inter/inter-500.woff2')); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo e(asset('fonts/outfit/outfit-600.woff2')); ?>" as="font" type="font/woff2" crossorigin>
    
    <!-- Critical CSS Inline -->
    <style>
        /* Critical CSS for Above the Fold */
        *,*::before,*::after{box-sizing:border-box}
        html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
        body{margin:0;font-family:'Inter',system-ui,-apple-system,sans-serif;font-size:14px;line-height:1.6;color:#1f2937;background:#f9fafb;-webkit-font-smoothing:antialiased}
        @media(min-width:768px){body{font-size:16px}}
        h1,h2,h3,h4,h5,h6{margin:0;font-family:'Outfit',sans-serif;font-weight:600;line-height:1.2}
        a{color:inherit;text-decoration:none}
        img{max-width:100%;height:auto;display:block}
        
        /* Loading State */
        .page-loading{position:fixed;inset:0;background:#fff;z-index:9999;display:flex;align-items:center;justify-content:center;transition:opacity .3s,visibility .3s}
        .page-loading.hidden{opacity:0;visibility:hidden}
        .page-loading-spinner{width:40px;height:40px;border:3px solid #e5e7eb;border-top-color:#0EA5E9;border-radius:50%;animation:spin 1s linear infinite}
        @keyframes spin{to{transform:rotate(360deg)}}
        
        /* Prevent FOUC */
        [x-cloak]{display:none!important}
        
        /* Mobile Optimizations */
        @media(max-width:768px){
            html{scroll-behavior:auto}
            *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.15s!important}
            .animate-spin{animation-duration:1s!important}
        }
    </style>
    
    <!-- Preload Critical Assets -->
    <link rel="preload" href="<?php echo e(asset('images/logo.webp')); ?>" as="image" type="image/webp">
    
    <!-- Prefetch Common Pages -->
    <link rel="prefetch" href="<?php echo e(url('/profil')); ?>" as="document">
    <link rel="prefetch" href="<?php echo e(url('/jurusan')); ?>" as="document">
    <link rel="prefetch" href="<?php echo e(url('/ppdb/info')); ?>" as="document">
    
    <!-- Async Alpine.js -->
    <script defer src="<?php echo e(asset('js/alpine.min.js')); ?>"></script>
    
    <!-- Instant.page for fast navigation -->
    <script defer src="<?php echo e(asset('js/instant.page.js')); ?>" type="module"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0EA5E9',
                        'primary-dark': '#0284C7',
                        navy: '#1E3A5F',
                        accent: '#F97316',
                        ice: '#F0F9FF',
                    }
                }
            }
        }
    </script>

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
                transition-duration: 0.15s !important;
            }
            /* Keep essential animations */
            .animate-spin {
                animation-duration: 1s !important;
            }
            .animate-fade-in, .animate-slide-up {
                animation-duration: 0.3s !important;
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
        
        /* Custom primary color class */
        .text-primary { color: #0EA5E9; }
        .bg-primary { background-color: #0EA5E9; }
        .border-primary { border-color: #0EA5E9; }
        .hover\:text-primary:hover { color: #0EA5E9; }
        .hover\:bg-primary:hover { background-color: #0EA5E9; }
        .group-hover\:text-primary:hover { color: #0EA5E9; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800 pb-20 md:pb-0">
    <!-- Page Loading Indicator -->
    <div id="page-loading" class="page-loading">
        <div class="page-loading-spinner"></div>
    </div>

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php echo $__env->make('partials.bottom-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('js/validation.js')); ?>"></script>
    
    <!-- Hide loading indicator when page is ready -->
    <script>
        // Hide loading immediately when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('page-loading');
            if (loader) {
                // Small delay to ensure render is complete
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        loader.classList.add('hidden');
                        setTimeout(() => loader.remove(), 300);
                    }, 100);
                });
            }
        });
        
        // Fallback: hide loader when everything is loaded
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loading');
            if (loader && !loader.classList.contains('hidden')) {
                loader.classList.add('hidden');
                setTimeout(() => loader.remove(), 300);
            }
        });
        
        // Hide loader on page show (back/forward navigation)
        window.addEventListener('pageshow', function(e) {
            const loader = document.getElementById('page-loading');
            if (loader) {
                loader.classList.add('hidden');
                setTimeout(() => loader.remove(), 300);
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/layouts/app.blade.php ENDPATH**/ ?>