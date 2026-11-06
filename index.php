<?php
/**
 * index.php — Homepage
 */
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Home';
$pageDescription = 'Spread Love Foundation supports vulnerable children and families in Gashora, Rwanda, through the Daily Care Program and the ABANA Program.';

include __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1>Nourishing Children Today.<br>Inspiring Their Talents.<br>Building Hope for Tomorrow.</h1>
        <p class="hero-sub"><?= e(SITE_NAME) ?> — <?= e(SITE_LOCATION) ?></p>
        <div class="hero-actions">
            <a href="<?= e(BASE_URL) ?>get-involved.php#donate" class="btn btn-primary">Donate</a>
            <a href="<?= e(BASE_URL) ?>programs.php" class="btn btn-outline">Our Programs</a>
        </div>
    </div>
</section>

<!-- INTRO / ABOUT -->
<section class="section">
    <div class="container two-col">
        <div>
            <h2>About Spread Love Foundation</h2>
            <p>Spread Love Foundation is a community-focused initiative committed to supporting vulnerable children and families through care, education, creativity, and community development.</p>
            <p>The idea for the ABANA Program comes from the founder's personal experience: after realizing his family could not afford formal art lessons at Nyundo School, he taught himself using simple materials. Through practice and determination, he kept developing his artistic talent.</p>
            <p>That experience helped him recognize that many children have artistic abilities but no opportunity to attend art school or receive creative training. The ABANA Program was created to give these children a safe, positive space where they can learn, grow, and focus on their future.</p>
            <a href="<?= e(BASE_URL) ?>about.php" class="btn btn-secondary">Read Our Story</a>
        </div>
        <div>
            <img src="<?= e(IMAGES_URL) ?>2.jpeg" alt="Children learning art at ABANA Program" class="img-rounded">
        </div>
    </div>
</section>

<!-- VISION & MISSION -->
<section class="section section-alt">
    <div class="container">
        <h2 class="center">Our Vision &amp; Mission</h2>
        <div class="cards two">
            <div class="card">
                <h3>Our Vision</h3>
                <p>A future where every child, regardless of their family's financial situation, has the opportunity to live with dignity, receive proper care, develop their talents, access education, and pursue their dreams.</p>
            </div>
            <div class="card">
                <h3>Our Mission</h3>
                <p>To empower vulnerable children and support their families through nutritious food, creative education, personal development, hygiene awareness, communication skills, and community support — helping children grow into confident, responsible, and hopeful young people.</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY YOUR SUPPORT MATTERS -->
<section class="section section-alt">
    <div class="container">
        <h2 class="center">Why Your Support Matters</h2>
        <p class="center sub-heading">Behind every child is a future that deserves a chance.</p>

        <div class="cards three">
            <div class="card">
                <h3>Food &amp; Nutrition</h3>
                <p>Some children are eager to learn but struggle with hunger. Your support can provide a nutritious meal.</p>
            </div>
            <div class="card">
                <h3>Creativity &amp; Talent</h3>
                <p>Some children have dreams but lack materials to explore their talents. Art supplies and lessons can change that.</p>
            </div>
            <div class="card">
                <h3>Guidance &amp; Hope</h3>
                <p>Children need encouragement, guidance, and a safe environment to discover their strengths and imagine their future.</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW THE PROGRAMS WORK TOGETHER -->
<section class="section">
    <div class="container">
        <h2 class="center">How the Two Programs Work Together</h2>
        <div class="two-col align-center">
            <div>
                <h3>Daily Care supports the child</h3>
                <p>Focuses on food, basic needs, educational assistance, and family support.</p>
            </div>
            <div>
                <h3>ABANA develops the child</h3>
                <p>Focuses on art, communication, hygiene, discipline, creativity, and life skills.</p>
            </div>
        </div>
        <p class="center highlight-text">We do not want to help children only survive difficult circumstances. We want to help them discover what they can become.</p>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="cta-band">
    <div class="container cta-inner">
        <h2>Join Us in Building Hope</h2>
        <p>We may not have all the resources needed to support every child today, but we can begin with the children within our reach.</p>
        <div class="hero-actions">
            <a href="<?= e(BASE_URL) ?>get-involved.php" class="btn btn-primary">Get Involved</a>
            <a href="<?= e(BASE_URL) ?>contact.php" class="btn btn-outline-light">Contact Us</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>