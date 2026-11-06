<?php
/**
 * forms/contact-handler.php
 * Processes the contact form.
 * Saves to DB if available; otherwise emails the admin.
 */
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . 'contact.php');
}

// CSRF
if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    set_flash('error', 'Invalid session token. Please try again.');
    redirect(BASE_URL . 'contact.php');
}

$name    = post('name');
$email   = post('email');
$subject = post('subject');
$message = post('message');

$errors = [];
if ($name === '')                        $errors[] = 'Name is required.';
if (!valid_email($email))                $errors[] = 'A valid email is required.';
if ($message === '')                     $errors[] = 'Message is required.';

if ($errors) {
    set_flash('error', implode(' ', $errors));
    redirect(BASE_URL . 'contact.php');
}

// Try to save into DB (if created)
$saved = false;
try {
    require_once __DIR__ . '/../config/database.php';
    $stmt = db()->prepare(
        'INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$name, $email, $subject, $message]);
    $saved = true;
} catch (Throwable $e) {
    // ignore — no DB yet
}

// Fallback: send an email
if (!$saved) {
    $to      = SITE_EMAIL;
    $headers = "From: {$email}\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";
    $body    = "New contact form message\n\nName: $name\nEmail: $email\nSubject: $subject\n\n$message";
    @mail($to, 'Contact Form: ' . ($subject ?: 'New message'), $body, $headers);
}

set_flash('success', 'Thank you! Your message has been received.');
redirect(BASE_URL . 'contact.php');