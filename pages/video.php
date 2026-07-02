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
                <p class="brand-intro-lead">
                    Photography and motion content for clients who value composition,
                    consistent color, and a calm, professional experience.
                </p>
            </div>
        </section>

        <!-- =========================
             VIDEO DISPLAY SECTION
        ========================= -->
        <section aria-labelledby="studio-video-heading">
            <div class="container">

                <!-- Section title -->
                <div class="section-header">
                    <h2 id="studio-video-heading">
                        Watch How We Plan, Shoot, and Deliver Polished Visuals
                    </h2>
                    <div class="accent-line"></div>
                </div>

                <!-- Video container -->
                <div class="video-container">

                    <?php if ($video && !empty($videoPath)): ?>

                        <!-- Video player -->
                        <video width="100%" controls>
                            <source src="<?= htmlspecialchars($videoPath) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    <?php else: ?>

                        <!-- Fallback message -->
                        <p class="text-center">
                            No video available at the moment.
                        </p>

                    <?php endif; ?>

                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Main JS file -->
    <script src="../scripts/main.js"></script>

</body>
</html>