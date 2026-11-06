<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Contact Us';
$pageDescription = 'Get in touch with Spread Love Foundation in Gashora, Bugesera District, Rwanda.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We would love to hear from you.</p>
    </div>
</section>

<section class="section">
    <div class="container two-col">
        <div>
            <h2>Reach Out</h2>
            <ul class="contact-list">
                <li><strong>Location:</strong> <?= e(SITE_LOCATION) ?></li>
                <li><strong>Email:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                <li><strong>Phone:</strong> <?= e(SITE_PHONE) ?></li>
            </ul>

            <h2>Send a Message</h2>
            <form action="<?= e(BASE_URL) ?>forms/contact-handler.php" method="POST" class="form" id="contactForm" novalidate>
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

                <div class="form-group">
                    <label for="c_name">Name *</label>
                    <input type="text" id="c_name" name="name" required maxlength="100">
                </div>

                <div class="form-group">
                    <label for="c_email">Email *</label>
                    <input type="email" id="c_email" name="email" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="c_subject">Subject</label>
                    <input type="text" id="c_subject" name="subject" maxlength="200">
                </div>

                <div class="form-group">
                    <label for="c_message">Message *</label>
                    <textarea id="c_message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
        <div>
            <img src="<?= e(IMAGES_URL) ?>973792.jpg" alt="Building hope with children" class="img-rounded">
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>