<?php

namespace App\Controller;

class DashboardController
{
    public function index()
    {
        require_once __DIR__ . '/../../templates/render.php';

        // Data yang ingin dikirim ke view
        $data = [
            'title' => 'Dashboard',
        ];

        // Tampilkan halaman menggunakan sistem layout
        render('dashboard/index', $data, 'dashboard');
    }
}
