<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Settings';
$pdo = db();

// Ensure table exists
$pdo->exec("CREATE TABLE IF NOT EXISTS settings (
    `key` VARCHAR(100) PRIMARY KEY,
    `value` TEXT
)");

$defaults = [
    'site_email'   => SITE_EMAIL,
    'site_phone'   => SITE_PHONE,
    'site_address' => SITE_LOCATION,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (csrf_verify($_POST['csrf_token'] ?? null)) {
        $stmt = $pdo->prepare(
            'INSERT INTO settings (`key`,`value`) VALUES (?,?)
             ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)'
        );
        foreach ($defaults as $key => $_) {
            $val = trim($_POST[$key] ?? '');
            $stmt->execute([$key, $val]);
        }
        set_flash('success', 'Settings saved.');
    }
    redirect(BASE_URL . 'admin/settings/general.php');
}

$current = [];
$rows = $pdo->query('SELECT `key`, `value` FROM settings')->fetchAll();
foreach ($rows as $r) $current[$r['key']] = $r['value'];
$current = array_merge($defaults, $current);

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <h2>General Settings</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <label>Contact Email
            <input type="email" name="site_email" value="<?= e($current['site_email']) ?>">
        </label>

        <label>Phone
            <input type="text" name="site_phone" value="<?= e($current['site_phone']) ?>">
        </label>

        <label>Address
            <input type="text" name="site_address" value="<?= e($current['site_address']) ?>">
        </label>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>