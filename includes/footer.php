<?php
/**
 * includes/footer.php
 * Closes <main>, prints footer + scripts.
 */
?>
</main><!-- /#main-content -->

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-col">
            <h3><?= e(SITE_NAME) ?></h3>
            <p><?= e(SITE_TAGLINE) ?></p>
            <p class="footer-tagline">Every Child Deserves Care. Every Child Has Potential. Every Child Deserves a Future.</p>
        </div>

        <div class="footer-col">
            <h4>Explore</h4>
            <ul>
                <li><a href="<?= e(BASE_URL) ?>about.php">About Us</a></li>
                <li><a href="<?= e(BASE_URL) ?>programs.php">Our Programs</a></li>
                <li><a href="<?= e(BASE_URL) ?>gallery.php">Gallery</a></li>
                <li><a href="<?= e(BASE_URL) ?>get-involved.php">Get Involved</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Programs</h4>
            <ul>
                <li><a href="<?= e(BASE_URL) ?>program-daily-care.php">Daily Care Program</a></li>
                <li><a href="<?= e(BASE_URL) ?>program-abana.php">ABANA Program</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contact</h4>
            <ul>
                <li><?= e(SITE_LOCATION) ?></li>
                <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                <li><?= e(SITE_PHONE) ?></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="<?= e(ASSETS_URL) ?>js/main.js"></script>
<?php if (!empty($extraScripts) && is_array($extraScripts)): ?>
    <?php foreach ($extraScripts as $s): ?>
        <script src="<?= e(ASSETS_URL . 'js/' . $s) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>