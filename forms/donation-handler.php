<?php
/**
 * forms/donation-handler.php
 * Handles manual donation confirmations AND online checkout redirects.
 */
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/payment.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . 'donate.php');
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    set_flash('error', 'Invalid session. Please try again.');
    redirect(BASE_URL . 'donate.php');
}

$mode = $_POST['mode'] ?? 'manual';

/* =====================================================
   ONLINE MODE → redirect to Flutterwave
   ===================================================== */
if ($mode === 'online' && PAY_ENABLE_ONLINE) {
    $amount = (float)($_POST['amount'] ?? 0);
    $email  = trim($_POST['email'] ?? '');

    if ($amount < 100 || !valid_email($email)) {
        set_flash('error', 'Provide a valid email and amount (min 100 RWF).');
        redirect(BASE_URL . 'donate.php');
    }

    $txRef = 'SLF-' . date('YmdHis') . '-' . bin2hex(random_bytes(3));

    $payload = [
        'tx_ref'       => $txRef,
        'amount'       => $amount,
        'currency'     => FLW_CURRENCY,
        'redirect_url' => FLW_CALLBACK_URL,
        'customer'     => ['email' => $email],
        'customizations' => [
            'title'       => 'Donate to ' . SITE_NAME,
            'description' => 'Supporting vulnerable children in Gashora',
        ],
    ];

    $ch = curl_init('https://api.flutterwave.com/v3/payments');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . FLW_SECRET_KEY,
            'Content-Type: application/json',
        ],
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        set_flash('error', 'Payment gateway error. Please try again or use MoMo.');
        redirect(BASE_URL . 'donate.php');
    }

    $data = json_decode($response, true);
    if (empty($data['data']['link'])) {
        set_flash('error', 'Could not start online payment. Please use MoMo instead.');
        redirect(BASE_URL . 'donate.php');
    }

    // Pre-record as pending
    $pdo = db();
    $pdo->prepare(
        'INSERT INTO donations (donor_name, email, amount, currency, payment_method, reference, status)
         VALUES (?, ?, ?, ?, ?, ?, "pending")'
    )->execute([null, $email, $amount, FLW_CURRENCY, 'flutterwave', $txRef]);

    header('Location: ' . $data['data']['link']);
    exit;
}

/* =====================================================
   MANUAL MODE → save, verify, notify admin
   ===================================================== */
$payment_method = isset($_POST['payment_method']) && is_string($_POST['payment_method'])
    ? trim($_POST['payment_method'])
    : '';
$payer_name     = trim($_POST['payer_name'] ?? '');
$email          = trim($_POST['email'] ?? '');
$payer_phone    = trim($_POST['payer_phone'] ?? '');
$amount         = (float)($_POST['amount'] ?? 0);
$transaction_ref = trim($_POST['transaction_ref'] ?? '');
$message        = trim($_POST['message'] ?? '');

$allowed = [];
if (PAY_ENABLE_MOMO) $allowed[] = 'momo';
if (PAY_ENABLE_AIRTEL) $allowed[] = 'airtel';
if (PAY_ENABLE_BANK) $allowed[] = 'bank';
$errors  = [];

if (!in_array($payment_method, $allowed, true)) $errors[] = 'Please choose a payment method.';
if ($amount < 100)                              $errors[] = 'Amount must be at least 100 RWF.';
if (!valid_email($email))                       $errors[] = 'A valid email is required.';
if ($transaction_ref === '')                    $errors[] = 'Please enter the transaction / confirmation code.';

if ($errors) {
    set_flash('error', implode(' ', $errors));
    redirect(BASE_URL . 'donate.php#declare');
}

try {
    $pdo = db();

    // Duplicate reference guard
    $check = $pdo->prepare('SELECT id FROM donations WHERE transaction_ref = ? LIMIT 1');
    $check->execute([$transaction_ref]);
    if ($check->fetch()) {
        set_flash('error', 'This transaction code has already been submitted. Thank you!');
        redirect(BASE_URL . 'donate.php#declare');
    }

    $stmt = $pdo->prepare(
        'INSERT INTO donations
            (donor_name, email, amount, currency, payment_method, payer_phone,
             transaction_ref, message, status)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, "pending")'
    );
    $stmt->execute([
        $payer_name !== '' ? $payer_name : null,
        $email, $amount, 'RWF', $payment_method,
        $payer_phone !== '' ? $payer_phone : null,
        $transaction_ref, $message !== '' ? $message : null,
    ]);

    // Notify admin (best-effort)
    $to      = SITE_EMAIL;
    $headers = "From: {$email}\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";
    $body    = "A new donation was declared.\n\n"
             . "Method: "        . strtoupper($payment_method) . "\n"
             . "Amount: "        . $amount . " RWF\n"
             . "Donor: "         . ($payer_name ?: 'Anonymous') . "\n"
             . "Email: "         . $email . "\n"
             . "Phone: "         . ($payer_phone ?: '—') . "\n"
             . "Txn Reference: " . $transaction_ref . "\n"
             . "Message: "       . ($message ?: '—') . "\n\n"
             . "Verify in the admin panel:\n" . BASE_URL . "admin/donations/list.php\n";
    @mail($to, 'New Donation Declared (' . $amount . ' RWF)', $body, $headers);

    set_flash('success', 'Thank you! Your donation has been submitted for verification. We will confirm shortly.');
} catch (Throwable $e) {
    set_flash('error', 'Could not save your donation. Please contact us directly.');
}

redirect(BASE_URL . 'donate.php');