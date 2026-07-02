<!DOCTYPE html>
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
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Page title for browser tab -->
<title>Service Packages | Lensora Studio</title>

<!-- Global stylesheet -->
<link rel="stylesheet" href="../global/main.css">
</head>

<body>

<!-- Skip link for accessibility (keyboard navigation) -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Font Awesome icons library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Header navigation component -->
<?php include '../includes/header_nav.php'; ?>

<main class="main-content">

<!-- ================= HERO SECTION ================= -->
<section class="hero hero-compact">
<div class="container">

<!-- Page heading -->
<h1>Service Packages</h1>

<!-- Short description -->
<p>Choose your package and book instantly</p>

</div>
</section>

<!-- ================= SEARCH SECTION (AJAX FEATURE) ================= -->
<section class="section-alt">
<div class="container">

<!-- Search card -->
<div class="form-card">

<h3>Search Packages (Live)</h3>

<!-- Live search input (used in JS for filtering packages) -->
<input type="text" id="search" class="input" placeholder="Search packages...">

</div>

<!-- Section title -->
<div class="section-header">
<h2>Available Packages</h2>
<div class="accent-line"></div>
</div>

<!-- AJAX dynamic output container (filled by main.js) -->
<ol class="package-grid" id="packages-container"></ol>

</div>
</section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
<div class="container">
<p>&copy; 2026 Lensora Studio</p>
</div>
</footer>

<!-- Main JavaScript file -->
<script src="../scripts/main.js"></script>

</body>
</html>