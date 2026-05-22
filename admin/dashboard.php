<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Lensora Studio</title>
  <link rel="stylesheet" href="../global/main.css">
</head>


<body>
  <header class="site-header">
    <nav class="site-nav">
      <div class="container nav-container">
        <a href="../index.html" class="nav-logo">
          <img src="../images/logo.png" alt="Lensora Studio logo">
        </a>

        <ul class="nav-links">

  <li>
    <a href="dashboard.php" class="active">
      Dashboard
    </a>
  </li>

  <li>
    <a href="users.php">
      Users
    </a>
  </li>

  <li>
    <a href="../index.php">
      View Website
    </a>
  </li>

  <li>
    <a href="../logout.php">
      Logout
    </a>
  </li>

</ul>
      </div>
    </nav>
  </header>

  <main class="main-content">
    <section class="hero hero-compact">
      <div class="container">
        <h1>Dashboard</h1>
        <p>Manage Lensora Studio content, bookings, and client feedback.</p>
      </div>
    </section>

    <section class="section-alt">
      <div class="container">
        <div class="section-header">
          <h2>Manage Services</h2>
          <div class="accent-line"></div>
        </div>

        <div class="text-center mb-4">
          <button class="btn btn-primary">Add New Service</button>
        </div>

        <div class="services-grid">
          <div class="service-card">
            <h3>Portrait Photography</h3>
            <p>Headshots, families, and personal branding.</p>
            <p class="price">Starting from <strong>$199</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="service-card">
            <h3>Graduation Photography</h3>
            <p>Caps, gowns, and celebration shots.</p>
            <p class="price">Starting from <strong>$299</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="service-card">
            <h3>Product Photography</h3>
            <p>Clean catalog images and hero shots.</p>
            <p class="price">Starting from <strong>$149</strong></p>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-header">
          <h2>Manage Packages</h2>
          <div class="accent-line"></div>
        </div>

        <div class="text-center mb-4">
          <button class="btn btn-primary">Add New Package</button>
        </div>

        <div class="package-grid">
          <div class="package-card">
            <h3>Basic Package</h3>
            <p class="price">$199</p>
            <ul class="pkg-list">
              <li>1-hour session</li>
              <li>50+ edited photos</li>
              <li>Digital copies</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="package-card">
            <h3>Standard Package</h3>
            <p class="price">$349</p>
            <ul class="pkg-list">
              <li>2-hour session</li>
              <li>100+ edited photos</li>
              <li>Digital + USB</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>

          <div class="package-card">
            <h3>Premium Package</h3>
            <p class="price">$599</p>
            <ul class="pkg-list">
              <li>4-hour session</li>
              <li>200+ edited photos</li>
              <li>Album included</li>
            </ul>
            <button class="btn btn-secondary btn-full">Edit</button>
            <button class="btn btn-dark btn-full">Delete</button>
          </div>
        </div>
      </div>
    </section>

    <section class="section-alt">
  <div class="container">
    <div class="section-header">
      <h2>Manage Gallery</h2>
      <div class="accent-line"></div>
    </div>

    <div class="category-grid">
      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-portrait">
          <img src="../images/1-work.webp" alt="Portrait category">
        </a>
        <h3>Portrait</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-events">
          <img src="../images/2-work.webp" alt="Events category">
        </a>
        <h3>Events</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-wedding">
          <img src="../images/3-work.webp" alt="Wedding category">
        </a>
        <h3>Wedding</h3>
      </div>

      <div class="category-card">
        <a href="#" class="admin-gallery-link" data-target="admin-product">
          <img src="../images/4-work.jpeg" alt="Product category">
        </a>
        <h3>Product</h3>
      </div>
    </div>
  </div>
</section>

<section id="admin-portrait" class="gallery-section hidden">
  <div class="container">
    <h2 class="section-title">Portrait Photography</h2>

    <div class="text-center mb-4">
      <button class="btn btn-primary">Add New Image</button>
    </div>

    <div class="gallery-grid">
      <div>
        <img src="../images/5-work.jpeg" alt="Portrait example 1">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/6-work.jpeg" alt="Portrait example 2">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/7-work.jpeg" alt="Portrait example 3">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/8-work.jpeg" alt="Portrait example 4">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
    </div>
  </div>
</section>

<section id="admin-events" class="gallery-section hidden">
  <div class="container">
    <h2 class="section-title">Event Photography</h2>

    <div class="text-center mb-4">
      <button class="btn btn-primary">Add New Image</button>
    </div>

    <div class="gallery-grid">
      <div>
        <img src="../images/9-work.jpeg" alt="Event example 1">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/10-work.jpeg" alt="Event example 2">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/11-work.jpeg" alt="Event example 3">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/12-work.jpeg" alt="Event example 4">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
    </div>
  </div>
</section>

<section id="admin-wedding" class="gallery-section hidden">
  <div class="container">
    <h2 class="section-title">Wedding Photography</h2>

    <div class="text-center mb-4">
      <button class="btn btn-primary">Add New Image</button>
    </div>

    <div class="gallery-grid">
      <div>
        <img src="../images/13-work.jpeg" alt="Wedding example 1">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/14-work.jpeg" alt="Wedding example 2">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/15-work.jpeg" alt="Wedding example 3">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/16-work.jpeg" alt="Wedding example 4">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
    </div>
  </div>
</section>

<section id="admin-product" class="gallery-section hidden">
  <div class="container">
    <h2 class="section-title">Product Photography</h2>

    <div class="text-center mb-4">
      <button class="btn btn-primary">Add New Image</button>
    </div>

    <div class="gallery-grid">
      <div>
        <img src="../images/17-work.jpeg" alt="Product example 1">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/18-work.jpeg" alt="Product example 2">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/19-work.jpeg" alt="Product example 3">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
      <div>
        <img src="../images/20-work.jpeg" alt="Product example 4">
        <button class="btn btn-dark btn-full">Delete</button>
      </div>
    </div>
  </div>
</section>

    <section>
      <div class="container">
        <div class="section-header">
          <h2>View Feedback</h2>
          <div class="accent-line"></div>
        </div>

        <div class="form-panel">
          <table class="booking-table">
            <thead>
              <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Feedback</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Sarah Ahmed</td>
                <td>sarah@example.com</td>
                <td>Great photography service.</td>
                <td>
                  <button class="btn btn-secondary">Edit</button>
                  <button class="btn btn-dark">Delete</button>
                </td>
              </tr>

              <tr>
                <td>Mohammed Ali</td>
                <td>mohammed@example.com</td>
                <td>Professional and friendly team.</td>
                <td>
                  <button class="btn btn-secondary">Edit</button>
                  <button class="btn btn-dark">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-bottom">
        <p>&copy; 2026 Lensora Studio. Admin Panel.</p>
      </div>
    </div>
  </footer>

  <script>
  const adminLinks = document.querySelectorAll('.admin-gallery-link');
  const adminSections = document.querySelectorAll('.gallery-section');

  adminLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      adminSections.forEach(section => section.classList.add('hidden'));

      const target = document.getElementById(link.dataset.target);
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });
</script>
</body>
</html>