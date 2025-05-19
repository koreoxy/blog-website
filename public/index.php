<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../templates/render.php';

// Autoload controller
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

// Ambil path dari URL seperti "/about"
$path = $_GET['path'] ?? '';
$path = trim($path, '/'); // hilangkan '/' di awal/akhir

// Jika kosong, berarti ke home
$page = $path === '' ? 'home' : $path;

// Routing
$routes = [
    'home'  => \App\Controller\HomeController::class,
    'about' => \App\Controller\AboutController::class,
];

if (array_key_exists($page, $routes)) {
    $controllerClass = $routes[$page];
    $controller = new $controllerClass();
    $controller->index();
} else {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
}
