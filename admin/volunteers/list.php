<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Volunteers';
$pdo = db();

// Update status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'set_status') {
    if (csrf_verify($_POST['csrf_token'] ?? null)) {
        $id     = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        if (in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $pdo->prepare('UPDATE volunteers SET status = ? WHERE id = ?')->execute([$status, $id]);
            set_flash('success', 'Volunteer status updated.');
        }
    }
    redirect(BASE_URL . 'admin/volunteers/list.php');
}

$volunteers = $pdo->query('SELECT * FROM volunteers ORDER BY created_at DESC')->fetchAll();

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <?php if (!$volunteers): ?>
        <p class="muted">No volunteer submissions yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Skills</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($volunteers as $v): ?>
                <tr>
                    <td><?= (int)$v['id'] ?></td>
                    <td><?= e($v['name']) ?></td>
                    <td><?= e($v['email']) ?></td>
                    <td><?= e($v['phone'] ?: '—') ?></td>
                    <td><?= e($v['skills'] ?: '—') ?></td>
                    <td>
                        <span class="badge badge-<?= $v['status'] === 'approved' ? 'ok' : ($v['status'] === 'rejected' ? 'err' : 'warn') ?>">
                            <?= e(ucfirst($v['status'])) ?>
                        </span>
                    </td>
                    <td class="actions">
                        <form method="POST" class="inline-form">
                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                            <input type="hidden" name="action" value="set_status">
                            <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                            <select name="status">
                                <option value="pending"  <?= $v['status'] === 'pending'  ? 'selected' : '' ?>>Pending</option>
                                <option value="approved" <?= $v['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="rejected" <?= $v['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-secondary">Update</button>
                        </form>
                        <a href="mailto:<?= e($v['email']) ?>" class="btn btn-sm">Email</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>