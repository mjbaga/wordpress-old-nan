// importScripts('/assests/notAnoobie/scripts/vendor/idb.js');

var CACHE_STATIC_NAME = 'static-v3.5';
var CACHE_DYNAMIC_NAME = 'dynamic-v3.1';
var STATIC_FILES = [
	'/',
	'/assets/notAnoobie/scripts/main.js',
	'/assets/notAnoobie/scripts/vendor/jquery.js',
	'/assets/notAnoobie/scripts/vendor/jquery.min.js',
	'/assets/notAnoobie/scripts/vendor/promise.js',
	'/assets/notAnoobie/scripts/vendor/fetch.js',
	'/assets/notAnoobie/scripts/vendor/idb.js',
	'/assets/notAnoobie/styles/main.css',
	'/assets/notAnoobie/fonts/quicksand-bold.woff',
	'/assets/notAnoobie/fonts/quicksand-medium.woff',
	'/assets/notAnoobie/images/banner-gradient-bg.png',
	'/assets/notAnoobie/images/temp/tips-bg.jpg',
	'/assets/notAnoobie/images/temp/topic-img.jpg'
];

// self.addEventListener('install', function (event) {
// 	console.log('[Service Worker] Installing Service Worker ...', event);
// 	event.waitUntil(
// 		caches.open(CACHE_STATIC_NAME).then(function (cache) {
// 			console.log('[Service Worker] Precaching App Shell');
// 			cache.addAll(STATIC_FILES);
// 		})
// 	)
// });

// self.addEventListener('fetch', function(event) {
// 	event.respondWith(
// 		caches.match(event.request).then(function(response) {
// 			if (response) {
// 				return response;
// 			} else {
// 				return fetch(event.request).then(function(res) {
// 					return caches.open(CACHE_DYNAMIC_NAME).then(function(cache) {
// 						cache.put(event.request.url, res.clone());
// 						return res;
// 					})
// 				});
// 			}
// 		})
// 	);
// });