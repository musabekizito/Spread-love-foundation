<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$id    = (int)($_GET['id'] ?? 0);
$token = $_GET['token'] ?? '';

if (!csrf_verify($token) || $id <= 0) {
    set_flash('error', 'Invalid delete request.');
    redirect(BASE_URL . 'admin/gallery/list.php');
}

$pdo = db();
$row = $pdo->prepare('SELECT image FROM gallery WHERE id = ?');
$row->execute([$id]);
$item = $row->fetch();

if ($item) {
    $path = SLF_ROOT . '/uploads/gallery/' . $item['image'];
    if (is_file($path)) @unlink($path);
    $pdo->prepare('DELETE FROM gallery WHERE id = ?')->execute([$id]);
    set_flash('success', 'Photo deleted.');
}

redirect(BASE_URL . 'admin/gallery/list.php');