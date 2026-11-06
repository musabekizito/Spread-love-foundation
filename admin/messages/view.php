<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'View Message';
$pdo = db();

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM contact_messages WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$message = $stmt->fetch();

if (!$message) {
    set_flash('error', 'Message not found.');
    redirect(BASE_URL . 'admin/messages/list.php');
}

// Auto mark read
if (!$message['is_read']) {
    $pdo->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = ?')->execute([$id]);
    $message['is_read'] = 1;
}

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <p><a href="list.php" class="btn btn-sm">&larr; Back to Messages</a></p>

    <div class="detail-grid">
        <div><strong>Name:</strong> <?= e($message['name']) ?></div>
        <div><strong>Email:</strong> <a href="mailto:<?= e($message['email']) ?>"><?= e($message['email']) ?></a></div>
        <div><strong>Subject:</strong> <?= e($message['subject'] ?: '—') ?></div>
        <div><strong>Received:</strong> <?= e(date('M j, Y H:i', strtotime($message['created_at']))) ?></div>
    </div>

    <div class="message-body">
        <?= nl2br(e($message['message'])) ?>
    </div>

    <p>
        <a class="btn btn-primary"
           href="mailto:<?= e($message['email']) ?>?subject=Re: <?= rawurlencode($message['subject'] ?: 'Your message') ?>">
           Reply by Email
        </a>
        <a class="btn btn-danger"
           href="delete.php?id=<?= (int)$message['id'] ?>&token=<?= e(csrf_token()) ?>"
           onclick="return confirm('Delete this message?');">Delete</a>
    </p>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>