<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Programs';
$programs = db()->query('SELECT * FROM programs ORDER BY id ASC')->fetchAll();

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <h2>Programs</h2>
    <p class="muted">Edit the Daily Care and ABANA program content shown on the public site.</p>

    <table class="admin-table">
        <thead><tr><th>#</th><th>Title</th><th>Slug</th><th>Image</th><th>Updated</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($programs as $p): ?>
            <tr>
                <td><?= (int)$p['id'] ?></td>
                <td><?= e($p['title']) ?></td>
                <td><?= e($p['slug']) ?></td>
                <td><?= e($p['image'] ?: '—') ?></td>
                <td><?= e(date('M j, Y', strtotime($p['updated_at']))) ?></td>
                <td><a href="edit.php?id=<?= (int)$p['id'] ?>" class="btn btn-sm btn-secondary">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>