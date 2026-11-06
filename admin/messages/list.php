<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Messages';
$pdo = db();

// Mark as read
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'mark_read') {
    if (csrf_verify($_POST['csrf_token'] ?? null)) {
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = ?')->execute([$id]);
        set_flash('success', 'Message marked as read.');
    }
    redirect(BASE_URL . 'admin/messages/list.php');
}

$messages = $pdo->query(
    'SELECT * FROM contact_messages ORDER BY created_at DESC'
)->fetchAll();

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <?php if (!$messages): ?>
        <p class="muted">No messages yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $m): ?>
                <tr>
                    <td><?= (int)$m['id'] ?></td>
                    <td><?= e($m['name']) ?></td>
                    <td><?= e($m['email']) ?></td>
                    <td><?= e($m['subject'] ?: '—') ?></td>
                    <td><?= e(date('M j, Y H:i', strtotime($m['created_at']))) ?></td>
                    <td>
                        <span class="badge badge-<?= $m['is_read'] ? 'ok' : 'warn' ?>">
                            <?= $m['is_read'] ? 'Read' : 'Unread' ?>
                        </span>
                    </td>
                    <td class="actions">
                        <a href="view.php?id=<?= (int)$m['id'] ?>" class="btn btn-sm btn-secondary">View</a>
                        <?php if (!$m['is_read']): ?>
                            <form method="POST" class="inline-form">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="action" value="mark_read">
                                <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                                <button type="submit" class="btn btn-sm">Mark Read</button>
                            </form>
                        <?php endif; ?>
                        <a href="delete.php?id=<?= (int)$m['id'] ?>&token=<?= e(csrf_token()) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this message?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>