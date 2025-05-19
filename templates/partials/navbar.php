<?php
$uri = $_GET['path'] ?? '';
$currentPage = $uri === '' ? 'home' : trim($uri, '/');

$navItems = [
    'home'  => 'Home',
    'about' => 'About',
];
?>

<nav class="container">
    <div class="logo">
        <img src="/assets/img/logo.svg" alt="logo">
        <span href="">Koreophyte</span>
    </div>
    <ul class="link">  
        <?php foreach ($navItems as $key => $label): ?>
            <li>
                <a href="/<?= $key ?>" style="text-decoration: <?= $currentPage === $key ? 'underline' : 'none' ?>;">
                    <?= $label ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a class="button">
        <span class="button_top">Login</span>
    </a>
</nav>
