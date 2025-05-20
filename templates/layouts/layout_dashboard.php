<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin' ?></title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>

    <?php include __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="container">
        <?= $content ?>
    </main>

    

</body>
</html>
