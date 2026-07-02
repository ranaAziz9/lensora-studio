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
// Include authentication file
require_once '../includes/auth.php';

// Ensure only admin users can access this page
checkAdmin();

// Include database connection file
require_once "../includes/db.php";

// Function to fetch gallery images based on category
function getGalleryImages($pdo, $category) {
    // Prepare SQL query to get images by category
    $stmt = $pdo->prepare("
        SELECT *
        FROM gallery_images
        WHERE category = ?
        ORDER BY created_at DESC
    ");
    
    // Execute query with category parameter
    $stmt->execute([$category]);

    // Return all fetched images as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Define gallery sections with display titles
$sections = [
    "portrait" => "Portrait",
    "events" => "Events",
    "wedding" => "Wedding",
    "product" => "Product"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Page title -->
<title>Manage Gallery | Lensora Studio</title>

<!-- Main stylesheet -->
<link rel="stylesheet" href="../global/main.css">

<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<!-- Skip link for accessibility -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Include navigation header -->
<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<!-- Hero section -->
<section class="hero hero-compact">
<div class="container">
<h1>Manage Gallery</h1>
<p>Upload and delete gallery images.</p>
</div>
</section>

<!-- Loop through each gallery section -->
<?php foreach ($sections as $category => $title): ?>

<?php 
// Fetch images for the current category
$images = getGalleryImages($pdo, $category); 
?>

<section class="section-alt">
<div class="container">

<!-- Section header -->
<div class="section-header">
<h2><?= htmlspecialchars($title) ?></h2>
<div class="accent-line"></div>
</div>

<!-- Upload image form -->
<div class="form-card">

<form action="upload-gallery.php" method="POST" enctype="multipart/form-data">

<!-- Hidden input for category -->
<input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">

<!-- Image file input -->
<input
    type="file"
    name="image"
    class="input"
    accept=".jpg,.jpeg,.png,.webp"
    required
>

<!-- Submit button -->
<button type="submit" class="btn btn-primary btn-full">
Add New Image
</button>

</form>

</div>

<!-- Gallery grid -->
<div class="grid admin-grid">

<?php if (count($images) > 0): ?>

<!-- Loop through images -->
<?php foreach ($images as $img): ?>

<div class="card">

<!-- Display image -->
<img
    src="../<?= htmlspecialchars($img["image_path"]) ?>"
    alt="Gallery Image"
    class="admin-card-img"
>

<!-- Delete image button -->
<a
    href="delete-gallery.php?id=<?= htmlspecialchars($img["id"]) ?>"
    class="btn btn-dark btn-full"
    onclick="return confirm('Delete this image?')"
>
Delete
</a>

</div>

<?php endforeach; ?>

<?php else: ?>

<!-- No images message -->
<p>No images uploaded yet.</p>

<?php endif; ?>

</div>

</div>
</section>

<?php endforeach; ?>

</main>

<!-- Footer include -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Main JavaScript file -->
<script src="../scripts/main.js"></script>

</body>
</html>