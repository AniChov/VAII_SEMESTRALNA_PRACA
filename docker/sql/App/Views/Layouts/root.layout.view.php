<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JeToJASne Studio</title>

    <link rel="stylesheet" href="<?= $link->asset('css/style.css') ?>?v=<?= filemtime(__DIR__ . '/../../../public/css/style.css') ?>">
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= $link->url('home.index') ?>">
        <span class="logo">LOGO</span>
        <h1>JeToJASne Studio</h1>
    </a>

    <button class="user-button" type="button"
            aria-label="Používateľský účet">
        A
    </button>
</header>

<?= $contentHTML ?>
</body>
</html>
