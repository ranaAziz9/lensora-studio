
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

          

        </div>

    </div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>

