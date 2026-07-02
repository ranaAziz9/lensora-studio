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
// Include authentication system to control access permissions
require_once '../includes/auth.php';

// Ensure only admin users can access this page
checkAdmin();

// Include database connection file
require_once "../includes/db.php";

// Fetch all videos from database ordered by newest first
$stmt = $pdo->query("
    SELECT *
    FROM site_videos
    ORDER BY id DESC
");

// Store all fetched videos
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Page title -->
<title>Manage Videos | Lensora Studio</title>

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
<h1>Manage Videos</h1>
<p>Upload and delete website videos.</p>
</div>
</section>

<!-- Main content section -->
<section class="section-alt">

<div class="container">

<!-- Section header -->
<div class="section-header">
<h2>Videos Management</h2>
<div class="accent-line"></div>
</div>

<!-- Upload form -->
<div class="form-card">

<form action="upload-video.php" method="POST" enctype="multipart/form-data">

<!-- Video file input -->
<input
type="file"
name="video"
class="input"
accept=".mp4,.webm,.ogg"
required
>

<!-- Upload button -->
<button type="submit" class="btn btn-primary btn-full">
Upload Video
</button>

</form>

</div>

<!-- Videos display section -->
<div class="admin-video-grid">

<?php if(count($videos) > 0): ?>

<!-- Loop through videos -->
<?php foreach($videos as $video): ?>

<div class="admin-video-card">

<!-- Video container -->
<div class="admin-video-box">

<video controls preload="metadata">

<!-- Video source file -->
<source
src="../<?= htmlspecialchars($video['video_path']) ?>"
type="video/mp4"
>

Your browser does not support video.

</video>

</div>

<!-- Delete video button -->
<a
href="delete-video.php?id=<?= $video['id'] ?>"
class="btn btn-dark btn-full"
onclick="return confirm('Delete this video?')"
>
Delete
</a>

</div>

<?php endforeach; ?>

<?php else: ?>

<!-- No videos message -->
<p>No videos uploaded yet.</p>

<?php endif; ?>

</div>

</div>

</section>

</main>

<!-- Footer include -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Main JavaScript file -->
<script src="../scripts/main.js"></script>

</body>
</html>