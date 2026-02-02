/**
 * SMK Al-Hidayah Lestari - Main JavaScript
 * Optimized for performance
 */

// Lazy load non-critical components
const lazyLoadComponents = () => {
    // Lightbox functionality
    const lightbox = document.querySelectorAll('[data-lightbox]');
    if (lightbox.length > 0) {
        import('./lightbox.js').then(module => {
            module.initLightbox();
        }).catch(err => console.warn('Lightbox load failed:', err));
    }
};

// Intersection Observer untuk lazy loading elements
const setupLazyLoad = () => {
    const lazyElements = document.querySelectorAll('[data-lazy]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    
                    if (element.dataset.src) {
                        element.src = element.dataset.src;
                        element.removeAttribute('data-src');
                    }
                    
                    if (element.dataset.srcset) {
                        element.srcset = element.dataset.srcset;
                        element.removeAttribute('data-srcset');
                    }
                    
                    element.classList.add('loaded');
                    observer.unobserve(element);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });
        
        lazyElements.forEach(element => imageObserver.observe(element));
    } else {
        // Fallback untuk browser lama
        lazyElements.forEach(element => {
            if (element.dataset.src) {
                element.src = element.dataset.src;
            }
        });
    }
};

// Preload critical resources
const preloadResources = () => {
    const criticalResources = [
        '/images/logo.webp',
    ];
    
    criticalResources.forEach(resource => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.href = resource;
        link.as = resource.endsWith('.webp') || resource.endsWith('.jpg') || resource.endsWith('.png') ? 'image' : 'fetch';
        document.head.appendChild(link);
    });
};

// Optimize images loading
const optimizeImages = () => {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    images.forEach(img => {
        // Tambahkan fade-in effect
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
        
        img.addEventListener('load', () => {
            img.style.opacity = '1';
        });
        
        // Error handling
        img.addEventListener('error', () => {
            img.style.display = 'none';
        });
    });
};

// Service Worker update handler
const handleServiceWorker = () => {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            console.log('New service worker activated, reloading...');
            window.location.reload();
        });
        
        // Check for updates setiap 1 jam
        setInterval(() => {
            navigator.serviceWorker.ready.then(registration => {
                registration.update();
            });
        }, 3600000);
    }
};

// Performance monitoring
const initPerformanceMonitoring = () => {
    if ('performance' in window) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                const perfData = performance.getEntriesByType('navigation')[0];
                if (perfData) {
                    console.log('Page Load Time:', Math.round(perfData.loadEventEnd - perfData.startTime), 'ms');
                    console.log('DOM Ready:', Math.round(perfData.domContentLoadedEventEnd - perfData.startTime), 'ms');
                }
            }, 0);
        });
    }
};

// Smooth scroll untuk anchor links
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Initialize
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

function init() {
    setupLazyLoad();
    optimizeImages();
    lazyLoadComponents();
    handleServiceWorker();
    initPerformanceMonitoring();
    
    // Preload resources setelah page load
    if ('requestIdleCallback' in window) {
        requestIdleCallback(preloadResources);
    } else {
        setTimeout(preloadResources, 2000);
    }
}

// Export untuk digunakan modul lain
window.SMKAlstar = {
    preloadResources,
    setupLazyLoad,
};
