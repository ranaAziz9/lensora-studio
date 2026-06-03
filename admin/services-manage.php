<?php
require_once '../includes/auth.php';
checkAdmin();
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM services ORDER BY id DESC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Services | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Services</h1>
<p>Add, edit, and delete photography services.</p>
</div>
</section>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2>Services Management</h2>
<div class="accent-line"></div>
</div>

<div class="form-card">

<h3 id="service-form-title">Add New Service</h3>

<input type="hidden" id="service_id">

<input id="service_title" class="input" placeholder="Service Title">
<input id="service_price" class="input" placeholder="Price">
<textarea id="service_description" class="input" placeholder="Description"></textarea>

<div class="admin-form-actions">
<button type="button" class="btn btn-primary" onclick="saveService()">Save</button>
<button type="button" class="btn btn-secondary" onclick="resetServiceForm()">Reset</button>
</div>

</div>

<div class="grid admin-grid">

<?php if (count($services) > 0): ?>

<?php foreach ($services as $service): ?>

<div class="card">

<?php if (!empty($service["image"])): ?>
<img
src="../<?= htmlspecialchars($service["image"]) ?>"
alt="Service Image"
class="admin-card-img"
>
<?php endif; ?>

<h3 class="card-title">
<?= htmlspecialchars($service["title"]) ?>
</h3>

<p class="card-text">
<?= htmlspecialchars($service["description"]) ?>
</p>

<p class="card-price">
$<?= htmlspecialchars($service["price"]) ?>
</p>

<div class="admin-card-actions">

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

<p>No services found.</p>

<?php endif; ?>

</div>

</div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>