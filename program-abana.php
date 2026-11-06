<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'ABANA Program';
$pageDescription = 'The ABANA Program helps children discover talents through art, communication, personal hygiene, and positive holiday learning.';

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>ABANA Program</h1>
        <p>Discovering Talents. Building Confidence. Preparing Children for the Future.</p>
    </div>
</section>

<section class="section">
    <div class="container two-col">
        <div>
            <h2>About the Program</h2>
            <p>The ABANA Program is a child-development initiative inspired by the founder's experience of teaching himself art after being unable to afford formal art lessons. It uses art, creative learning, communication, and personal care to help children grow in confidence and discover their potential.</p>
            <a href="<?= e(BASE_URL) ?>get-involved.php#donate" class="btn btn-secondary">Support ABANA</a>
        </div>
        <div>
            <img src="<?= e(IMAGES_URL) ?>Daily_Care_Program.jpg" alt="ABANA Program" class="img-rounded">
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">

        <article class="feature-row">
            <img src="<?= e(IMAGES_URL) ?>7.jpeg" alt="Art and Creative Learning">
            <div>
                <h2>1. Art and Creative Learning</h2>
                <p>We teach children drawing, painting, and other creative activities using simple and accessible materials that encourage imagination, patience, discipline, problem-solving, and self-expression. Art helps children discover their abilities and gives them a positive way to communicate their feelings, ideas, and experiences. It also helps children recognize talents that may lead to future educational, personal, or professional opportunities.</p>
            </div>
        </article>

        <article class="feature-row reverse">
            <img src="<?= e(IMAGES_URL) ?>19.jpeg" alt="Communication and Teamwork">
            <div>
                <h2>2. Communication and Language Development</h2>
                <p>We help children practice speaking, listening, expressing their ideas, communicating respectfully, and developing confidence when speaking with others. Where appropriate, activities can include practicing English and other useful languages according to children's needs and the available teaching resources.</p>
            </div>
        </article>

        <article class="feature-row">
            <img src="<?= e(IMAGES_URL) ?>9.jpeg" alt="Personal Hygiene and Self-Care">
            <div>
                <h2>3. Personal Hygiene and Self-Care</h2>
                <p>We teach children the importance of keeping their bodies clean, washing their hands, maintaining personal hygiene, caring for their clothes, and developing healthy daily routines. These lessons help children build self-respect, independence, and habits that contribute to their well-being.</p>
            </div>
        </article>

        <article class="feature-row reverse">
            <img src="<?= e(IMAGES_URL) ?>4.jpeg" alt="Feeding During Holidays">
            <div>
                <h2>4. Feeding and Child Well-Being During Holidays</h2>
                <p>During school holiday activities, we aim to provide meals to participating children, especially those experiencing food insecurity. Providing food alongside creative and educational activities helps create a more supportive environment in which children can participate, learn, and enjoy their time together.</p>
            </div>
        </article>

        <article class="feature-row">
            <img src="<?= e(IMAGES_URL) ?>18.jpeg" alt="Discipline and Teamwork">
            <div>
                <h2>5. Discipline, Responsibility, and Teamwork</h2>
                <p>Through group art projects, shared responsibilities, games, and guided activities, children learn patience, cooperation, respect, responsibility, and how to work together.</p>
            </div>
        </article>

        <article class="feature-row reverse">
            <img src="<?= e(IMAGES_URL) ?>32.jpeg" alt="Discovering Talents">
            <div>
                <h2>6. Discovering Talents and Future Opportunities</h2>
                <p>We encourage children to recognize their strengths, explore their interests, set goals, and understand that their future can include many possibilities. By exposing children to art, communication, creativity, and practical life skills, we hope to help them develop a stronger sense of direction and confidence in their abilities.</p>
            </div>
        </article>

        <article class="feature-row">
            <img src="<?= e(IMAGES_URL) ?>20.jpeg" alt="Positive Holiday Learning">
            <div>
                <h2>7. Positive Holiday Learning</h2>
                <p>We create structured holiday activities that combine creativity, learning, social interaction, personal care, and positive guidance. Our aim is to make school holidays a meaningful time for children to continue developing their knowledge, skills, and confidence rather than spending their time without support or opportunities.</p>
            </div>
        </article>

    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <h2>Help a Child Discover Their Talent</h2>
        <p>Your donation may help provide art materials, meals, or educational activities during the holidays.</p>
        <a href="<?= e(BASE_URL) ?>get-involved.php#donate" class="btn btn-primary">Donate or Volunteer</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>