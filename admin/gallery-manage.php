<?php
require_once '../includes/auth.php';
checkAdmin();
require_once "../includes/db.php";

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

<title>Manage Gallery | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Gallery</h1>
<p>Upload and delete gallery images.</p>
</div>
</section>

<?php foreach ($sections as $category => $title): ?>

<?php $images = getGalleryImages($pdo, $category); ?>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2><?= htmlspecialchars($title) ?></h2>
<div class="accent-line"></div>
</div>

<div class="form-card">

<form action="upload-gallery.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">

<input
    type="file"
    name="image"
    class="input"
    accept=".jpg,.jpeg,.png,.webp"
    required
>

<button type="submit" class="btn btn-primary btn-full">
Add New Image
</button>

</form>

</div>

<div class="grid admin-grid">

<?php if (count($images) > 0): ?>

<?php foreach ($images as $img): ?>

<div class="card">

<img
    src="../<?= htmlspecialchars($img["image_path"]) ?>"
    alt="Gallery Image"
    class="admin-card-img"
>

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

<p>No images uploaded yet.</p>

<?php endif; ?>

</div>

</div>
</section>

<?php endforeach; ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>