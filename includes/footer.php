<?php

// Start session if no active session exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base path used for navigation and asset links
$base = "/len/lensora-studio/";
?>

<!-- Website footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">

            <!-- About section -->
            <div class="footer-section">
                <h3>Lensora Studio</h3>
                <p>Photography and short-form video for people and brands who care about detail.</p>
            </div>

            <!-- Feedback page link -->
            <div class="footer-section">
                <h3>Feedback</h3>
                <p class="footer-feedback">
                    <a href="<?= $base ?>pages/feedback.php">Client feedback form</a>
                </p>
            </div>

            <!-- Contact information -->
            <div class="footer-section">
                <h3>Contact</h3>
                <address class="footer-address">
                    Email: <a href="mailto:info@lensora.com">info@lensora.com</a><br>
                    Phone: <a href="tel:+966500000000">+966 50 000 0000</a><br>
                    Jeddah, Saudi Arabia
                </address>
            </div>

        </div>

        <!-- Copyright section -->
        <div class="footer-bottom">
            <p>&copy; <?= date("Y") ?> Lensora Studio. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Main JavaScript file -->
<script src="<?= $base ?>scripts/main.js"></script>
</body>
</html>