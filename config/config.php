<?php
/**
 * config/config.php
 * Global configuration constants for Spread Love Foundation
 */

// Prevent direct access when included incorrectly
if (!defined('SLF_ROOT')) {
    define('SLF_ROOT', dirname(__DIR__));
}

// ---- Site identity ----
define('SITE_NAME', 'Spread Love Foundation');
define('SITE_TAGLINE', 'Nourishing Children Today. Inspiring Their Talents. Building Hope for Tomorrow.');
define('SITE_LOCATION', 'Gashora, Bugesera District, Rwanda');
define('SITE_EMAIL', 'info@spreadlovefoundation.org');
define('SITE_PHONE', '+250 7XX XXX XXX');

// ---- Base URL (adjust when deploying) ----
// For localhost XAMPP:  http://localhost/spread-love-foundation/
define('BASE_URL', 'http://localhost/spread-love-foundation/');

// ---- Assets helpers ----
define('ASSETS_URL', BASE_URL . 'assets/');
define('IMAGES_URL', ASSETS_URL . 'images/');

// ---- Environment ----
define('APP_ENV', 'development'); // 'production' when live

// ---- Error reporting ----
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// ---- Start session (needed for CSRF + flash messages) ----
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}