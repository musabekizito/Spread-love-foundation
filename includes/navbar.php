<?php
/**
 * includes/navbar.php
 * Responsive navigation bar.
 */
$nav = [
    'index'          => 'Home',
    'about'          => 'About Us',
    'programs'       => 'Programs',
    'gallery'        => 'Gallery',
    'get-involved'   => 'Get Involved',
    'contact'        => 'Contact',
];
$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF'] ?? 'index.php', '.php');
?>
<header class="site-header">
    <div class="container header-inner">
        <a href="<?= e(BASE_URL) ?>index.php" class="brand">
            <img src="<?= e(IMAGES_URL) ?>logo.png" alt="<?= e(SITE_NAME) ?> logo" class="brand-logo">
            <span class="brand-text">
                <span>Spread Love</span>
                <span class="brand-foundation">Foundation</span>
            </span>
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <ul>
                <?php foreach ($nav as $slug => $label): ?>
                    <li>
                        <a href="<?= e(BASE_URL . $slug) ?>.php"
                           class="<?= ($currentPage === $slug) ? 'active' : '' ?>">
                            <?= e($label) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li>
                    <a href="<?= e(BASE_URL) ?>get-involved.php#donate" class="btn btn-primary btn-sm donate-link">
                        <svg class="donate-heart" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1L12 21l7.8-7.5 1.1-1.1a5.5 5.5 0 0 0-.1-7.8Z"/>
                        </svg>
                        Donate
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>