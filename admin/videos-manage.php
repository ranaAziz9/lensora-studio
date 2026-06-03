<?php
require_once '../includes/auth.php';
checkAdmin();
require_once "../includes/db.php";

$stmt = $pdo->query("
    SELECT *
    FROM site_videos
    ORDER BY id DESC
");

$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Videos | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Videos</h1>
<p>Upload and delete website videos.</p>
</div>
</section>

<section class="section-alt">

<div class="container">

<div class="section-header">
<h2>Videos Management</h2>
<div class="accent-line"></div>
</div>

<!-- Upload Form -->

<div class="form-card">

<form action="upload-video.php" method="POST" enctype="multipart/form-data">

<input
type="file"
name="video"
class="input"
accept=".mp4,.webm,.ogg"
required
>

<button type="submit" class="btn btn-primary btn-full">
Upload Video
</button>

</form>

</div>

<!-- Videos -->

<div class="admin-video-grid">

<?php if(count($videos) > 0): ?>

<?php foreach($videos as $video): ?>

<div class="admin-video-card">

<div class="admin-video-box">

<video controls preload="metadata">

<source
src="../<?= htmlspecialchars($video['video_path']) ?>"
type="video/mp4"
>

Your browser does not support video.

</video>

</div>

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

<p>No videos uploaded yet.</p>

<?php endif; ?>

</div>

</div>

</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>