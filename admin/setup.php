<?php
/**
 * admin/setup.php
 * Run ONCE to create the initial super admin account.
 * DELETE or rename this file after use.
 */
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$done = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid session. Please try again.';
    } elseif (!preg_match('/\A[a-zA-Z0-9._-]{3,32}\z/', $username)
        || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || strlen($pass) < 12) {
        $error = 'Provide a username (3-32 letters, numbers, dots, underscores, or hyphens), a valid email, and a password of at least 12 characters.';
    } else {
        try {
            $pdo = db();
            $exists = $pdo->query('SELECT COUNT(*) FROM admins')->fetchColumn();
            if ((int)$exists > 0) {
                $error = 'An admin already exists. Delete this file.';
            } else {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare(
                    'INSERT INTO admins (name, email, password_hash, role) VALUES (?, ?, ?, "super_admin")'
                );
                $stmt->execute([$username, $email, $hash]);
                $done = true;
            }
        } catch (Throwable $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Setup</title>
    <link rel="stylesheet" href="<?= '../assets/css/admin.css' ?>">
</head>
<body class="admin-login-body">
<main class="admin-login-card">
    <h1>Admin Setup</h1>
    <?php if ($done): ?>
        <p class="ok">Admin created successfully. Delete <code>admin/setup.php</code> and <a href="index.php">log in</a>.</p>
    <?php else: ?>
        <?php if ($error): ?><p class="err"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="POST" class="admin-form">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>Username<input type="text" name="username" required minlength="3" maxlength="32" pattern="[A-Za-z0-9._-]+" autocomplete="username"></label>
            <label>Email<input type="email" name="email" required></label>
            <label>Password (min 12 characters; don't use "admin")<input type="password" name="password" required minlength="12" autocomplete="new-password"></label>
            <button type="submit" class="btn btn-primary">Create Admin</button>
        </form>
    <?php endif; ?>
</main>
</body>
</html>