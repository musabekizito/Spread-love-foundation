<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$id    = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
$token = $_POST['csrf_token'] ?? $_GET['token'] ?? '';

if (!csrf_verify($token) || $id <= 0) {
    set_flash('error', 'Invalid verification request.');
    redirect(BASE_URL . 'admin/donations/list.php');
}

$pdo = db();
$admin = current_admin();

$pdo->prepare(
    'UPDATE donations
     SET status = "completed", verified_by = ?, verified_at = NOW()
     WHERE id = ?'
)->execute([$admin['id'], $id]);

set_flash('success', 'Donation verified and marked as completed.');
redirect(BASE_URL . 'admin/donations/list.php');