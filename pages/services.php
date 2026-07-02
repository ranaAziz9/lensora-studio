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
// Fetch all services from database for display on Services page
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM services ORDER BY id DESC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Responsive design setup -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Services | Lensora Studio</title>

    <!-- Global stylesheet -->
    <link rel="stylesheet" href="../global/main.css">
</head>

<body>

<!-- Skip link for accessibility -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Header navigation -->
<?php include '../includes/header_nav.php'; ?>

<main class="main-content">

<!-- ================= HERO SECTION ================= -->
<section class="hero hero-compact">
    <div class="container">
        <h1>Photography Services</h1>
        <p>Packages, pricing and offers</p>
    </div>
</section>

<!-- ================= FILTER BUTTONS ================= -->
<section style="padding: 20px 0;">
    <div class="container">

        <!-- Open filter panel -->
        <button onclick="toggleFilters()" class="btn btn-primary" style="
            padding: 12px 18px;
            border-radius: 10px;
            background: #111;
            color: #fff;
            border: none;
            cursor: pointer;
        ">
            🔍 Filter Services
        </button>

        <!-- Reset filters -->
        <button onclick="resetFilters()" class="btn btn-secondary" style="
            padding: 12px 18px;
            border-radius: 10px;
            margin-left: 10px;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
        ">
            Reset
        </button>

    </div>
</section>

<!-- ================= FILTER PANEL (AJAX SEARCH) ================= -->
<section id="filterPanel" style="display: none; padding: 20px 0 40px; background: #fdfdfd; border-bottom: 1px solid #f0f0f0;">
<div class="container">

<div class="form-card" style="
    background: #ffffff;
    border: 1px solid #eaeaea;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    max-width: 750px;
    margin: 0 auto;
">

    <!-- Filter section title -->
    <h3>Filter Studio Services</h3>

    <div style="
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 16px;
        align-items: end;
    ">

        <!-- Keyword search -->
        <div style="display: flex; flex-direction: column;">
            <label>Keywords</label>
            <input type="text" id="search" class="input" placeholder="e.g., Portrait, Wedding...">
        </div>

        <!-- Minimum price -->
        <div style="display: flex; flex-direction: column;">
            <label>Min Price ($)</label>
            <input type="number" id="minPrice" class="input" placeholder="0">
        </div>

        <!-- Maximum price -->
        <div style="display: flex; flex-direction: column;">
            <label>Max Price ($)</label>
            <input type="number" id="maxPrice" class="input" placeholder="1000">
        </div>

    </div>

    <!-- Apply filters button -->
    <button class="btn btn-primary btn-full" onclick="filterServices()">
        Apply Filters
    </button>

</div>

</div>
</section>

<!-- ================= SERVICES LIST ================= -->
<section>
<div class="container">

<div class="services-grid" id="servicesGrid">

<?php if (!empty($services)): ?>

    <!-- Loop through services from database -->
    <?php foreach ($services as $s): ?>
        <div class="service-card">

            <!-- Service info -->
            <div>
                <h3><?= htmlspecialchars($s['title']) ?></h3>

                <!-- Optional service image -->
                <?php if (!empty($s['image'])): ?>
                    <img src="../<?= htmlspecialchars($s['image']) ?>" alt="">
                <?php endif; ?>

                <!-- Description -->
                <p><?= htmlspecialchars($s['description']) ?></p>
            </div>

            <!-- Price + action -->
            <div>
                <p class="price">
                    Starting from <strong>$<?= htmlspecialchars($s['price']) ?></strong>
                </p>

                <!-- Redirect to packages page -->
                <a href="packages.php?service=<?= urlencode($s['title']) ?>"
                   class="btn btn-primary btn-full">
                   Choose Package
                </a>
            </div>

        </div>
    <?php endforeach; ?>

<?php else: ?>

    <!-- Empty state -->
    <p style="grid-column: 1/-1; text-align: center; color: #777;">
        No services available.
    </p>

<?php endif; ?>

</div>

</div>
</section>

</main>

<!-- ================= FOOTER ================= -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Main JavaScript -->
<script src="../scripts/main.js"></script>

</body>
</html>