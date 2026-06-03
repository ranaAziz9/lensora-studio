<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Packages | Lensora Studio</title>
<link rel="stylesheet" href="../global/main.css">
</head>

<body>
<a href="#main-content" class="skip-link">Skip to main content</a>
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <!-- Header_nav -->
<?php include '../includes/header_nav.php'; ?>

<main class="main-content">

<!-- HERO -->
<section class="hero hero-compact">
<div class="container">
<h1>Service Packages</h1>
<p>Choose your package and book instantly</p>
</div>
</section>

<!-- SEARCH (AJAX REQUIREMENT) -->
<section class="section-alt">
<div class="container">

<div class="form-card">

<h3>Search Packages (Live)</h3>

<input type="text" id="search" class="input" placeholder="Search packages...">

</div>

<div class="section-header">
<h2>Available Packages</h2>
<div class="accent-line"></div>
</div>

<!-- AJAX OUTPUT -->
<ol class="package-grid" id="packages-container"></ol>

</div>
</section>

</main>

<footer class="site-footer">
<div class="container">
<p>&copy; 2026 Lensora Studio</p>
</div>
</footer>

<!-- ================= AJAX + REST API ================= -->
<script>

let allPackages = [];

// 1. LOAD FROM API (REQUIRED)
fetch("../api/get-package.php")
.then(res => res.json())
.then(data => {

    if (data.status === "success") {
        allPackages = data.data;
        render(allPackages);
    } else {
        document.getElementById("packages-container").innerHTML =
            "<p>Failed to load packages</p>";
    }
})
.catch(() => {
    document.getElementById("packages-container").innerHTML =
        "<p>Server error</p>";
});

// 2. RENDER FUNCTION
function render(packages) {

    const container = document.getElementById("packages-container");

    if (!packages.length) {
        container.innerHTML = "<p>No packages found</p>";
        return;
    }

    container.innerHTML = packages.map(pkg => `
        <li class="package-card">

            <h3>${pkg.package_name}</h3>

            <p class="price">$${pkg.price}</p>

            <ul class="pkg-list">
                <li>${pkg.description}</li>
            </ul>

            <a href="schedule.php?package=${pkg.slug}"
               class="btn btn-primary btn-full">
               Book Now
            </a>

        </li>
    `).join("");
}

// 3. LIVE SEARCH (AJAX REQUIREMENT)
document.getElementById("search").addEventListener("input", (e) => {

    const keyword = e.target.value.toLowerCase();

    const filtered = allPackages.filter(pkg =>
        pkg.package_name.toLowerCase().includes(keyword)
    );

    render(filtered);
});

</script>

</body>
</html>