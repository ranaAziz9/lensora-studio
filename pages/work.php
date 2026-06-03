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
<a href="#main-content" class="skip-link">Skip to main content</a>
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
     <!-- Header_nav -->
<?php include '../includes/header_nav.php'; ?>

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

   <!-- ================= footer ================= -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

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
