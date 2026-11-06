<?php
/**
 * admin/index.php — Admin login
 */
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

// Already logged in? Go to dashboard
if (!empty($_SESSION['admin_id'])) {
    redirect(BASE_URL . 'admin/dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid session. Please try again.';
    } else {
        $identifier = trim($_POST['identifier'] ?? '');
        $pass  = $_POST['password'] ?? '';

        if ($identifier === '' || $pass === '') {
            $error = 'Please enter your username or email and password.';
        } else {
            try {
                if (valid_email($identifier)) {
                    $stmt = db()->prepare('SELECT * FROM admins WHERE email = ? LIMIT 1');
                } elseif (preg_match('/\A[a-zA-Z0-9._-]{3,32}\z/', $identifier)) {
                    $stmt = db()->prepare('SELECT * FROM admins WHERE name = ? LIMIT 1');
                } else {
                    $stmt = null;
                }

                if ($stmt === null) {
                    $admin = false;
                } else {
                    $stmt->execute([$identifier]);
                    $admin = $stmt->fetch();
                }

                if ($admin && password_verify($pass, $admin['password_hash'])) {
                    $_SESSION['admin_id']    = (int)$admin['id'];
                    $_SESSION['admin_name']  = $admin['name'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_role']  = $admin['role'];
                    session_regenerate_id(true);
                    redirect(BASE_URL . 'admin/dashboard.php');
                }
                $error = 'Invalid username/email or password.';
            } catch (Throwable $e) {
                $error = 'Database error. Please try again later.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | <?= e(SITE_NAME) ?></title>
    <link rel="stylesheet" href="<?= e(ASSETS_URL) ?>css/admin.css">
</head>
<body class="admin-login-body">
<main class="admin-login-card">
    <h1><?= e(SITE_NAME) ?></h1>
    <p class="admin-login-sub">Admin Panel</p>

    <?php if ($error): ?>
        <p class="err"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label>Username or email
            <input type="text" name="identifier" required autofocus autocomplete="username">
        </label>
        <label>Password
            <input type="password" name="password" required autocomplete="current-password">
        </label>
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>

    <p class="admin-login-footer"><a href="<?= e(BASE_URL) ?>index.php">&larr; Back to website</a></p>
</main>
</body>
</html>