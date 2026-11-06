<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Our Programs';
$pageDescription = 'Discover the Daily Care Program and the ABANA Program of Spread Love Foundation.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Our Two Main Programs</h1>
        <p>Addressing different aspects of the same challenge.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="program-grid">
            <article class="program-card">
                <img src="<?= e(IMAGES_URL) ?>6.jpeg" alt="Daily Care Program">
                <div class="program-body">
                    <h3>Daily Care Program</h3>
                    <p class="program-sub">Meeting Children's Basic Needs and Strengthening Families</p>
                    <p>Supports vulnerable children and families facing difficulties meeting basic needs — food, education, and everyday care.</p>
                    <a href="<?= e(BASE_URL) ?>program-daily-care.php" class="btn btn-secondary">Explore Daily Care</a>
                </div>
            </article>

            <article class="program-card">
                <img src="<?= e(IMAGES_URL) ?>37.jpeg" alt="ABANA Program">
                <div class="program-body">
                    <h3>ABANA Program</h3>
                    <p class="program-sub">Discovering Talents. Building Confidence. Preparing Children for the Future.</p>
                    <p>Uses art, creative learning, communication, and personal care to help children grow in confidence and discover their potential.</p>
                    <a href="<?= e(BASE_URL) ?>program-abana.php" class="btn btn-secondary">Explore ABANA</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <h2 class="center">How the Two Programs Work Together</h2>
        <div class="cards two">
            <div class="card">
                <h3>Daily Care supports the child</h3>
                <p>Food, basic needs, educational assistance, and family support.</p>
            </div>
            <div class="card">
                <h3>ABANA develops the child</h3>
                <p>Art, communication, hygiene, discipline, creativity, and life skills.</p>
            </div>
        </div>
        <p class="center highlight-text">We do not want to help children only survive difficult circumstances. We want to help them discover what they can become.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="center">Our Combined Objectives</h2>
        <ul class="check-list two-col-list">
            <li>Improve access to nutritious food for vulnerable children.</li>
            <li>Encourage school attendance and continued participation in education.</li>
            <li>Provide children with opportunities to discover and develop their creative talents.</li>
            <li>Strengthen communication, confidence, discipline, and teamwork.</li>
            <li>Promote personal hygiene, self-care, and healthy daily habits.</li>
            <li>Support families facing financial hardship.</li>
            <li>Create positive and educational experiences during school holidays.</li>
            <li>Help children avoid spending their holidays in unsafe or unproductive activities.</li>
            <li>Build partnerships that expand opportunities for children and their communities.</li>
        </ul>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>