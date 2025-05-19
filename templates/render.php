<?php

function render(string $pagePath, array $data = []): void
{
    extract($data); // menjadikan key array sebagai variabel
    ob_start();
    include __DIR__ . '/pages/' . $pagePath . '.php';
    $content = ob_get_clean();

    include __DIR__ . '/layouts/layout.php';
}
