<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Upload Photo';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid session token.';
    } elseif (empty($_FILES['image']['tmp_name'])) {
        $error = 'Please select an image.';
    } else {
        $file = $_FILES['image'];
        $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $mime = mime_content_type($file['tmp_name']);

        if (!isset($allowed[$mime])) {
            $error = 'Only JPG, PNG, or WEBP files allowed.';
        } elseif ($file['size'] > 5 * 1024 * 1024) {
            $error = 'Max file size is 5 MB.';
        } else {
            $dir = SLF_ROOT . '/uploads/gallery/';
            if (!is_dir($dir)) mkdir($dir, 0775, true);

            $ext  = $allowed[$mime];
            $name = bin2hex(random_bytes(8)) . '.' . $ext;
            $dest = $dir . $name;

            if (move_uploaded_file($file['tmp_name'], $dest)) {
                $title   = trim($_POST['title'] ?? '');
                $caption = trim($_POST['caption'] ?? '');
                $order   = (int)($_POST['sort_order'] ?? 0);

                $stmt = db()->prepare(
                    'INSERT INTO gallery (title, image, caption, sort_order) VALUES (?, ?, ?, ?)'
                );
                $stmt->execute([$title, $name, $caption, $order]);
                set_flash('success', 'Photo uploaded.');
                redirect(BASE_URL . 'admin/gallery/list.php');
            } else {
                $error = 'Could not save file.';
            }
        }
    }
}

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <p><a href="list.php" class="btn btn-sm">&larr; Back</a></p>
    <?php if ($error): ?><p class="err"><?= e($error) ?></p><?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label>Image File (JPG / PNG / WEBP, max 5MB) *
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required>
        </label>
        <label>Title
            <input type="text" name="title" maxlength="150">
        </label>
        <label>Caption
            <textarea name="caption" rows="3"></textarea>
        </label>
        <label>Sort Order
            <input type="number" name="sort_order" value="0">
        </label>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>