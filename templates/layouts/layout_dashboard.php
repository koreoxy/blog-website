<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin' ?></title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>

    <div class= "dashboard-container">
        <?php include __DIR__ . '/../partials/sidebar.php'; ?>

        <main class="content">
            <?= $content ?>
        </main>

    </div>

</body>
</html>
