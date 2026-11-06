<?php
/**
 * webhooks/flutterwave.php
 * Flutterwave redirects donors back here after checkout.
 * Also receives server-to-server webhooks if configured.
 */
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/payment.php';

$status = $_GET['status'] ?? '';
$txRef  = $_GET['tx_ref'] ?? '';
$txId   = $_GET['transaction_id'] ?? '';

if ($status !== 'successful' || !$txRef || !$txId) {
    set_flash('error', 'Payment was not completed.');
    redirect(BASE_URL . 'donate.php');
}

// Verify with Flutterwave API
$ch = curl_init("https://api.flutterwave.com/v3/transactions/{$txId}/verify");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . FLW_SECRET_KEY],
]);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);

if (
    empty($data['data']) ||
    $data['data']['status'] !== 'successful' ||
    $data['data']['tx_ref'] !== $txRef
) {
    set_flash('error', 'Could not verify your payment. Please contact us.');
    redirect(BASE_URL . 'donate.php');
}

// Mark as completed
try {
    $pdo = db();
    $pdo->prepare(
        'UPDATE donations
         SET status = "completed",
             transaction_ref = ?,
             verified_at = NOW()
         WHERE reference = ? AND status = "pending"'
    )->execute([$txId, $txRef]);
    set_flash('success', 'Thank you! Your donation has been received and verified.');
} catch (Throwable $e) {
    set_flash('error', 'Payment received, but we could not record it. Please contact us.');
}

redirect(BASE_URL . 'donate.php');