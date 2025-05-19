<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Blog Saya' ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <main style="padding: 20px;">
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
