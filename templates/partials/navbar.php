<?php
$uri = $_GET['path'] ?? '';
$currentPage = $uri === '' ? 'home' : trim($uri, '/');

$navItems = [
    'home'  => 'Home',
    'about' => 'About',
];
?>

<nav style="background-color: #007bff; padding: 10px;">
    <ul style="list-style: none; display: flex; gap: 20px;">
        <?php foreach ($navItems as $key => $label): ?>
            <li>
                <a href="/<?= $key ?>" style="color: white; text-decoration: <?= $currentPage === $key ? 'underline' : 'none' ?>;">
                    <?= $label ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
