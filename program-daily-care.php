<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Daily Care Program';
$pageDescription = 'The Daily Care Program of Spread Love Foundation helps vulnerable children and families with food, nutrition, education assistance, and community support.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Daily Care Program</h1>
        <p>Meeting Children's Basic Needs and Strengthening Families</p>
    </div>
</section>

<section class="section">
    <div class="container two-col">
        <div>
            <h2>About the Program</h2>
            <p>The Daily Care Program focuses on supporting vulnerable children and families who face difficulties meeting basic needs, particularly food, education, and everyday care.</p>
            <p>In Gashora, some families experience financial hardship that makes it difficult to provide sufficient nutritious food, school materials, uniforms, school fees, and other necessities. These challenges can affect children's concentration, school attendance, confidence, and overall development.</p>
            <p class="highlight-text">No child should have to choose between learning and finding something to eat.</p>
            <p>Through the Daily Care Program, we work with village schools, families, local leaders, volunteers, and partners to identify children in need and provide practical support according to available resources.</p>
        </div>
        <div>
            <img src="<?= e(IMAGES_URL) ?>Daily_Care_Program.jpg" alt="Daily Care Program" class="img-rounded">
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <h2 class="center">What the Program Provides</h2>
        <div class="cards three">
            <div class="card">
                <h3>Food &amp; Nutrition Support</h3>
                <p>Help vulnerable children access nutritious meals, particularly children experiencing food insecurity.</p>
            </div>
            <div class="card">
                <h3>Education Assistance</h3>
                <p>Help connect children with school materials, uniforms, and other educational support where resources allow.</p>
            </div>
            <div class="card">
                <h3>Family Support</h3>
                <p>Work with parents and caregivers to understand their challenges and connect them with appropriate community resources.</p>
            </div>
            <div class="card">
                <h3>Community Solidarity</h3>
                <p>Encourage individuals, local businesses, and organizations to contribute food, materials, funds, or volunteer time.</p>
            </div>
            <div class="card">
                <h3>Child Protection &amp; Well-Being</h3>
                <p>Promote safe, respectful environments where children are cared for and their dignity is protected.</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <h2>Support the Daily Care Program</h2>
        <p>Your donation may help provide a meal, purchase school supplies, or support a family in need.</p>
        <a href="<?= e(BASE_URL) ?>get-involved.php#donate" class="btn btn-primary">Donate or Volunteer</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>