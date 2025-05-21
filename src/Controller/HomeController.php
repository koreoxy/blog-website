<?php

namespace App\Controller;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../../templates/render.php';

        // Data yang ingin dikirim ke view
        $data = [
            'title' => 'Home',
        ];

        // Tampilkan halaman menggunakan sistem layout
        render('home', $data, 'home');
    }
}
