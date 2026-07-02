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
// Include authentication system for access control
require_once '../includes/auth.php';

// Ensure only admin users can access this page
checkAdmin();

// Include database connection
require_once "../includes/db.php";

// Fetch all services from database ordered by newest first
$stmt = $pdo->query("SELECT * FROM services ORDER BY id DESC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Page title -->
<title>Manage Services | Lensora Studio</title>

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
<h1>Manage Services</h1>
<p>Add, edit, and delete photography services.</p>
</div>
</section>

<!-- Main content section -->
<section class="section-alt">
<div class="container">

<!-- Section header -->
<div class="section-header">
<h2>Services Management</h2>
<div class="accent-line"></div>
</div>

<!-- Service form -->
<div class="form-card">

<h3 id="service-form-title">Add New Service</h3>

<!-- Hidden field for service ID (used in edit mode) -->
<input type="hidden" id="service_id">

<!-- Service title input -->
<input id="service_title" class="input" placeholder="Service Title">

<!-- Service price input -->
<input id="service_price" class="input" placeholder="Price">

<!-- Service description input -->
<textarea id="service_description" class="input" placeholder="Description"></textarea>

<!-- Form action buttons -->
<div class="admin-form-actions">

<!-- Save service (add or update) -->
<button type="button" class="btn btn-primary" onclick="saveService()">Save</button>

<!-- Reset form fields -->
<button type="button" class="btn btn-secondary" onclick="resetServiceForm()">Reset</button>

</div>

</div>

<!-- Services grid display -->
<div class="grid admin-grid">

<?php if (count($services) > 0): ?>

<!-- Loop through all services -->
<?php foreach ($services as $service): ?>

<div class="card">

<!-- Service image (if exists) -->
<?php if (!empty($service["image"])): ?>
<img
src="../<?= htmlspecialchars($service["image"]) ?>"
alt="Service Image"
class="admin-card-img"
>
<?php endif; ?>

<!-- Service title -->
<h3 class="card-title">
<?= htmlspecialchars($service["title"]) ?>
</h3>

<!-- Service description -->
<p class="card-text">
<?= htmlspecialchars($service["description"]) ?>
</p>

<!-- Service price -->
<p class="card-price">
$<?= htmlspecialchars($service["price"]) ?>
</p>

<!-- Card action buttons -->
<div class="admin-card-actions">

<!-- Edit service button with data attributes -->
<button
type="button"
class="btn btn-secondary edit-service-btn"
data-id="<?= htmlspecialchars($service["id"], ENT_QUOTES) ?>"
data-title="<?= htmlspecialchars($service["title"], ENT_QUOTES) ?>"
data-description="<?= htmlspecialchars($service["description"], ENT_QUOTES) ?>"
data-price="<?= htmlspecialchars($service["price"], ENT_QUOTES) ?>"
>
Edit
</button>

<!-- Delete service button -->
<button
type="button"
class="btn btn-dark delete-service-btn"
data-id="<?= htmlspecialchars($service["id"], ENT_QUOTES) ?>"
>
Delete
</button>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<!-- No services fallback message -->
<p>No services found.</p>

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