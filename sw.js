// importScripts('/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/jquery.js');

// var url = jQuery('.article-cards').data('api');
var CACHE_STATIC_NAME = 'static-v8.53.35';
var CACHE_DYNAMIC_NAME = 'dynamic-v8.53.35';
var STATIC_FILES = [
	'/',
    '/index.php',
    '/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/main.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/jquery.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/jquery.min.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/promise.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/fetch.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/scripts/vendor/idb.js',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/styles/main.css',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/fonts/quicksand-bold.woff',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/fonts/quicksand-medium.woff',
	'/wp-content/themes/notAnoobie/assets/notAnoobie/images/banner-gradient-bg.png'
];

self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installing Service Worker ...', event);
    event.waitUntil(
        caches.open(CACHE_STATIC_NAME).then(function (cache) {
            console.log('[Service Worker] Precaching App Shell');
            cache.addAll(STATIC_FILES);
        })
    )
});

self.addEventListener('activate', function (event) {
    console.log('[Service Worker] Activating Service Worker ....', event);
    event.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(keyList.map(function (key) {
                if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
                    console.log('[Service Worker] Removing old cache.', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    return self.clients.claim();
});

function isInArray(string, array) {
    var cachePath;
    if (string.indexOf(self.origin) === 0) { // request targets domain where we serve the page from (i.e. NOT a CDN)
        // console.log('matched ', string);
        cachePath = string.substring(self.origin.length); // take the part of the URL AFTER the domain (e.g. after localhost:8080)
    } else {
        cachePath = string; // store the full request (for CDNs)
    }
    return array.indexOf(cachePath) > -1;
}

// Network then Cache
self.addEventListener('fetch', function(event) {
    event.respondWith(fetch(event.request).then(function(res) {
        return caches.open(CACHE_DYNAMIC_NAME).then(function(cache) {
            cache.put(event.request.url, res.clone());
            return res;
        })
    }).catch(function(err) {
        return caches.match(event.request);
    }));
});

// Cache then Network
// self.addEventListener('fetch', function (event) {
//     var url = 'https://notanoobie.online/wp-json/articles/latest';
//     if (event.request.url.indexOf(url) > -1) {
//         event.respondWith(caches.open(CACHE_DYNAMIC_NAME).then(function (cache) {
//             return fetch(event.request).then(function (res) {
//               // trimCache(CACHE_DYNAMIC_NAME, 3);
//               cache.put(event.request, res.clone());
//               return res;
//             });
//         }));
//     } else if (isInArray(event.request.url, STATIC_FILES)) {
//         event.respondWith(caches.match(event.request));
//     } else {
//         event.respondWith(caches.match(event.request).then(function (response) {
//             if (response) {
//                 return response;
//             } else {
//                 return fetch(event.request).then(function (res) {
//                     return caches.open(CACHE_DYNAMIC_NAME).then(function (cache) {
//                         // trimCache(CACHE_DYNAMIC_NAME, 3);
//                         cache.put(event.request.url, res.clone());
//                         return res;
//                     })
//                 }).catch(function (err) {
//                     return caches.open(CACHE_STATIC_NAME).then(function (cache) {
//                         if (event.request.headers.get('accept').includes('text/html')) {
//                             return cache.match('/');
//                         }
//                     });
//                 });
//             }
//         }));
//     }
// });

// Notification
self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');
    event.notification.close();
    event.waitUntil(
        self.clients.openWindow('https://notanoobie.online/tip-of-the-day/')
    );
});

// self.addEventListener('notificationclose', function(event) {
//     console.log('Notification was closed', event);
// });