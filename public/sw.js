/**
 * Portfolio Single Page Application (SPA) Service Worker
 * Enables offline capability and ultra-fast asset delivery.
 */

const CACHE_NAME = 'hemkhatri-portfolio-cache-v1';

// Relative URLs to pre-cache (resolved relative to sw.js location)
const PRECACHE_ASSETS = [
    './',
    'index.php',
    'articles/articles.php',
    'offline.php',
    'assets/js/spa-router.js',
    'assets/favicon/profile.png',
    'assets/icons/ai_assistant_icon.svg',
    'assets/icons/ai_profile.svg',
    'assets/icons/user_profile.svg',
    'https://cdn.tailwindcss.com',
    'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap'
];

// Perform install & cache core assets
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('[Service Worker] Pre-caching static app shell');
                return cache.addAll(PRECACHE_ASSETS);
            })
            .then(() => self.skipWaiting())
    );
});

// Perform activation & clear out-of-date caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== CACHE_NAME) {
                        console.log('[Service Worker] Clearing old cache:', cache);
                        return caches.delete(cache);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Intercept requests
self.addEventListener('fetch', event => {
    const request = event.request;
    const url = new URL(request.url);

    // Bypass caching for third-party requests or backend API endpoints
    // (e.g. Blogger data, dynamic chat handler, or PHP POST handlers)
    if (
        request.method !== 'GET' ||
        url.pathname.includes('/backend/') ||
        url.pathname.includes('/post_cache/') ||
        url.pathname.includes('ai-backend.php') ||
        url.pathname.includes('blogger_post_handler.php')
    ) {
        // Network-Only strategy
        return;
    }

    // HTML Page requests (pages ending in .php or without files extensions)
    const isHtmlRequest = request.headers.get('accept')?.includes('text/html') || 
                          url.pathname.endsWith('.php') || 
                          !url.pathname.split('/').pop().includes('.');

    if (isHtmlRequest) {
        // Network-First with Cache fallback
        event.respondWith(
            fetch(request)
                .then(response => {
                    // Update cache with the latest page version
                    const responseCopy = response.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(request, responseCopy);
                    });
                    return response;
                })
                .catch(() => {
                    // Fetch failed (user is offline), try cache
                    return caches.match(request).then(cachedResponse => {
                        if (cachedResponse) {
                            return cachedResponse;
                        }
                        // If not in cache, fallback to beautiful offline.php
                        return caches.match('offline.php');
                    });
                })
        );
    } else {
        // Static assets (CSS, JS, Fonts, Images): Cache-First strategy
        event.respondWith(
            caches.match(request).then(cachedResponse => {
                if (cachedResponse) {
                    return cachedResponse;
                }
                return fetch(request).then(response => {
                    // Cache the newly fetched asset
                    const responseCopy = response.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(request, responseCopy);
                    });
                    return response;
                });
            })
        );
    }
});
