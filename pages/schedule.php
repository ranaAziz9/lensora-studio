<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206257
  Section: DAR
  Date: 5/6/2026
-->
<?php
session_start();
require_once "../includes/db.php"; 

// Check if the user is currently logged in via session
$isLoggedIn = isset($_SESSION['user_id']);

// Get logged-in user email (used to auto-fill booking form)
// If not logged in, keep empty string
$sessionEmail = $isLoggedIn ? $_SESSION['email'] : '';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Schedule | Lensora Studio</title>

    <!-- Main stylesheet -->
    <link rel="stylesheet" href="../global/main.css">

    <!-- Print-specific stylesheet (for printing schedule table) -->
    <link rel="stylesheet" href="../global/print.css" media="print">

    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

    <!-- Skip link for accessibility (keyboard navigation) -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header navigation -->
    <?php include '../includes/header_nav.php'; ?>

    <main id="main-content">

        <!-- ================= PAGE HEADER ================= -->
        <div class="container text-center mt-4">
            <h1>Book Your Session</h1>
            <p>Select your package, date, and time.</p>
        </div>

        <!-- Selected package display (updated via JS) -->
        <div class="container text-center mt-2">
            <h2 id="selected-package">Selected Package: —</h2>
        </div>

        <!-- Month selector for schedule -->
        <div class="container text-center mt-4">
            <label for="month-select">Select Month:</label>
            <select id="month-select"></select>
        </div>

        <!-- ================= SCHEDULE TABLE ================= -->
        <div class="container mt-4">
            <div class="table-responsive print-table-area">
                <table class="booking-table">
                    <thead id="table-head"></thead>
                    <tbody id="schedule-body"></tbody>
                </table>
            </div>
        </div>

        <!-- ================= BOOKING FORM ================= -->
        <div class="container" style="max-width:500px; margin-top:40px; margin-bottom:40px;">
            <h2 class="text-center">Complete Booking</h2>

            <form id="booking-form" class="form-panel">

                <!-- Selected date (auto-filled from schedule) -->
                <div class="form-group">
                    <label for="selected-date">Date</label>
                    <input type="text" id="selected-date" readonly required>
                </div>

                <!-- Selected time (auto-filled from schedule) -->
                <div class="form-group">
                    <label for="selected-time">Time</label>
                    <input type="text" id="selected-time" readonly required>
                </div>

                <!-- User name input -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" required>
                </div>

                <!-- Email input (pre-filled if logged in) -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?php echo htmlspecialchars($sessionEmail); ?>" required>
                </div>

                <!-- Show different button based on login status -->
                <?php if ($isLoggedIn): ?>
                    <button type="submit" class="btn btn-primary btn-full">Confirm Booking</button>
                <?php else: ?>
                    <a href="auth.php"
                       class="btn btn-secondary btn-full"
                       style="text-align: center; display: block; background: #c0392b; color: #fff;">
                        Please Login to Book
                    </a>
                <?php endif; ?>

            </form>
        </div>

    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">

                <!-- About section -->
                <div class="footer-section">
                    <h3>Lensora Studio</h3>
                    <p>Photography and short-form video for people and brands who care about detail.</p>
                </div>

                <!-- Feedback link -->
                <div class="footer-section">
                    <h3>Feedback</h3>
                    <p class="footer-feedback"><a href="feedback.html">Client feedback form</a></p>
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

            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Pass PHP variables to JavaScript -->
    <script>
        const userIsLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
        const sessionEmail = "<?php echo htmlspecialchars($sessionEmail); ?>";
    </script>

    <!-- Main JS file -->
    <script src="../scripts/main.js"></script>

</body>
</html>