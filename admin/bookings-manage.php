
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
require_once '../includes/auth.php';
// Restricts access to administrators only and redirects unauthorized users.
checkAdmin();
// Connect to the database.
require_once "../includes/db.php";

// Retrieve all bookings from the database and sort them by latest first.
$stmt = $pdo->query("SELECT * FROM bookings ORDER BY id DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Bookings | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>


<!-- Include the shared navigation header -->
<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Bookings</h1>
<p>Approve, reject, and delete customer bookings.</p>
</div>
</section>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2>Bookings Management</h2>
<div class="accent-line"></div>
</div>
<!-- Booking status filter buttons -->
<div class="booking-filter-actions">
<button type="button" class="btn btn-primary booking-filter-btn" data-status="all">All</button>
<button type="button" class="btn btn-secondary booking-filter-btn" data-status="pending">Pending</button>
<button type="button" class="btn btn-secondary booking-filter-btn" data-status="approved">Approved</button>
<button type="button" class="btn btn-dark booking-filter-btn" data-status="rejected">Rejected</button>
</div>

<div class="grid admin-grid">

<!-- Check if there are any bookings to display -->
<?php if (count($bookings) > 0): ?>
<!-- Loop through all bookings and display their details -->
    <?php foreach ($bookings as $booking): ?>

<div
class="card booking-card"
data-status="<?= htmlspecialchars($booking["status"], ENT_QUOTES) ?>"
>

<h3 class="card-title">
<?= htmlspecialchars($booking["name"]) ?>
</h3>

<p class="card-text">
<strong>Email:</strong> <?= htmlspecialchars($booking["email"]) ?>
</p>

<p class="card-text">
<strong>Package:</strong> <?= htmlspecialchars($booking["package"]) ?>
</p>

<p class="card-text">
<strong>Date:</strong> <?= htmlspecialchars($booking["booking_date"]) ?>
</p>

<p class="card-text">
<strong>Time:</strong> <?= htmlspecialchars($booking["booking_time"]) ?>
</p>
<!-- Display the current booking status -->
<p class="booking-status booking-status-<?= htmlspecialchars($booking["status"]) ?>">
Status: <?= htmlspecialchars($booking["status"]) ?>
</p>

<div class="admin-card-actions booking-actions">
<!-- Button to approve a booking -->
<button
type="button"
class="btn btn-primary update-booking-btn"
data-id="<?= htmlspecialchars($booking["id"], ENT_QUOTES) ?>"
data-status="approved"
>
Approve
</button>

<!-- Button to reject a booking -->
<button
type="button"
class="btn btn-dark update-booking-btn"
data-id="<?= htmlspecialchars($booking["id"], ENT_QUOTES) ?>"
data-status="rejected"
>
Reject
</button>

</div>
<!-- Button to permanently delete a booking -->
<button
type="button"
class="btn btn-dark btn-full delete-booking-btn"
data-id="<?= htmlspecialchars($booking["id"], ENT_QUOTES) ?>"
>
Delete
</button>

</div>

<?php endforeach; ?>
<!-- Display a message when no bookings are available -->
<?php else: ?>

<p>No bookings found.</p>

<?php endif; ?>

</div>

</div>
</section>

</main>
<!-- Include the shared footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
<!-- Load JavaScript for booking actions and page interactions -->
<script src="../scripts/main.js"></script>

</body>
</html>