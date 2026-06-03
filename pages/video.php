<?php
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM site_videos ORDER BY created_at DESC LIMIT 1");
$video = $stmt->fetch(PDO::FETCH_ASSOC);

/* FIX: normalize path safely */
$videoPath = "";

if (!empty($video['video_path'])) {
    $videoPath = "../" . ltrim($video['video_path'], "/");
}
?>


<!DOCTYPE html>
<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
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
<a href="#main-content" class="skip-link">Skip to main content</a>
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Header_nav -->
<?php include '../includes/header_nav.php'; ?>

    <!-- Main -->
    <main id="main-content" class="main-content">

        <!-- Hero -->
        <section class="hero hero-compact" aria-labelledby="video-hero-heading">
            <div class="container">

                <h1 id="video-hero-heading">
                    Lensora Studio Video
                </h1>

                <p class="brand-intro-lead">
                    Photography and motion content for clients who value composition,
                    consistent color, and a calm, professional experience.
                </p>

            </div>
        </section>

        <!-- Video Section -->
        <section aria-labelledby="studio-video-heading">
            <div class="container">

                <div class="section-header">
                    <h2 id="studio-video-heading">
                        Watch How We Plan, Shoot, and Deliver Polished Visuals
                    </h2>

                    <div class="accent-line"></div>
                </div>

                <div class="video-container">

                    <?php if ($video): ?>

                        <video width="100%" controls>
                            <source src="../<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    <?php else: ?>

                        <p class="text-center">
                            No video available at the moment.
                        </p>

                    <?php endif; ?>

                </div>

            </div>
        </section>

    </main>

    <!-- ================= footer ================= -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="../scripts/main.js"></script>

</body>
</html>

