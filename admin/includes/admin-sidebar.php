<?php
$currentAdminPage = basename($_SERVER['PHP_SELF']);
$currentAdminDir  = basename(dirname($_SERVER['PHP_SELF']));

$menu = [
    ['href' => 'dashboard.php',       'label' => 'Dashboard',       'icon' => '🏠', 'dir' => 'admin',       'key' => 'dashboard'],
    ['href' => 'messages/list.php',   'label' => 'Messages',        'icon' => '✉️', 'dir' => 'messages',   'key' => 'list'],
    ['href' => 'volunteers/list.php', 'label' => 'Volunteers',      'icon' => '🤝', 'dir' => 'volunteers', 'key' => 'list'],
    ['href' => 'donations/list.php',  'label' => 'Donations',       'icon' => '💰', 'dir' => 'donations',  'key' => 'list'],
    ['href' => 'gallery/list.php',    'label' => 'Gallery',         'icon' => '🖼️', 'dir' => 'gallery',    'key' => 'list'],
    ['href' => 'programs/list.php',   'label' => 'Programs',        'icon' => '📚', 'dir' => 'programs',   'key' => 'list'],
    ['href' => 'settings/general.php','label' => 'Settings',        'icon' => '⚙️', 'dir' => 'settings',   'key' => 'general'],
];
?>
<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-brand">
        <span class="admin-brand-dot"></span>
        <span><?= e(SITE_NAME) ?></span>
    </div>
    <nav class="admin-nav">
        <?php foreach ($menu as $item): ?>
            <?php
                $isActive = ($currentAdminDir === $item['dir'] && $currentAdminPage === $item['key'])
                         || ($item['dir'] === 'admin' && $currentAdminPage === 'dashboard.php');
            ?>
            <a href="<?= e(BASE_URL . 'admin/' . $item['href']) ?>"
               class="admin-nav-link <?= $isActive ? 'active' : '' ?>">
                <span class="admin-nav-icon"><?= $item['icon'] ?></span>
                <span><?= e($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
    <div class="admin-sidebar-footer">
        <a href="<?= e(BASE_URL) ?>index.php" target="_blank">View Website ↗</a>
    </div>
</aside>