<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Gallery';
$pageDescription = 'Photos from the Daily Care and ABANA Programs of Spread Love Foundation.';

$images = [
    ['file' => '24.jpeg', 'caption' => 'Young Artist with Wildlife Paintings'],
    ['file' => '25.jpeg', 'caption' => 'A Student Shares Chimpanzee and Fruit Paintings'],
    ['file' => '26.jpeg', 'caption' => 'Student Artwork Featuring an Elephant'],
    ['file' => '27.jpeg', 'caption' => 'Young Artist with Still-Life and Lion Paintings'],
    ['file' => '28.jpeg', 'caption' => 'Student Artwork Featuring a Rhino and Fruit'],
    ['file' => '29.jpeg', 'caption' => 'Young Artist with Chimpanzee and Still-Life Paintings'],
    ['file' => '30.jpeg', 'caption' => 'A Display of Student Artwork'],
    ['file' => '31.jpeg', 'caption' => 'Students Learning and Creating Art Together'],
    ['file' => '32.jpeg', 'caption' => 'Students Painting in the Art Workshop'],
];

include __DIR__ . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">

        <h1>Gallery</h1>
        <p>Moments from our programs in Gashora.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="gallery-grid">
            <?php foreach ($images as $img): ?>
                <figure class="gallery-item">
                    <img src="<?= e(IMAGES_URL . $img['file']) ?>" alt="<?= e($img['caption']) ?>">
                    <figcaption><?= e($img['caption']) ?></figcaption>
                </figure>
            <?php endforeach; ?>
            </div>