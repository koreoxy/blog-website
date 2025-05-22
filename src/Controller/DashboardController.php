<?php

namespace App\Controller;

class DashboardController
{
    public function __construct()
    {
        require_once __DIR__ . '/../Middlewares/middleware.php';
        require_once __DIR__ . '/../../templates/render.php';

        // Middleware: pastikan hanya admin yang bisa akses dashboard
        isAdmin();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        // render('PATH OR LINK', $data, 'LAYOUTS')
        render('dashboard/index', $data, 'dashboard');
    }

    public function blog()
    {
        $data = [
            'title' => 'Blog',
        ];

        render('dashboard/blog', $data, 'dashboard');
    }
}
