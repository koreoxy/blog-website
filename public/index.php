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

session_start();

// Ambil path dari URL: contoh /auth/login
$path = $_GET['path'] ?? '';
$path = trim($path, '/');

// Jika kosong, arahkan ke home/index
$segments = explode('/', $path);
$controllerName = $segments[0] ?? 'home';
$methodName = $segments[1] ?? 'index';

// Routing map: controller name => controller class
$routes = [
    'home'      => \App\Controller\HomeController::class,
    'about'     => \App\Controller\AboutController::class,
    'auth'      => \App\Controller\AuthController::class,
    'dashboard' => \App\Controller\DashboardController::class,
    'logout'    => 'logout',
];

// Handle logout secara khusus
if ($controllerName === 'logout') {
    session_destroy();
    header('Location: /auth/login');
    exit;
}

if (array_key_exists($controllerName, $routes)) {
    $controllerClass = $routes[$controllerName];
    $controller = new $controllerClass();

    // Jalankan method jika ada
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        http_response_code(404);
        echo "404 - Method '$methodName' tidak ditemukan.";
    }
} else {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan.";
}
