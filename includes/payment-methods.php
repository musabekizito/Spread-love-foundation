<?php
/**
 * includes/payment-methods.php
 * Renders the payment method cards on donate.php.
 * Requires config/payment.php to be loaded already.
 */
?>
<div class="payment-grid">

    <?php if (PAY_ENABLE_MOMO): ?>
    <div class="payment-card">
        <div class="payment-card-head">
            <span class="payment-logo momo">MoMo</span>
            <h3>MTN Mobile Money</h3>
        </div>
        <p>Send money to:</p>
        <dl class="payment-details">
            <dt>Phone</dt><dd><?= e(PAY_MOMO_NUMBER) ?></dd>
            <dt>Name</dt><dd><?= e(PAY_MOMO_NAME) ?></dd>
        </dl>
        <ol class="payment-steps">
            <li>Dial <strong>*182*1*1#</strong> on your phone.</li>
            <li>Choose <em>Send Money</em>.</li>
            <li>Enter <strong><?= e(PAY_MOMO_NUMBER) ?></strong>.</li>
            <li>Enter the amount and confirm.</li>
            <li>Copy the SMS confirmation code.</li>
            <li>Fill the form below with the code so we can verify your gift.</li>
        </ol>
        <button type="button" class="btn btn-primary payment-choose" data-method="momo" data-method-label="MTN Mobile Money" aria-pressed="false">
            I paid with MoMo
        </button>
    </div>
    <?php endif; ?>

    <?php if (PAY_ENABLE_AIRTEL): ?>
    <div class="payment-card">
        <div class="payment-card-head">
            <span class="payment-logo airtel">Airtel</span>
            <h3>Airtel Money</h3>
        </div>
        <p>Send money to:</p>
        <dl class="payment-details">
            <dt>Phone</dt><dd><?= e(PAY_AIRTEL_NUMBER) ?></dd>
            <dt>Name</dt><dd><?= e(PAY_AIRTEL_NAME) ?></dd>
        </dl>
        <ol class="payment-steps">
            <li>Dial <strong>*182#</strong> on your Airtel line.</li>
            <li>Choose <em>Send Money</em>.</li>
            <li>Enter <strong><?= e(PAY_AIRTEL_NUMBER) ?></strong>.</li>
            <li>Enter the amount and confirm.</li>
            <li>Save the SMS confirmation code.</li>
            <li>Fill the form below with the code.</li>
        </ol>
        <button type="button" class="btn btn-primary payment-choose" data-method="airtel" data-method-label="Airtel Money" aria-pressed="false">
            I paid with Airtel
        </button>
    </div>
    <?php endif; ?>

    <?php if (PAY_ENABLE_BANK): ?>
    <div class="payment-card">
        <div class="payment-card-head">
            <span class="payment-logo bank">Bank</span>
            <h3>Bank Transfer</h3>
        </div>
        <dl class="payment-details">
            <dt>Bank</dt><dd><?= e(PAY_BANK_NAME) ?></dd>
            <dt>Account</dt><dd><?= e(PAY_BANK_ACCOUNT) ?></dd>
            <dt>Holder</dt><dd><?= e(PAY_BANK_HOLDER) ?></dd>
            <dt>SWIFT</dt><dd><?= e(PAY_BANK_SWIFT) ?></dd>
        </dl>
        <ol class="payment-steps">
            <li>Transfer using the details above.</li>
            <li>Reference: put <strong>DONATION</strong> plus your name.</li>
            <li>Keep the bank slip or transaction number.</li>
            <li>Fill the form below with the reference.</li>
        </ol>
        <button type="button" class="btn btn-primary payment-choose" data-method="bank" data-method-label="Bank Transfer" aria-pressed="false">
            I paid by bank
        </button>
    </div>
    <?php endif; ?>

    <?php if (PAY_ENABLE_ONLINE): ?>
    <div class="payment-card">
        <div class="payment-card-head">
            <span class="payment-logo online">Online</span>
            <h3>Pay Online (Card / MoMo)</h3>
        </div>
        <p>Secure checkout via Flutterwave. Pay with Visa, Mastercard, MTN MoMo, or Airtel Money.</p>
        <form method="POST" action="<?= e(BASE_URL) ?>forms/donation-handler.php" class="inline-donate">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="mode" value="online">
            <label>Amount (RWF)
                <input type="number" name="amount" min="100" step="100" value="5000" required>
            </label>
            <label>Email
                <input type="email" name="email" required>
            </label>
            <button type="submit" class="btn btn-primary">Donate Online</button>
        </form>
    </div>
    <?php endif; ?>

</div>