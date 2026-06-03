<?php
require_once '../includes/auth.php';
checkAdmin();
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM packages ORDER BY id DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Packages | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Packages</h1>
<p>Add and delete booking packages.</p>
</div>
</section>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2>Packages Management</h2>
<div class="accent-line"></div>
</div>

<div class="form-card">

<h3>Add Package</h3>

<input id="pkg_name" class="input" placeholder="Package Name">
<input id="pkg_price" class="input" placeholder="Price">
<input id="pkg_slug" class="input" placeholder="Slug">
<textarea id="pkg_desc" class="input" placeholder="Description"></textarea>

<button type="button" class="btn btn-primary btn-full" onclick="addPackage()">
Add Package
</button>

</div>

<div class="grid admin-grid">

<?php if (count($packages) > 0): ?>

<?php foreach ($packages as $pkg): ?>

<div class="card">

<h3 class="card-title">
<?= htmlspecialchars($pkg["package_name"]) ?>
</h3>

<p class="card-price">
$<?= htmlspecialchars($pkg["price"]) ?>
</p>

<p class="card-text">
<?= htmlspecialchars($pkg["description"]) ?>
</p>

<?php if (!empty($pkg["slug"])): ?>
<p class="card-text">
Slug: <?= htmlspecialchars($pkg["slug"]) ?>
</p>
<?php endif; ?>

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

<p>No packages found.</p>

<?php endif; ?>

</div>

</div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>