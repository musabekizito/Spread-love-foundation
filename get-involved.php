<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Get Involved';
$pageDescription = 'Donate, volunteer, or partner with Spread Love Foundation to support children in Gashora, Rwanda.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Get Involved</h1>
        <p>Behind every child is a future that deserves a chance.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="center">Why Your Support Matters</h2>
        <p>Some children have dreams but lack the materials to explore their talents. Some are eager to learn but struggle with hunger and financial hardship. Others need encouragement, guidance, and a safe environment in which to discover their strengths.</p>
        <p>Your donation may help provide a meal, purchase art materials, supply school necessities, or make educational holiday activities possible. Your time and skills can help children learn, communicate, create, and grow. Your partnership can help a family feel supported and help a child understand that their circumstances today do not have to define their future.</p>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <h2 class="center">Ways to Help</h2>
        <div class="cards three">
            <div class="card">
                <h3>Donate</h3>
                <p>Support food, nutrition, art materials, and school necessities. Every contribution makes a difference.</p>
                <a href="#donate" class="btn btn-secondary">How to Donate</a>
            </div>
            <div class="card">
                <h3>Volunteer</h3>
                <p>Share your time and skills — art, teaching, communication, or hands-on help during holiday activities.</p>
                <a href="#volunteer-form" class="btn btn-secondary">Volunteer</a>
            </div>
            <div class="card">
                <h3>Partner With Us</h3>
                <p>Businesses, schools, and organizations can partner to expand opportunities for children.</p>
                <a href="#volunteer-form" class="btn btn-secondary">Partner</a>
            </div>
        </div>
    </div>
</section>

<section class="section" id="donate">
    <div class="container">
        <div class="donation-panel">
            <div class="donation-copy">
                <p class="donation-eyebrow">Make a difference</p>
                <h2>Make a donation pledge</h2>
                <p>Your pledge can help provide nutritious meals, school necessities, and creative learning materials for children in Gashora.</p>
                <p class="donation-note" id="donation-payment-note">This form records your pledge only; it does not collect payment details or charge you. We will follow up to arrange the donation.</p>
            </div>
            <form action="<?= e(BASE_URL) ?>forms/donation-handler.php" method="POST" class="form donation-form" id="donationForm">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

                <div class="form-group">
                    <label for="d_name">Full Name *</label>
                    <input type="text" id="d_name" name="donor_name" required maxlength="100" autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="d_email">Email *</label>
                    <input type="email" id="d_email" name="email" required maxlength="150" autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="d_amount">Pledge Amount *</label>
                    <input type="number" id="d_amount" name="amount" required min="0.01" max="99999999.99" step="0.01" inputmode="decimal">
                </div>

                <div class="form-group">
                    <label for="d_currency">Currency *</label>
                    <select id="d_currency" name="currency" required>
                        <option value="RWF">RWF</option>
                        <option value="USD">USD</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit Pledge</button>
            </form>
        </div>
    </div>
</section>

<section class="section" id="volunteer-form">
    <div class="container form-container">
        <h2>Volunteer / Partner Form</h2>
        <p>Tell us how you would like to help. We will get back to you soon.</p>

        <form action="<?= e(BASE_URL) ?>forms/volunteer-handler.php" method="POST" class="form" id="volunteerForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

            <div class="form-group">
                <label for="v_name">Full Name *</label>
                <input type="text" id="v_name" name="name" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="v_email">Email *</label>
                <input type="email" id="v_email" name="email" required maxlength="150">
            </div>

            <div class="form-group">
                <label for="v_phone">Phone</label>
                <input type="tel" id="v_phone" name="phone" maxlength="30">
            </div>

            <div class="form-group">
                <label for="v_skills">Skills / How you can help</label>
                <input type="text" id="v_skills" name="skills" maxlength="255" placeholder="e.g. Art teaching, translation, fundraising">
            </div>

            <div class="form-group">
                <label for="v_availability">Availability</label>
                <input type="text" id="v_availability" name="availability" maxlength="100" placeholder="e.g. Weekends, school holidays">
            </div>

            <div class="form-group">
                <label for="v_message">Message</label>
                <textarea id="v_message" name="message" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>