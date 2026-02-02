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
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo.webp')); ?>">
    
    <!-- Preconnect to origins -->
    <link rel="preconnect" href="<?php echo e(url('/')); ?>">
    <link rel="dns-prefetch" href="<?php echo e(url('/')); ?>">
    
    <title><?php echo $__env->yieldContent('title', 'SMK Al-Hidayah Lestari'); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Preload Critical Assets -->
    <link rel="preload" href="<?php echo e(asset('images/logo.webp')); ?>" as="image" type="image/webp">
    
    <!-- Critical CSS Inline -->
    <style>
        /* Critical CSS for Above the Fold */
        *,*::before,*::after{box-sizing:border-box}
        html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
        body{margin:0;font-family:'Inter',system-ui,-apple-system,sans-serif;font-size:16px;line-height:1.7;color:#1f2937;background:#f9fafb;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
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
        
        /* Primary Colors */
        .text-primary{color:#0EA5E9}
        .bg-primary{background-color:#0EA5E9}
        .border-primary{border-color:#0EA5E9}
        .hover\:text-primary:hover{color:#0EA5E9}
        .hover\:bg-primary:hover{background-color:#0EA5E9}
        
        /* Animations */
        @keyframes fade-in-up{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}
        .animate-fade-in-up{animation:fade-in-up .8s ease-out forwards;opacity:0}
        .animate-float{animation:float 6s ease-in-out infinite}
        
        /* Skip link */
        .skip-link{position:absolute;top:-40px;left:0;background:#0EA5E9;color:white;padding:8px 16px;z-index:100;transition:top .3s}
        .skip-link:focus{top:0}
        
        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important;scroll-behavior:auto!important}
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            body{font-size:15px}
            a,button{min-height:44px;min-width:44px}
        }
    </style>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#0EA5E9',
                            50: '#F0F9FF',
                            100: '#E0F2FE',
                            200: '#BAE6FD',
                            300: '#7DD3FC',
                            400: '#38BDF8',
                            500: '#0EA5E9',
                            600: '#0284C7',
                            700: '#0369A1',
                            800: '#075985',
                            900: '#0C4A6E',
                        },
                        secondary: '#F97316',
                        navy: '#1E3A5F',
                        accent: '#F97316',
                        ice: '#F0F9FF',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        @media (min-width: 1280px) {
            body { font-size: 17px; }
        }
        
        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Hover effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
        }
        
        /* Text gradient */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Focus styles */
        :focus-visible {
            outline: 2px solid #0EA5E9;
            outline-offset: 2px;
        }
    </style>
    
    <!-- Async Alpine.js -->
    <script defer src="<?php echo e(asset('js/alpine.min.js')); ?>"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800 pb-20 md:pb-0">
    <!-- Skip to main content -->
    <a href="#main-content" class="skip-link">Langsung ke konten utama</a>
    
    <!-- Page Loading Indicator -->
    <div id="page-loading" class="page-loading" aria-hidden="true">
        <div class="page-loading-spinner"></div>
    </div>

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main id="main-content" class="flex-grow" tabindex="-1">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php echo $__env->make('partials.bottom-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('js/validation.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/lightbox.js')); ?>" defer></script>
    
    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(reg) { console.log('SW registered:', reg.scope); })
                    .catch(function(err) { console.log('SW failed:', err); });
            });
        }
        
        // Hide loading
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('page-loading');
            if (loader) {
                setTimeout(() => {
                    loader.classList.add('hidden');
                    setTimeout(() => loader.remove(), 300);
                }, 100);
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\eka\.gemini\antigravity\scratch\smk-alstar\resources\views/layouts/app.blade.php ENDPATH**/ ?>