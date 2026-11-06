<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../../config/database.php';

$adminPageTitle = 'Record Donation';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Invalid session token.';
    } else {
        $donor    = trim($_POST['donor_name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $amount   = (float)($_POST['amount'] ?? 0);
        $currency = trim($_POST['currency'] ?? 'RWF');
        $method   = trim($_POST['method'] ?? '');
        $ref      = trim($_POST['reference'] ?? '');
        $status   = $_POST['status'] ?? 'completed';

        if ($amount <= 0) {
            $error = 'Amount must be greater than zero.';
        } elseif ($email !== '' && !valid_email($email)) {
            $error = 'Invalid email address.';
        } else {
            $stmt = db()->prepare(
                'INSERT INTO donations (donor_name, email, amount, currency, method, reference, status)
                 VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$donor, $email, $amount, $currency, $method, $ref, $status]);
            set_flash('success', 'Donation recorded.');
            redirect(BASE_URL . 'admin/donations/list.php');
        }
    }
}

include __DIR__ . '/../includes/admin-header.php';
?>

<section class="admin-panel">
    <p><a href="list.php" class="btn btn-sm">&larr; Back</a></p>

    <?php if ($error): ?><p class="err"><?= e($error) ?></p><?php endif; ?>

    <form method="POST" class="admin-form two-col-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <label>Donor Name
            <input type="text" name="donor_name" maxlength="100">
        </label>
        <label>Email
            <input type="email" name="email" maxlength="150">
        </label>
        <label>Amount *
            <input type="number" name="amount" step="0.01" min="0.01" required>
        </label>
        <label>Currency
            <input type="text" name="currency" value="RWF" maxlength="10">
        </label>
        <label>Method
            <input type="text" name="method" placeholder="Cash, Bank transfer, MoMo…" maxlength="50">
        </label>
        <label>Reference
            <input type="text" name="reference" maxlength="100">
        </label>
        <label>Status
            <select name="status">
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Donation</button>
        </div>
    </form>
</section>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>