<?php

function render(string $pagePath, array $data = [], string $layout = 'default'): void
{
    extract($data); // Menjadikan key array sebagai variabel
    ob_start();
    include __DIR__ . '/pages/' . $pagePath . '.php';
    $content = ob_get_clean();

    // Pilih layout berdasarkan parameter
    $layoutFile = __DIR__ . '/layouts/layout_' . $layout . '.php';

    if (file_exists($layoutFile)) {
        include $layoutFile;
    } else {
        // fallback ke layout default jika tidak ditemukan
        include __DIR__ . '/layouts/layout_default.php';
    }
}
