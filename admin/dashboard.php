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
  <title>Dashboard | Lensora Studio</title>
  <link rel="stylesheet" href="../global/main.css">
</head>

<body>
<header class="site-header">
  <nav class="site-nav">
    <div class="container nav-container">
      <a href="../index.html" class="nav-logo">
        <img src="../images/logo.png" alt="Lensora Studio logo">
      </a>

      <ul class="nav-links">
        <li><a href="dashboard.php" class="active">Dashboard</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="../index.php">View Website</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
</header>

<main class="main-content">

<section class="hero hero-compact">
  <div class="container">
    <h1>Dashboard</h1>
    <p>Manage Lensora Studio content, bookings, and client feedback.</p>
  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="section-header">
      <h2>Manage Gallery</h2>
      <div class="accent-line"></div>
    </div>

    <div class="category-grid">
      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-portrait">
          <img src="../images/1-work.webp" alt="Portrait category">
        </a>
        <h3>Portrait</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-events">
          <img src="../images/2-work.webp" alt="Events category">
        </a>
        <h3>Events</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-wedding">
          <img src="../images/3-work.webp" alt="Wedding category">
        </a>
        <h3>Wedding</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-product">
          <img src="../images/4-work.jpeg" alt="Product category">
        </a>
        <h3>Product</h3>
      </div>
    </div>
  </div>
</section>

<?php
$sections = [
    "admin-portrait" => ["title" => "Portrait Photography", "category" => "portrait", "images" => $portraitImages],
    "admin-events" => ["title" => "Event Photography", "category" => "events", "images" => $eventsImages],
    "admin-wedding" => ["title" => "Wedding Photography", "category" => "wedding", "images" => $weddingImages],
    "admin-product" => ["title" => "Product Photography", "category" => "product", "images" => $productImages],
];
?>

<?php foreach ($sections as $sectionId => $section): ?>
<section id="<?php echo $sectionId; ?>" class="gallery-section hidden">
  <div class="container">
    <h2 class="section-title"><?php echo $section["title"]; ?></h2>

    <div class="text-center mb-4">
      <form action="upload-gallery.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="category" value="<?php echo $section["category"]; ?>">
        <input type="file" name="image" required>
        <button type="submit" class="btn btn-primary">Add New Image</button>
      </form>
    </div>

    <div class="gallery-grid">
      <?php if (count($section["images"]) > 0): ?>
        <?php foreach ($section["images"] as $img): ?>
          <div>
            <img src="../<?php echo htmlspecialchars($img["image_path"]); ?>" alt="Gallery image">
            <a href="delete-gallery.php?id=<?php echo $img["id"]; ?>"
               class="btn btn-dark btn-full"
               onclick="return confirm('Are you sure you want to delete this image?');">
              Delete
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No images uploaded yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endforeach; ?>

</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-bottom">
      <p>&copy; 2026 Lensora Studio. Admin Panel.</p>
    </div>
  </div>
</footer>

<script>
  const adminLinks = document.querySelectorAll('.admin-gallery-link');
  const adminSections = document.querySelectorAll('.gallery-section');

  adminLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      adminSections.forEach(section => section.classList.add('hidden'));

      const target = document.getElementById(link.dataset.target);
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });
</script>

</body>
</html>