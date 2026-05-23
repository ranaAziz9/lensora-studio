<?php
require_once "../includes/db.php";

function getGalleryImages($pdo, $category) {
    $stmt = $pdo->prepare("SELECT * FROM gallery_images WHERE category = ? ORDER BY created_at DESC");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$portraitImages = getGalleryImages($pdo, "portrait");
$eventsImages   = getGalleryImages($pdo, "events");
$weddingImages  = getGalleryImages($pdo, "wedding");
$productImages  = getGalleryImages($pdo, "product");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Work | Lensora Studio</title>
    <link rel="stylesheet" href="../global/main.css">
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <header class="site-header">
        <nav class="site-nav" aria-label="Primary navigation">
            <div class="container nav-container">
                <a href="../index.php" class="nav-logo">
                    <img src="../images/logo.png" alt="Lensora Studio logo">
                </a>
                <ul class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="work.php" class="active">Our Work</a></li>
                    <li><a href="video.php">Video</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="auth.php" style="background: #000; color: #fff; padding: 6px 15px; border-radius: 20px;">Login / Register</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main id="main-content" class="main-content">
        <section class="hero hero-compact" aria-labelledby="work-heading">
            <div class="container">
                <h1 id="work-heading">Our Work</h1>
                <p>Explore our photography galleries by category.</p>
            </div>
        </section>

        <section aria-labelledby="categories-heading">
            <div class="container">
                <h2 id="categories-heading">Gallery Categories</h2>

                <div class="category-grid">
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="portrait">
                            <img src="../images/1-work.webp" alt="Portrait category">
                        </a>
                        <h3>Portrait</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="events">
                            <img src="../images/2-work.webp" alt="Events category">
                        </a>
                        <h3>Events</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="wedding">
                            <img src="../images/3-work.webp" alt="Wedding category">
                        </a>
                        <h3>Wedding</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="product">
                            <img src="../images/4-work.jpeg" alt="Product category">
                        </a>
                        <h3>Product</h3>
                    </div>
                </div>
            </div>
        </section>

        <section id="portrait" class="gallery-section hidden" aria-labelledby="portrait-heading">
            <div class="container">
                <h2 id="portrait-heading" class="section-title">Portrait Photography</h2>
                <div class="gallery-grid">
                    <?php foreach ($portraitImages as $img): ?>
                        <img src="../<?php echo htmlspecialchars($img['image_path']); ?>" alt="Portrait image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="events" class="gallery-section hidden" aria-labelledby="events-heading">
            <div class="container">
                <h2 id="events-heading" class="section-title">Event Photography</h2>
                <div class="gallery-grid">
                    <?php foreach ($eventsImages as $img): ?>
                        <img src="../<?php echo htmlspecialchars($img['image_path']); ?>" alt="Event image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="wedding" class="gallery-section hidden" aria-labelledby="wedding-heading">
            <div class="container">
                <h2 id="wedding-heading" class="section-title">Wedding Photography</h2>
                <div class="gallery-grid">
                    <?php foreach ($weddingImages as $img): ?>
                        <img src="../<?php echo htmlspecialchars($img['image_path']); ?>" alt="Wedding image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="product" class="gallery-section hidden" aria-labelledby="product-heading">
            <div class="container">
                <h2 id="product-heading" class="section-title">Product Photography</h2>
                <div class="gallery-grid">
                    <?php foreach ($productImages as $img): ?>
                        <img src="../<?php echo htmlspecialchars($img['image_path']); ?>" alt="Product image">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Lensora Studio</h3>
                    <p>Photography and short-form video for people and brands who care about detail.</p>
                </div>

                <div class="footer-section">
                    <h3>Feedback</h3>
                    <p class="footer-feedback"><a href="feedback.php">Client feedback form</a></p>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>
                    <address class="footer-address">
                        Email: <a href="mailto:info@lensora.com">info@lensora.com</a><br>
                        Phone: <a href="tel:+966500000000">+966 50 000 0000</a><br>
                        Jeddah, Saudi Arabia
                    </address>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const links = document.querySelectorAll('.gallery-link');
        const sections = document.querySelectorAll('.gallery-section');

        links.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();

                sections.forEach(sec => sec.classList.add('hidden'));

                const target = document.getElementById(link.dataset.target);
                target.classList.remove('hidden');
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>