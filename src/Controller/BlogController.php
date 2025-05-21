<?php

namespace App\Controller;

class BlogController
{
    public function index()
    {
        require_once __DIR__ . '/../../templates/render.php';

        $data = [
            'title' => 'Blog',
        ];

        // render('PATH OR LINK', $data, 'LAYOUTS')
        render('dashboard/blog', $data, 'dashboard');
    }
}
