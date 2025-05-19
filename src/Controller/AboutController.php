<?php

namespace App\Controller;

class AboutController
{
    public function index()
    {
        require_once __DIR__ . '/../../templates/render.php';

        $data = [
            'title' => 'Tentang Kami',
        ];

        render('about', $data);
    }
}
