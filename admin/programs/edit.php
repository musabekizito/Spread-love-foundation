<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Edit Program';
$pdo = db();

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM programs WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$program = $stmt->fetch();

if (!$program) {
    set_flash('error', 'Program not found.');
    redirect(BASE_URL . 'admin/programs/list.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid session.';
    } else {
        $title    = trim($_POST['title'] ?? '');
        $short    = trim($_POST['short_desc'] ?? '');
        $content  = trim($_POST['full_content'] ?? '');
        $image    = trim($_POST['image'] ?? '');

        if ($title === '') {
            $error = 'Title is required.';
        } else {
            $pdo->prepare(
                'UPDATE programs SET title = ?, short_desc = ?, full_content = ?, image = ? WHERE id = ?'
            )->execute([$title, $short, $content, $image, $id]);
            set_flash('success', 'Program updated.');
            redirect(BASE_URL . 'admin/programs/list.php');
        }
    }
}

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <p><a href="list.php" class="btn btn-sm">&larr; Back</a></p>

    <?php if ($error): ?><p class="err"><?= e($error) ?></p><?php endif; ?>

    <form method="POST" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <label>Title *
            <input type="text" name="title" value="<?= e($program['title']) ?>" required maxlength="150">
        </label>

        <label>Short Description
            <textarea name="short_desc" rows="3"><?= e($program['short_desc']) ?></textarea>
        </label>

        <label>Full Content
            <textarea name="full_content" rows="10"><?= e($program['full_content']) ?></textarea>
        </label>

        <label>Image filename (in assets/images/)
            <input type="text" name="image" value="<?= e($program['image']) ?>" maxlength="255">
        </label>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>