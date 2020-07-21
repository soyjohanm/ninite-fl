var NOMBRE_CACHE = 'cache-ninitefl';
var PAGINAS_A_CACHE = [
  '/',
  'offline.html',
  'assets/styles/main.css',
  'assets/scripts/main.js',
  'assets/images/icon-72x72.png'
];

self.addEventListener('install', function(event) {
  console.log('La service worker está siendo instalada.');
  event.waitUntil(
    caches.open(NOMBRE_CACHE)
      .then(function(cache) {
        return cache.addAll(PAGINAS_A_CACHE);
      })
  );
});

self.addEventListener('activate', function(event) {
  console.log('Finalmente ya activa. ¡Lista para servir contenido!');
});
