<?php

require_once __DIR__ . '/functions.php';

$pageTitle       = $pageTitle       ?? SITE_NAME;
$pageDescription = $pageDescription ?? SITE_TAGLINE;
$currentPage     = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="theme-color" content="#e74c3c">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:type" content="website">

    <link rel="icon" href="<?= e(IMAGES_URL) ?>logo.jpeg" type="image/jpeg">
    <link rel="stylesheet" href="<?= e(ASSETS_URL) ?>css/style.css">
    <link rel="stylesheet" href="<?= e(ASSETS_URL) ?>css/responsive.css">
</head>
<body class="page-<?= e($currentPage) ?>">
<?php include __DIR__ . '/navbar.php'; ?>

<?php if ($flash = get_flash()): ?>
    <div class="flash flash-<?= e($flash['type']) ?>" role="alert">
        <span><?= e($flash['message']) ?></span>
        <button type="button" class="flash-close" aria-label="Dismiss">&times;</button>
    </div>
<?php endif; ?>

<main id="main-content">