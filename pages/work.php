<!DOCTYPE html>
<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206250
  Section: DAR
  Date: 2/4/2026
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Work | Lensora Studio</title>
    <link rel="stylesheet" href="../global/main.css">
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header: primary navigation -->
    <header class="site-header">
        <nav class="site-nav" aria-label="Primary navigation">
            <div class="container nav-container">
                <a href="../index.php" class="nav-logo">
                    <img src="../images/logo.png" alt="Lensora Studio logo">
                </a>
                <ul class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="work.php" class="active">Our Work</a></li>
                    <li><a href="video.php">Video</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="pages/auth.php" style="background: #000; color: #fff; padding: 6px 15px; border-radius: 20px;">Login / Register</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main id="main-content" class="main-content">
        <!-- Hero section: work page introduction -->
        <section class="hero hero-compact" aria-labelledby="work-heading">
            <div class="container">
                <h1 id="work-heading">Our Work</h1>
                <p>Explore our photography galleries by category.</p>
            </div>
        </section>

        <!-- Categories section: gallery categories -->
        <section aria-labelledby="categories-heading">
            <div class="container">
                <h2 id="categories-heading">Gallery Categories</h2>

                <div class="category-grid">
                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="portrait">
                            <img src="../images/1-work.webp" alt="Portrait category">
                        </a>
                        <h3>Portrait</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="events">
                            <img src="../images/2-work.webp" alt="Events category">
                        </a>
                        <h3>Events</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="wedding">
                            <img src="../images/3-work.webp" alt="Wedding category">
                        </a>
                        <h3>Wedding</h3>
                    </div>

                    <div class="category-card">
                        <a href="#" class="gallery-link" data-target="product">
                            <img src="../images/4-work.jpeg" alt="Product category">
                        </a>
                        <h3>Product</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portrait gallery section -->
        <section id="portrait" class="gallery-section hidden" aria-labelledby="portrait-heading">
            <div class="container">
                <h2 id="portrait-heading" class="section-title">Portrait Photography</h2>
                <div class="gallery-grid">
                    <img src="../images/5-work.jpeg" alt="Portrait example 1">
                    <img src="../images/6-work.jpeg" alt="Portrait example 2">
                    <img src="../images/7-work.jpeg" alt="Portrait example 3">
                    <img src="../images/8-work.jpeg" alt="Portrait example 4">
                </div>
            </div>
        </section>

        <!-- Events gallery section -->
        <section id="events" class="gallery-section hidden" aria-labelledby="events-heading">
            <div class="container">
                <h2 id="events-heading" class="section-title">Event Photography</h2>
                <div class="gallery-grid">
                    <img src="../images/9-work.jpeg" alt="Event example 1">
                    <img src="../images/10-work.jpeg" alt="Event example 2">
                    <img src="../images/11-work.jpeg" alt="Event example 3">
                    <img src="../images/12-work.jpeg" alt="Event example 4">
                </div>
            </div>
        </section>

        <!-- Wedding gallery section -->
        <section id="wedding" class="gallery-section hidden" aria-labelledby="wedding-heading">
            <div class="container">
                <h2 id="wedding-heading" class="section-title">Wedding Photography</h2>
                <div class="gallery-grid">
                    <img src="../images/13-work.jpeg" alt="Wedding example 1">
                    <img src="../images/14-work.jpeg" alt="Wedding example 2">
                    <img src="../images/15-work.jpeg" alt="Wedding example 3">
                    <img src="../images/16-work.jpeg" alt="Wedding example 4">
                </div>
            </div>
        </section>

        <!-- Product gallery section -->
        <section id="product" class="gallery-section hidden" aria-labelledby="product-heading">
            <div class="container">
                <h2 id="product-heading" class="section-title">Product Photography</h2>
                <div class="gallery-grid">
                    <img src="../images/17-work.jpeg" alt="Product example 1">
                    <img src="../images/18-work.jpeg" alt="Product example 2">
                    <img src="../images/19-work.jpeg" alt="Product example 3">
                    <img src="../images/20-work.jpeg" alt="Product example 4">
                </div>
            </div>
        </section>
    </main>

    <!-- Footer: contact and feedback -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Lensora Studio</h3>
                    <p>Photography and short-form video for people and brands who care about detail.</p>
                </div>

                <div class="footer-section">
                    <h3>Feedback</h3>
                    <p class="footer-feedback"><a href="feedback.html">Client feedback form</a></p>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>
                    <address class="footer-address">
                        Email: <a href="mailto:info@lensora.com">info@lensora.com</a><br>
                        Phone: <a href="tel:+966500000000">+966 50 000 0000</a><br>
                        Jeddah, Saudi Arabia
                    </address>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const links = document.querySelectorAll('.gallery-link');
        const sections = document.querySelectorAll('.gallery-section');

        links.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();

                sections.forEach(sec => sec.classList.add('hidden'));

                const target = document.getElementById(link.dataset.target);
                target.classList.remove('hidden');
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>