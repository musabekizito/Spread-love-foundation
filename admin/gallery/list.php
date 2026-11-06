<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Gallery';
$pdo = db();

// Optional inline sort update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_caption') {
    if (csrf_verify($_POST['csrf_token'] ?? null)) {
        $id      = (int)($_POST['id'] ?? 0);
        $title   = trim($_POST['title'] ?? '');
        $caption = trim($_POST['caption'] ?? '');
        $order   = (int)($_POST['sort_order'] ?? 0);
        $pdo->prepare('UPDATE gallery SET title = ?, caption = ?, sort_order = ? WHERE id = ?')
            ->execute([$title, $caption, $order, $id]);
        set_flash('success', 'Gallery item updated.');
    }
    redirect(BASE_URL . 'admin/gallery/list.php');
}

$items = $pdo->query('SELECT * FROM gallery ORDER BY sort_order ASC, id DESC')->fetchAll();

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <div class="panel-header">
        <h2>Gallery Photos</h2>
        <a href="upload.php" class="btn btn-primary btn-sm">+ Upload Photo</a>
    </div>

    <?php if (!$items): ?>
        <p class="muted">No photos yet.</p>
    <?php else: ?>
        <div class="gallery-admin-grid">
            <?php foreach ($items as $g): ?>
                <div class="gallery-admin-card">
                    <img src="<?= e(BASE_URL . 'uploads/gallery/' . $g['image']) ?>"
                         alt="<?= e($g['title'] ?: '') ?>">
                    <form method="POST" class="admin-form">
                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="action" value="update_caption">
                        <input type="hidden" name="id" value="<?= (int)$g['id'] ?>">
                        <label>Title
                            <input type="text" name="title" value="<?= e($g['title']) ?>" maxlength="150">
                        </label>
                        <label>Caption
                            <textarea name="caption" rows="2"><?= e($g['caption']) ?></textarea>
                        </label>
                        <label>Order
                            <input type="number" name="sort_order" value="<?= (int)$g['sort_order'] ?>">
                        </label>
                        <button class="btn btn-sm btn-secondary" type="submit">Save</button>
                        <a class="btn btn-sm btn-danger"
                           href="delete.php?id=<?= (int)$g['id'] ?>&token=<?= e(csrf_token()) ?>"
                           onclick="return confirm('Delete this photo?');">Delete</a>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>