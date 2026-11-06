<?php
/**
 * config/payment.php
 * All payment details in ONE place. Edit here to change phone numbers,
 * bank account, or enable/disable methods.
 */

// ---------- Organization payment details ----------
define('PAY_MOMO_NUMBER',   '+250 789 386 400');   // MTN MoMo number
define('PAY_MOMO_NAME',     'SPREAD LOVE FOUNDATION');
define('PAY_AIRTEL_NUMBER', '+250 721 750 074');   // Airtel Money number
define('PAY_AIRTEL_NAME',   'SPREAD LOVE FOUNDATION');

define('PAY_BANK_NAME',     'Bank of Kigali');
define('PAY_BANK_ACCOUNT',  '000000000000');
define('PAY_BANK_SWIFT',    'BKIGRWRW');
define('PAY_BANK_HOLDER',   'SPREAD LOVE FOUNDATION');

// ---------- Enable / disable methods ----------
define('PAY_ENABLE_MOMO',    true);
define('PAY_ENABLE_AIRTEL',  true);
define('PAY_ENABLE_BANK',    true);
define('PAY_ENABLE_ONLINE',  false);   // set true after adding Flutterwave keys

// ---------- Flutterwave (optional online checkout) ----------
define('FLW_PUBLIC_KEY',     'FLWPUBK_TEST-xxxxxxxxxxxxxxxxxxxx-X');
define('FLW_SECRET_KEY',     'FLWSECK_TEST-xxxxxxxxxxxxxxxxxxxx-X');
define('FLW_CURRENCY',       'RWF');
define('FLW_CALLBACK_URL',   BASE_URL . 'webhooks/flutterwave.php');
