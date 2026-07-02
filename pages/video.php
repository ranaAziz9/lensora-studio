<<<<<<< HEAD
=======
<?php
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM site_videos ORDER BY created_at DESC LIMIT 1");
$video = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
<<<<<<< HEAD
  ID: 2206257
  Section: DAR
  Date: 5/6/2026
-->

<?php
// =========================
// CONNECT TO DATABASE
// =========================
require_once "../includes/db.php";

// =========================
// FETCH LATEST VIDEO FROM DATABASE
// =========================
// Get the most recent video uploaded to site_videos table
$stmt = $pdo->query("SELECT * FROM site_videos ORDER BY created_at DESC LIMIT 1");
$video = $stmt->fetch(PDO::FETCH_ASSOC);

// =========================
// NORMALIZE VIDEO PATH
// =========================
// Ensure the file path works correctly in browser by adding "../"
$videoPath = "";

if ($video && !empty($video['video_path'])) {
    $videoPath = "../" . ltrim($video['video_path'], "/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Video | Lensora Studio — Introduction</title>

    <!-- Global styles -->
    <link rel="stylesheet" href="../global/main.css">

    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

    <!-- Skip link for accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header navigation -->
    <?php include '../includes/header_nav.php'; ?>

    <main id="main-content" class="main-content">

        <!-- =========================
             HERO SECTION
        ========================= -->
        <section class="hero hero-compact" aria-labelledby="video-hero-heading">
            <div class="container">
                <h1 id="video-hero-heading">Lensora Studio Video</h1>

                <!-- Intro text -->
=======
  ID: 2206250
  Section: DAR
  Date: 2/4/2026
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video | Lensora Studio — Introduction</title>
    <link rel="stylesheet" href="../global/main.css">
</head>
<body>

    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header -->
    <header class="site-header">
        <nav class="site-nav" aria-label="Primary navigation">
            <div class="container nav-container">

                <a href="../index.php" class="nav-logo">
                    <img src="../images/logo.png" alt="Lensora Studio logo">
                </a>

                <ul id="primary-nav" class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="work.php">Our Work</a></li>
                    <li><a href="video.php">Video</a></li>
                    <li><a href="feedback.php">Feedback</a></li>

                    <li>
                        <a href="../login.php"
                           style="background: #000; color: #fff; padding: 6px 15px; border-radius: 20px;">
                           Login / Register
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>

    <!-- Main -->
    <main id="main-content" class="main-content">

        <!-- Hero -->
        <section class="hero hero-compact" aria-labelledby="video-hero-heading">
            <div class="container">

                <h1 id="video-hero-heading">
                    Lensora Studio Video
                </h1>

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
                <p class="brand-intro-lead">
                    Photography and motion content for clients who value composition,
                    consistent color, and a calm, professional experience.
                </p>
<<<<<<< HEAD
            </div>
        </section>

        <!-- =========================
             VIDEO DISPLAY SECTION
        ========================= -->
        <section aria-labelledby="studio-video-heading">
            <div class="container">

                <!-- Section title -->
=======

            </div>
        </section>

        <!-- Video Section -->
        <section aria-labelledby="studio-video-heading">
            <div class="container">

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
                <div class="section-header">
                    <h2 id="studio-video-heading">
                        Watch How We Plan, Shoot, and Deliver Polished Visuals
                    </h2>
<<<<<<< HEAD
                    <div class="accent-line"></div>
                </div>

                <!-- Video container -->
                <div class="video-container">

                    <?php if ($video && !empty($videoPath)): ?>

                        <!-- Video player -->
                        <video width="100%" controls>
                            <source src="<?= htmlspecialchars($videoPath) ?>" type="video/mp4">
=======

                    <div class="accent-line"></div>
                </div>

                <div class="video-container">

                    <?php if ($video): ?>

                        <video width="100%" controls>
                            <source src="../<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
                            Your browser does not support the video tag.
                        </video>

                    <?php else: ?>

<<<<<<< HEAD
                        <!-- Fallback message -->
=======
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
                        <p class="text-center">
                            No video available at the moment.
                        </p>

                    <?php endif; ?>

                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
<<<<<<< HEAD
    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Main JS file -->
    <script src="../scripts/main.js"></script>

</body>
</html>
=======
    <footer class="site-footer">

        <div class="container">

            <div class="footer-content">

                <div class="footer-section">
                    <h3>Lensora Studio</h3>

                    <p>
                        Photography and short-form video for people and brands
                        who care about detail.
                    </p>
                </div>

                <div class="footer-section">
                    <h3>Feedback</h3>

                    <p class="footer-feedback">
                        <a href="feedback.php">Client feedback form</a>
                    </p>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>

                    <address class="footer-address">
                        Email:
                        <a href="mailto:info@lensora.com">
                            info@lensora.com
                        </a>
                        <br>

                        Phone:
                        <a href="tel:+966500000000">
                            +966 50 000 0000
                        </a>
                        <br>

                        Jeddah, Saudi Arabia
                    </address>
                </div>

            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
            </div>

        </div>

    </footer>

    <script src="../scripts/main.js"></script>

</body>
</html>

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
