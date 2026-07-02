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
// Include authentication file to handle user access control
require_once '../includes/auth.php';

// Ensure only admin users can access this page
checkAdmin();

// Include database connection file
require_once "../includes/db.php";

// Fetch all packages from the database ordered by newest first
$stmt = $pdo->query("SELECT * FROM packages ORDER BY id DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Page title -->
<title>Manage Packages | Lensora Studio</title>

<!-- Main CSS file -->
<link rel="stylesheet" href="../global/main.css">

<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<!-- Skip link for accessibility -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Include header/navigation -->
<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<!-- Hero section -->
<section class="hero hero-compact">
<div class="container">
<h1>Manage Packages</h1>
<p>Add and delete booking packages.</p>
</div>
</section>

<!-- Main content section -->
<section class="section-alt">
<div class="container">

<!-- Section header -->
<div class="section-header">
<h2>Packages Management</h2>
<div class="accent-line"></div>
</div>

<!-- Add new package form -->
<div class="form-card">

<h3>Add Package</h3>

<!-- Package name input -->
<input id="pkg_name" class="input" placeholder="Package Name">

<!-- Package price input -->
<input id="pkg_price" class="input" placeholder="Price">

<!-- Package slug input -->
<input id="pkg_slug" class="input" placeholder="Slug">

<!-- Package description input -->
<textarea id="pkg_desc" class="input" placeholder="Description"></textarea>

<!-- Add package button -->
<button type="button" class="btn btn-primary btn-full" onclick="addPackage()">
Add Package
</button>

</div>

<!-- Packages grid -->
<div class="grid admin-grid">

<?php if (count($packages) > 0): ?>

<!-- Loop through all packages -->
<?php foreach ($packages as $pkg): ?>

<div class="card">

<!-- Package name -->
<h3 class="card-title">
<?= htmlspecialchars($pkg["package_name"]) ?>
</h3>

<!-- Package price -->
<p class="card-price">
$<?= htmlspecialchars($pkg["price"]) ?>
</p>

<!-- Package description -->
<p class="card-text">
<?= htmlspecialchars($pkg["description"]) ?>
</p>

<!-- Optional slug display -->
<?php if (!empty($pkg["slug"])): ?>
<p class="card-text">
Slug: <?= htmlspecialchars($pkg["slug"]) ?>
</p>
<?php endif; ?>

<!-- Delete package button -->
<button
type="button"
class="btn btn-dark btn-full delete-package-btn"
data-id="<?= htmlspecialchars($pkg["id"], ENT_QUOTES) ?>"
>
Delete
</button>

</div>

<?php endforeach; ?>

<?php else: ?>

<!-- No packages message -->
<p>No packages found.</p>

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