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
// DATABASE CONNECTION
// =========================
require_once "../includes/db.php";

// =========================
// FUNCTION: GET IMAGES BY CATEGORY
// =========================
// This function fetches images from database based on category name
function getGalleryImages($pdo, $category) {
    $stmt = $pdo->prepare("
        SELECT * 
        FROM gallery_images 
        WHERE category = ? 
        ORDER BY created_at DESC
    ");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// =========================
// LOAD ALL GALLERY CATEGORIES
// =========================
$portraitImages = getGalleryImages($pdo, "portrait");
$eventsImages   = getGalleryImages($pdo, "events");
$weddingImages  = getGalleryImages($pdo, "wedding");
$productImages  = getGalleryImages($pdo, "product");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Responsive layout -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Our Work | Lensora Studio</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../global/main.css">
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
        <section class="hero hero-compact" aria-labelledby="work-heading">
            <div class="container">
                <h1 id="work-heading">Our Work</h1>
                <p>Explore our photography galleries by category.</p>
            </div>
        </section>

        <!-- =========================
             CATEGORY SELECTION SECTION
        ========================= -->
        <section aria-labelledby="categories-heading">
            <div class="container">

                <h2 id="categories-heading">Gallery Categories</h2>

                <!-- Category cards -->
                <div class="category-grid">

                    <!-- Portrait -->
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="portrait">
                            <img src="../images/1-work.webp" alt="Portrait category">
                        </a>
                        <h3>Portrait</h3>
                    </div>

                    <!-- Events -->
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="events">
                            <img src="../images/2-work.webp" alt="Events category">
                        </a>
                        <h3>Events</h3>
                    </div>

                    <!-- Wedding -->
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="wedding">
                            <img src="../images/3-work.webp" alt="Wedding category">
                        </a>
                        <h3>Wedding</h3>
                    </div>

                    <!-- Product -->
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="product">
                            <img src="../images/4-work.jpeg" alt="Product category">
                        </a>
                        <h3>Product</h3>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================
             PORTRAIT GALLERY
        ========================= -->
        <section id="portrait" class="gallery-section hidden" aria-labelledby="portrait-heading">
            <div class="container">
                <h2 id="portrait-heading" class="section-title">
                    Portrait Photography
                </h2>

                <div class="gallery-grid">
                    <?php foreach ($portraitImages as $img): ?>
                        <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Portrait image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- =========================
             EVENTS GALLERY
        ========================= -->
        <section id="events" class="gallery-section hidden" aria-labelledby="events-heading">
            <div class="container">
                <h2 id="events-heading" class="section-title">
                    Event Photography
                </h2>

                <div class="gallery-grid">
                    <?php foreach ($eventsImages as $img): ?>
                        <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Event image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- =========================
             WEDDING GALLERY
        ========================= -->
        <section id="wedding" class="gallery-section hidden" aria-labelledby="wedding-heading">
            <div class="container">
                <h2 id="wedding-heading" class="section-title">
                    Wedding Photography
                </h2>

                <div class="gallery-grid">
                    <?php foreach ($weddingImages as $img): ?>
                        <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Wedding image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- =========================
             PRODUCT GALLERY
        ========================= -->
        <section id="product" class="gallery-section hidden" aria-labelledby="product-heading">
            <div class="container">
                <h2 id="product-heading" class="section-title">
                    Product Photography
                </h2>

                <div class="gallery-grid">
                    <?php foreach ($productImages as $img): ?>
                        <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Product image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- =========================
         CATEGORY SWITCH SCRIPT
    ========================= -->
    <script>
        const links = document.querySelectorAll('.gallery-link');
        const sections = document.querySelectorAll('.gallery-section');

        links.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();

                // Hide all sections
                sections.forEach(sec => sec.classList.add('hidden'));

                // Show selected category
                const target = document.getElementById(link.dataset.target);
                target.classList.remove('hidden');

                // Scroll smoothly to section
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>