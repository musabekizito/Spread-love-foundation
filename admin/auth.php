<?php
/**
 * admin/auth.php
 * Session guard. Include at top of every protected admin page.
 */
require_once __DIR__ . '/../includes/functions.php';

if (empty($_SESSION['admin_id'])) {
    redirect(BASE_URL . 'admin/index.php');
}

/** Current admin info helper */
function current_admin(): array
{
    return [
        'id'    => $_SESSION['admin_id']    ?? 0,
        'name'  => $_SESSION['admin_name']  ?? 'Admin',
        'email' => $_SESSION['admin_email'] ?? '',
        'role'  => $_SESSION['admin_role']  ?? 'editor',
    ];
}