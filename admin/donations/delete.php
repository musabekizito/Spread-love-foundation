<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$id    = (int)($_GET['id'] ?? 0);
$token = $_GET['token'] ?? '';

if (!csrf_verify($token) || $id <= 0) {
    set_flash('error', 'Invalid delete request.');
    redirect(BASE_URL . 'admin/donations/list.php');
}

db()->prepare('DELETE FROM donations WHERE id = ?')->execute([$id]);
set_flash('success', 'Donation deleted.');
redirect(BASE_URL . 'admin/donations/list.php');