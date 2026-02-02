/**
 * Service Worker untuk SMK Al-Hidayah Lestari
 * Strategi: Cache First, then Network
 * @version 2.0.0
 */

const CACHE_NAME = 'smk-alstar-v2';
const STATIC_CACHE = 'static-v2';
const IMAGE_CACHE = 'images-v2';
const API_CACHE = 'api-v2';

// Assets yang di-cache saat install
const PRECACHE_ASSETS = [
    '/',
    '/offline.html',
    '/images/logo.webp',
    '/js/alpine.min.js',
    '/js/validation.js',
    '/js/lightbox.js',
    '/build/assets/app.css',
    '/build/assets/app.js',
];

// Install Event - Precache assets
self.addEventListener('install', (event) => {
    console.log('[SW] Installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then((cache) => {
                console.log('[SW] Precaching assets');
                return cache.addAll(PRECACHE_ASSETS);
            })
            .then(() => self.skipWaiting())
            .catch((err) => console.error('[SW] Precache failed:', err))
    );
});

// Activate Event - Cleanup old caches
self.addEventListener('activate', (event) => {
    console.log('[SW] Activating...');
    
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((name) => {
                        return name.startsWith('smk-alstar-') || 
                               name.startsWith('static-') || 
                               name.startsWith('images-') ||
                               name.startsWith('api-');
                    })
                    .filter((name) => {
                        return name !== STATIC_CACHE && 
                               name !== IMAGE_CACHE && 
                               name !== API_CACHE;
                    })
                    .map((name) => {
                        console.log('[SW] Deleting old cache:', name);
                        return caches.delete(name);
                    })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Event - Cache strategies
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') return;
    
    // Skip chrome-extension and other non-http schemes
    if (!url.protocol.startsWith('http')) return;
    
    // Strategy untuk CSS & JS files - Stale While Revalidate
    if (request.destination === 'style' || request.destination === 'script') {
        event.respondWith(staleWhileRevalidate(request, STATIC_CACHE));
        return;
    }
    
    // Strategy untuk Images - Cache First
    if (request.destination === 'image') {
        event.respondWith(cacheFirst(request, IMAGE_CACHE));
        return;
    }
    
    // Strategy untuk Fonts - Cache First dengan long expiry
    if (request.destination === 'font') {
        event.respondWith(cacheFirst(request, STATIC_CACHE));
        return;
    }
    
    // Strategy untuk API calls - Network First
    if (url.pathname.startsWith('/api/') || url.pathname.includes('/ajax/')) {
        event.respondWith(networkFirst(request, API_CACHE));
        return;
    }
    
    // Strategy untuk HTML pages - Network First dengan offline fallback
    if (request.destination === 'document') {
        event.respondWith(networkFirstWithOfflineFallback(request));
        return;
    }
    
    // Default: Network First
    event.respondWith(networkFirst(request, STATIC_CACHE));
});

// Cache Strategies

// Cache First - Cocok untuk images, fonts
async function cacheFirst(request, cacheName) {
    const cache = await caches.open(cacheName);
    const cached = await cache.match(request);
    
    if (cached) {
        // Refresh cache in background
        fetch(request).then((response) => {
            if (response.ok) {
                cache.put(request, response.clone());
            }
        }).catch(() => {});
        
        return cached;
    }
    
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        console.error('[SW] Cache first failed:', error);
        throw error;
    }
}

// Network First - Cocok untuk API calls
async function networkFirst(request, cacheName) {
    const cache = await caches.open(cacheName);
    
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        const cached = await cache.match(request);
        if (cached) {
            return cached;
        }
        throw error;
    }
}

// Network First dengan Offline Fallback untuk HTML pages
async function networkFirstWithOfflineFallback(request) {
    const cache = await caches.open(STATIC_CACHE);
    
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        const cached = await cache.match(request);
        if (cached) {
            return cached;
        }
        // Return offline page
        const offlinePage = await cache.match('/offline.html');
        if (offlinePage) {
            return offlinePage;
        }
        
        // Fallback response
        return new Response(
            '<html><body style="font-family:sans-serif;text-align:center;padding:50px;"><h1>Offline</h1><p>Anda sedang offline. Silakan cek koneksi internet Anda.</p></body></html>',
            { 
                status: 503, 
                headers: { 'Content-Type': 'text/html' }
            }
        );
    }
}

// Stale While Revalidate - Cocok untuk CSS/JS
async function staleWhileRevalidate(request, cacheName) {
    const cache = await caches.open(cacheName);
    const cached = await cache.match(request);
    
    const networkFetch = fetch(request).then((networkResponse) => {
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    }).catch(() => {});
    
    if (cached) {
        return cached;
    }
    
    return networkFetch;
}

// Background Sync untuk form submissions
self.addEventListener('sync', (event) => {
    if (event.tag === 'sync-forms') {
        event.waitUntil(syncFormSubmissions());
    }
});

async function syncFormSubmissions() {
    // Implementasi sync form submissions dari IndexedDB
    console.log('[SW] Syncing form submissions...');
}

// Push Notifications (jika diperlukan nanti)
self.addEventListener('push', (event) => {
    if (event.data) {
        const data = event.data.json();
        event.waitUntil(
            self.registration.showNotification(data.title, {
                body: data.body,
                icon: '/images/logo.webp',
                badge: '/images/logo.webp',
                data: data.data,
                actions: data.actions || [],
            })
        );
    }
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    
    if (event.action) {
        // Handle action buttons
        console.log('[SW] Notification action:', event.action);
    } else {
        // Default: open app
        event.waitUntil(
            clients.openWindow(event.notification.data?.url || '/')
        );
    }
});

// Message handler dari main thread
self.addEventListener('message', (event) => {
    if (event.data === 'skipWaiting') {
        self.skipWaiting();
    }
});
