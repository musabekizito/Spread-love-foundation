<?php
/**
 * admin/includes/admin-header.php
 * Expects $adminPageTitle to be set before inclusion.
 */
if (!isset($adminPageTitle)) $adminPageTitle = 'Admin';
$admin = current_admin();
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($adminPageTitle) ?> | Admin — <?= e(SITE_NAME) ?></title>
    <link rel="stylesheet" href="<?= e(ASSETS_URL) ?>css/admin.css">
</head>
<body class="admin-body">
<div class="admin-layout">
    <?php include __DIR__ . '/admin-sidebar.php'; ?>

    <div class="admin-main">
        <header class="admin-topbar">
            <button class="admin-menu-toggle" id="adminMenuToggle" aria-label="Toggle menu">☰</button>
            <h1 class="admin-page-title"><?= e($adminPageTitle) ?></h1>
            <div class="admin-user">
                <span><?= e($admin['name']) ?></span>
                <a href="<?= e(BASE_URL) ?>admin/logout.php" class="admin-logout">Logout</a>
            </div>
        </header>

        <?php if ($flash): ?>
            <div class="flash flash-<?= e($flash['type']) ?>">
                <span><?= e($flash['message']) ?></span>
                <button type="button" class="flash-close" aria-label="Dismiss">&times;</button>
            </div>
        <?php endif; ?>

        <div class="admin-content">