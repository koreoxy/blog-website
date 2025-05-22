<?php

session_start();
$isLoggedIn = isset($_SESSION['user']);
$isAdmin = $isLoggedIn && $_SESSION['user']['role'] === 'admin';

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
    <?php if ($isLoggedIn): ?>
        <a class="button" href="/dashboard/index">
            <span class="button_top">Dashboard</span>
        </a>
        <a class="button" href="/logout">
            <span class="button_top">Logout</span>
        </a>
    <?php else: ?>
        <a class="button" href="/auth/login">
            <span class="button_top">Login</span>
        </a>
    <?php endif; ?>
</nav>
