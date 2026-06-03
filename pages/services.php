<?php
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM services ORDER BY id DESC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Lensora Studio</title>
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
        <h1>Photography Services</h1>
        <p>Packages, pricing and offers</p>
    </div>
</section>

<section style="padding: 20px 0;">
    <div class="container">

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

    <h3 style="
        margin: 0 0 24px 0; 
        font-size: 1.3rem; 
        font-weight: 600; 
        color: #111111; 
        letter-spacing: -0.3px;
    ">Filter Studio Services</h3>

    <div style="
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 16px;
        align-items: end;
    ">

        <div style="display: flex; flex-direction: column;">
            <label style="font-size: 0.8rem; font-weight: 600; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Keywords</label>
            <input type="text" id="search" class="input" placeholder="e.g., Portrait, Wedding..." style="
                width: 100%; 
                box-sizing: border-box; 
                padding: 14px 16px; 
                border: 1px solid #dcdcdc; 
                border-radius: 10px; 
                background: #fafafa;
                font-size: 0.95rem; 
                color: #111;
                outline: none;
                transition: all 0.2s ease;
            " onfocus="this.style.borderColor='#111'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(0,0,0,0.02)';" onblur="this.style.borderColor='#dcdcdc'; this.style.background='#fafafa'; this.style.boxShadow='none';">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label style="font-size: 0.8rem; font-weight: 600; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Min Price ($)</label>
            <input type="number" id="minPrice" class="input" placeholder="0" style="
                width: 100%; 
                box-sizing: border-box; 
                padding: 14px 16px; 
                border: 1px solid #dcdcdc; 
                border-radius: 10px; 
                background: #fafafa;
                font-size: 0.95rem; 
                color: #111;
                outline: none;
                transition: all 0.2s ease;
            " onfocus="this.style.borderColor='#111'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(0,0,0,0.02)';" onblur="this.style.borderColor='#dcdcdc'; this.style.background='#fafafa'; this.style.boxShadow='none';">
        </div>

        <div style="display: flex; flex-direction: column;">
            <label style="font-size: 0.8rem; font-weight: 600; color: #666666; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Max Price ($)</label>
            <input type="number" id="maxPrice" class="input" placeholder="1000" style="
                width: 100%; 
                box-sizing: border-box; 
                padding: 14px 16px; 
                border: 1px solid #dcdcdc; 
                border-radius: 10px; 
                background: #fafafa;
                font-size: 0.95rem; 
                color: #111;
                outline: none;
                transition: all 0.2s ease;
            " onfocus="this.style.borderColor='#111'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(0,0,0,0.02)';" onblur="this.style.borderColor='#dcdcdc'; this.style.background='#fafafa'; this.style.boxShadow='none';">
        </div>

    </div>

    <button class="btn btn-primary btn-full" style="
        margin-top: 24px; 
        width: 100%; 
        padding: 14px; 
        border: none; 
        background: #111111; 
        color: #ffffff; 
        border-radius: 10px; 
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s ease;
    " onclick="filterServices()" onmouseover="this.style.background='#222222';" onmouseout="this.style.background='#111111';">
        Apply Filters
    </button>

</div>

</div>
</section>

<section>
<div class="container">

<div class="services-grid" id="servicesGrid">

<?php if (!empty($services)): ?>
    <?php foreach ($services as $s): ?>
        <div class="service-card">
            <div>
                <h3><?= htmlspecialchars($s['title']) ?></h3>

                <?php if (!empty($s['image'])): ?>
                    <img src="../<?= htmlspecialchars($s['image']) ?>" alt="">
                <?php endif; ?>

                <p><?= htmlspecialchars($s['description']) ?></p>
            </div>

            <div>
                <p class="price">
                    Starting from <strong>$<?= htmlspecialchars($s['price']) ?></strong>
                </p>

                <a href="packages.php?service=<?= urlencode($s['title']) ?>"
                   class="btn btn-primary btn-full">
                   Choose Package
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="grid-column: 1/-1; text-align: center; color: #777;">No services available.</p>
<?php endif; ?>

</div>

</div>
</section>

</main>
<!-- ================= footer ================= -->
<?php include __DIR__ . '/../includes/footer.php'; ?>
<!-- ================= JS ================= -->
<script>

document.getElementById("search").addEventListener("input", filterServices);

function filterServices() {

    const search = document.getElementById("search").value;
    const min = document.getElementById("minPrice").value || 0;
    const max = document.getElementById("maxPrice").value || 999999;

    fetch(`../api/search-service.php?search=${encodeURIComponent(search)}&min=${min}&max=${max}`)
        .then(res => res.json())
        .then(res => {

            const container = document.getElementById("servicesGrid");

            if (!res || !res.data) {
                container.innerHTML = "<p>Error loading services</p>";
                return;
            }

            if (res.data.length === 0) {
                container.innerHTML = "<p>No services found</p>";
                return;
            }

            let html = "";

            res.data.forEach(s => {
                html += `
                    <div class="service-card">

                        <h3>${s.title}</h3>

                        ${s.image ? `<img src="../${s.image}" alt="">` : ""}

                        <p>${s.description}</p>

                        <p class="price">
                            Starting from <strong>$${s.price}</strong>
                        </p>

                        <a href="packages.php?service=${encodeURIComponent(s.title)}"
                           class="btn btn-primary btn-full">
                           Choose Package
                        </a>

                    </div>
                `;
            });

            container.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            document.getElementById("servicesGrid").innerHTML =
                "<p>Error loading services</p>";
        });
}

function toggleFilters() {
    const panel = document.getElementById("filterPanel");

    if (panel.style.display === "none" || panel.style.display === "") {
        panel.style.display = "block";
    } else {
        panel.style.display = "none";
    }
}

function resetFilters() {
    document.getElementById("search").value = "";
    document.getElementById("minPrice").value = "";
    document.getElementById("maxPrice").value = "";

    filterServices(); // reload all services
}

</script>

</body>
</html>