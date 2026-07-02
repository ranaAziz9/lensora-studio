<<<<<<< HEAD

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
// Restrict access to administrators only.
require_once '../includes/auth.php';
checkAdmin();
// Load database connection settings.
require_once "../includes/db.php";
=======
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
$videosStmt = $pdo->query("SELECT * FROM site_videos ORDER BY created_at DESC");
$videos = $videosStmt->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
<<<<<<< HEAD

<a href="#main-content" class="skip-link">Skip to main content</a>
<!-- Include the shared navigation header -->
<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">
<!-- Dashboard welcome section -->
<section class="hero hero-compact">
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Choose what you want to manage.</p>
    </div>
</section>
<!-- Main administration menu -->
<section class="dashboard-menu">
    <div class="container">

        <div class="section-header">
            <h2>Management Panel</h2>
            <div class="accent-line"></div>
        </div>
<!-- Grid containing all management options -->
        <div class="dashboard-grid">
<!-- Link to service management page -->
            <a href="services-manage.php" class="dashboard-card">
                <i class="fa-solid fa-camera"></i>
                <h3>Manage Services</h3>
                <p>Add, edit, and delete photography services.</p>
            </a>
<!-- Link to package management page -->
            <a href="packages-manage.php" class="dashboard-card">
                <i class="fa-solid fa-box-open"></i>
                <h3>Manage Packages</h3>
                <p>Control package names, prices, and descriptions.</p>
            </a>
<!-- Link to gallery management page -->
            <a href="gallery-manage.php" class="dashboard-card">
                <i class="fa-solid fa-images"></i>
                <h3>Manage Gallery</h3>
                <p>Upload and delete gallery images by category.</p>
            </a>
<!-- Link to video management page -->
            <a href="videos-manage.php" class="dashboard-card">
                <i class="fa-solid fa-video"></i>
                <h3>Manage Videos</h3>
                <p>Upload or delete promotional videos.</p>
            </a>
<!-- Link to booking management page -->
            <a href="bookings-manage.php" class="dashboard-card">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Manage Bookings</h3>
                <p>Approve, reject, and filter client bookings.</p>
            </a>
<!-- Link to customer feedback management page -->
            <a href="feedback-manage.php" class="dashboard-card">
                <i class="fa-solid fa-comments"></i>
                <h3>Manage Feedback</h3>
                <p>Search and delete client feedback.</p>
            </a>
=======
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
          <h2>Manage Services</h2>
          <div class="accent-line"></div>
        </div>

        <div class="text-center mb-4">
          <button class="btn btn-primary">Add New Service</button>
        </div>

        <div class="services-grid">
          <div class="service-card">
            <h3>Portrait Photography</h3>
            <p>Headshots, families, and personal branding.</p>
            <p class="price">Starting from <strong>$199</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="service-card">
            <h3>Graduation Photography</h3>
            <p>Caps, gowns, and celebration shots.</p>
            <p class="price">Starting from <strong>$299</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="service-card">
            <h3>Product Photography</h3>
            <p>Clean catalog images and hero shots.</p>
            <p class="price">Starting from <strong>$149</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-header">
          <h2>Manage Packages</h2>
          <div class="accent-line"></div>
        </div>

        <div class="text-center mb-4">
          <button class="btn btn-primary">Add New Package</button>
        </div>

        <div class="package-grid">
          <div class="package-card">
            <h3>Basic Package</h3>
            <p class="price">$199</p>
            <ul class="pkg-list">
              <li>1-hour session</li>
              <li>50+ edited photos</li>
              <li>Digital copies</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="package-card">
            <h3>Standard Package</h3>
            <p class="price">$349</p>
            <ul class="pkg-list">
              <li>2-hour session</li>
              <li>100+ edited photos</li>
              <li>Digital + USB</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="package-card">
            <h3>Premium Package</h3>
            <p class="price">$599</p>
            <ul class="pkg-list">
              <li>4-hour session</li>
              <li>200+ edited photos</li>
              <li>Album included</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>
        </div>
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

<section class="section-alt">
  <div class="container">
    <div class="section-header">
      <h2>Manage Video</h2>
      <div class="accent-line"></div>
    </div>

    <div class="form-panel mb-4">
      <form action="upload-video.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="video">Upload New Video</label>
          <input type="file" id="video" name="video" accept="video/mp4,video/webm,video/ogg" required>
        </div>

        <button type="submit" class="btn btn-primary">Add New Video</button>
      </form>
    </div>

    <div class="gallery-grid">
  <?php foreach ($videos as $video): ?>

    <div class="admin-video-card">

  <div style="max-width:520px; margin:0 auto 2rem; background:#fff; padding:1rem; border-radius:1rem;">

  <video controls style="width:100%; height:300px; object-fit:contain; display:block; margin:0 auto 1rem; border-radius:12px; background:#000;">
    <source src="../<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <a href="delete-video.php?id=<?php echo $video['id']; ?>"
     class="btn btn-dark btn-full"
     onclick="return confirm('Are you sure you want to delete this video?');">
    Delete
  </a>

</div>
    </div>
  <?php endforeach; ?>


</section>

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
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71

          

        </div>

    </div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

<<<<<<< HEAD
=======
      const target = document.getElementById(link.dataset.target);
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });
</script>

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
</body>
</html>

