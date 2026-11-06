<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/database.php';

$adminPageTitle = 'Dashboard';

$pdo = db();
$stats = [
    'messages'   => (int)$pdo->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn(),
    'unread'     => (int)$pdo->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn(),
    'volunteers' => (int)$pdo->query('SELECT COUNT(*) FROM volunteers')->fetchColumn(),
    'pending'    => (int)$pdo->query("SELECT COUNT(*) FROM volunteers WHERE status = 'pending'")->fetchColumn(),
    'donations'  => (int)$pdo->query('SELECT COUNT(*) FROM donations')->fetchColumn(),
    'raised'     => (float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM donations WHERE status = 'completed'")->fetchColumn(),
    'gallery'    => (int)$pdo->query('SELECT COUNT(*) FROM gallery')->fetchColumn(),
];

$recentMessages = $pdo->query(
    'SELECT id, name, email, subject, is_read, created_at
     FROM contact_messages ORDER BY created_at DESC LIMIT 5'
)->fetchAll();

$recentVolunteers = $pdo->query(
    'SELECT id, name, email, status, created_at
     FROM volunteers ORDER BY created_at DESC LIMIT 5'
)->fetchAll();

include __DIR__ . '/includes/admin-header.php';
?>

<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-label">Messages</span>
        <span class="stat-value"><?= $stats['messages'] ?></span>
        <span class="stat-sub"><?= $stats['unread'] ?> unread</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Volunteers</span>
        <span class="stat-value"><?= $stats['volunteers'] ?></span>
        <span class="stat-sub"><?= $stats['pending'] ?> pending</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Donations</span>
        <span class="stat-value"><?= $stats['donations'] ?></span>
        <span class="stat-sub">RWF <?= number_format($stats['raised'], 0) ?> raised</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Gallery Photos</span>
        <span class="stat-value"><?= $stats['gallery'] ?></span>
        <span class="stat-sub">Total uploaded</span>
    </div>
</div>

<section class="admin-panel">
    <h2>Recent Messages</h2>
    <?php if (!$recentMessages): ?>
        <p class="muted">No messages yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th></tr></thead>
            <tbody>
            <?php foreach ($recentMessages as $m): ?>
                <tr>
                    <td><?= e($m['name']) ?></td>
                    <td><?= e($m['email']) ?></td>
                    <td><?= e($m['subject'] ?: '—') ?></td>
                    <td><?= e(date('M j, Y', strtotime($m['created_at']))) ?></td>
                    <td>
                        <?php if ($m['is_read']): ?>
                            <span class="badge badge-ok">Read</span>
                        <?php else: ?>
                            <span class="badge badge-warn">Unread</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<section class="admin-panel">
    <h2>Recent Volunteers</h2>
    <?php if (!$recentVolunteers): ?>
        <p class="muted">No volunteers yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead><tr><th>Name</th><th>Email</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
            <?php foreach ($recentVolunteers as $v): ?>
                <tr>
                    <td><?= e($v['name']) ?></td>
                    <td><?= e($v['email']) ?></td>
                    <td>
                        <span class="badge badge-<?= $v['status'] === 'approved' ? 'ok' : ($v['status'] === 'rejected' ? 'err' : 'warn') ?>">
                            <?= e(ucfirst($v['status'])) ?>
                        </span>
                    </td>
                    <td><?= e(date('M j, Y', strtotime($v['created_at']))) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>