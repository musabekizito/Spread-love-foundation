<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Donations';
$pdo = db();

// Update status via dropdown (existing behaviour)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'set_status') {
    if (csrf_verify($_POST['csrf_token'] ?? null)) {
        $id     = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        if (in_array($status, ['pending', 'completed', 'failed'], true)) {
            $pdo->prepare('UPDATE donations SET status = ? WHERE id = ?')->execute([$status, $id]);
            set_flash('success', 'Donation status updated.');
        }
    }
    redirect(BASE_URL . 'admin/donations/list.php');
}

// Filters
$filter = $_GET['filter'] ?? '';
$where  = '';
if ($filter === 'pending')   $where = "WHERE status = 'pending'";
if ($filter === 'completed') $where = "WHERE status = 'completed'";
if ($filter === 'failed')    $where = "WHERE status = 'failed'";

$donations = $pdo->query("SELECT * FROM donations $where ORDER BY donated_at DESC")->fetchAll();

$totalCompleted = (float)$pdo->query(
    "SELECT COALESCE(SUM(amount),0) FROM donations WHERE status = 'completed'"
)->fetchColumn();

$pendingCount = (int)$pdo->query(
    "SELECT COUNT(*) FROM donations WHERE status = 'pending'"
)->fetchColumn();

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <div class="panel-header">
        <h2>Donations</h2>
        <div class="panel-actions">
            <span class="muted">
                Total raised: <strong>RWF <?= number_format($totalCompleted, 0) ?></strong>
                &nbsp;|&nbsp;
                Pending: <strong><?= $pendingCount ?></strong>
            </span>
            <a href="record.php" class="btn btn-primary btn-sm">+ Record Donation</a>
        </div>
    </div>

    <div class="filter-bar">
        <a href="list.php" class="chip <?= $filter === '' ? 'active' : '' ?>">All</a>
        <a href="list.php?filter=pending"   class="chip <?= $filter === 'pending'   ? 'active' : '' ?>">Pending</a>
        <a href="list.php?filter=completed" class="chip <?= $filter === 'completed' ? 'active' : '' ?>">Completed</a>
        <a href="list.php?filter=failed"    class="chip <?= $filter === 'failed'    ? 'active' : '' ?>">Failed</a>
    </div>

    <?php if (!$donations): ?>
        <p class="muted">No donations found.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th><th>Donor</th><th>Amount</th><th>Method</th>
                    <th>Reference</th><th>Status</th><th>Date</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($donations as $d): ?>
                <tr>
                    <td><?= (int)$d['id'] ?></td>
                    <td>
                        <?= e($d['donor_name'] ?: 'Anonymous') ?><br>
                        <small class="muted"><?= e($d['email'] ?: '—') ?></small>
                        <?php if (!empty($d['payer_phone'])): ?>
                            <br><small class="muted"><?= e($d['payer_phone']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= e($d['currency']) ?> <?= number_format((float)$d['amount'], 0) ?></td>
                    <td><?= e(strtoupper($d['payment_method'] ?? ($d['method'] ?? '—'))) ?></td>
                    <td>
                        <small><?= e($d['transaction_ref'] ?: ($d['reference'] ?: '—')) ?></small>
                    </td>
                    <td>
                        <span class="badge badge-<?= $d['status'] === 'completed' ? 'ok' : ($d['status'] === 'failed' ? 'err' : 'warn') ?>">
                            <?= e(ucfirst($d['status'])) ?>
                        </span>
                        <?php if (!empty($d['verified_at'])): ?>
                            <br><small class="muted">Verified <?= e(date('M j', strtotime($d['verified_at']))) ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= e(date('M j, Y', strtotime($d['donated_at']))) ?></td>
                    <td class="actions">
                        <?php if ($d['status'] === 'pending'): ?>
                            <a href="verify.php?id=<?= (int)$d['id'] ?>&token=<?= e(csrf_token()) ?>"
                               class="btn btn-sm btn-primary"
                               onclick="return confirm('Confirm this donation has been received?');">
                               ✓ Verify
                            </a>
                        <?php endif; ?>
                        <form method="POST" class="inline-form">
                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                            <input type="hidden" name="action" value="set_status">
                            <input type="hidden" name="id" value="<?= (int)$d['id'] ?>">
                            <select name="status">
                                <option value="pending"   <?= $d['status'] === 'pending'   ? 'selected' : '' ?>>Pending</option>
                                <option value="completed" <?= $d['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="failed"    <?= $d['status'] === 'failed'    ? 'selected' : '' ?>>Failed</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-secondary">Update</button>
                        </form>
                        <a href="delete.php?id=<?= (int)$d['id'] ?>&token=<?= e(csrf_token()) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this donation?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>