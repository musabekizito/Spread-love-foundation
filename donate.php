<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/payment.php';

$pageTitle       = 'Donate';
$pageDescription = 'Support Spread Love Foundation with a donation via MTN MoMo, Airtel Money, bank transfer, or online card.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Support Our Mission</h1>
        <p>Your gift provides meals, art materials, and education for children in Gashora.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <p class="highlight-text">
            Your donation may help provide a meal, purchase art materials, supply school
            necessities, or make educational holiday activities possible.
        </p>

        <h2>Choose Your Donation Method</h2>
        <p>All methods go to the same account of <strong><?= e(SITE_NAME) ?></strong>.</p>

        <?php include __DIR__ . '/includes/payment-methods.php'; ?>
    </div>
</section>

<!-- Declaration form -->
<section class="section section-alt" id="declare">
    <div class="container form-container">
        <h2>Confirm Your Donation</h2>
        <p>After sending money, please fill this form so we can verify your gift and thank you properly.</p>

        <form action="<?= e(BASE_URL) ?>forms/donation-handler.php" method="POST" class="form" id="donationForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="mode" value="manual">
            <input type="hidden" id="d_payment_method" name="payment_method" value="">

            <p class="selected-payment" id="selected-payment" role="status" aria-live="polite" tabindex="-1">
                Choose a payment method above before confirming your donation.
            </p>

            <div class="form-group">
                <label for="d_payer_name">Your Name</label>
                <input type="text" id="d_payer_name" name="payer_name" maxlength="100" placeholder="(Optional if you wish to stay anonymous)">
            </div>

            <div class="form-group">
                <label for="d_email">Email *</label>
                <input type="email" id="d_email" name="email" required maxlength="150">
            </div>

            <div class="form-group">
                <label for="d_phone">Phone (the line used to send money)</label>
                <input type="tel" id="d_phone" name="payer_phone" maxlength="30" placeholder="e.g. +250 788 123 456">
            </div>

            <div class="form-group">
                <label for="d_amount">Amount Sent (RWF) *</label>
                <input type="number" id="d_amount" name="amount" min="100" step="100" required>
            </div>

            <div class="form-group">
                <label for="d_ref">Transaction / Confirmation Code *</label>
                <input type="text" id="d_ref" name="transaction_ref" required maxlength="100"
                       placeholder="SMS code or bank reference">
            </div>

            <div class="form-group">
                <label for="d_message">Message (optional)</label>
                <textarea id="d_message" name="message" rows="3"
                          placeholder="A note of encouragement, or what you'd like us to prioritize"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Confirmation</button>
        </form>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>