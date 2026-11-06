<?php
/**
 * forms/volunteer-handler.php
 */
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . 'get-involved.php');
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    set_flash('error', 'Invalid session token. Please try again.');
    redirect(BASE_URL . 'get-involved.php#volunteer-form');
}

$name         = post('name');
$email        = post('email');
$phone        = post('phone');
$skills       = post('skills');
$availability = post('availability');
$message      = post('message');

$errors = [];
if ($name === '')            $errors[] = 'Name is required.';
if (!valid_email($email))    $errors[] = 'A valid email is required.';

if ($errors) {
    set_flash('error', implode(' ', $errors));
    redirect(BASE_URL . 'get-involved.php#volunteer-form');
}

$saved = false;
try {
    require_once __DIR__ . '/../config/database.php';
    $stmt = db()->prepare(
        'INSERT INTO volunteers (name, email, phone, skills, availability, message)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$name, $email, $phone, $skills, $availability, $message]);
    $saved = true;
} catch (Throwable $e) {
    // ignore — no DB yet
}

if (!$saved) {
    $to      = SITE_EMAIL;
    $headers = "From: {$email}\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";
    $body    = "New volunteer submission\n\nName: $name\nEmail: $email\nPhone: $phone\nSkills: $skills\nAvailability: $availability\n\n$message";
    @mail($to, 'Volunteer Form Submission', $body, $headers);
}

set_flash('success', 'Thank you for volunteering! We will contact you soon.');
redirect(BASE_URL . 'get-involved.php#volunteer-form');