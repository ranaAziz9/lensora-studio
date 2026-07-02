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

    <!-- Responsive viewport for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Lensora Studio — Professional Photography</title>

    <!-- Main stylesheet -->
    <link rel="stylesheet" href="global/main.css">
</head>

<body>

    <!-- Skip link for accessibility (keyboard navigation) -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

<<<<<<< HEAD
    <!-- Font Awesome icons library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Header navigation -->
    <?php include 'includes/header_nav.php'; ?>
=======
    <!-- Header: primary navigation -->
    <header class="site-header">
        <nav class="site-nav" aria-label="Primary navigation">
            <div class="container nav-container">
                <a href="index.html" class="nav-logo">
                    <img src="images/logo.png" alt="Lensora Studio logo">
                </a>
                <ul id="primary-nav" class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="pages/services.html">Services</a></li>
                    <li><a href="pages/work.php">Our Work</a></li>
                    <li><a href="pages/video.php">Video</a></li>
                    <li><a href="pages/feedback.html">Feedback</a></li>
                    <li><a href="pages/auth.html" style="background: #000; color: #fff; padding: 6px 15px; border-radius: 20px;">Login / Register</a></li>
                    <button onclick="location.href='pages/profile.php'">
My Profile
</button>
                </ul>
            </div>
        </nav>
    </header>
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71

    <main id="main-content" class="main-content">

        <!-- Hero section: main introduction -->
        <section class="hero" aria-labelledby="hero-heading">
            <div class="container">

                <!-- Main headline -->
                <h1 id="hero-heading">Capture Your Precious Moments</h1>

                <!-- Short description -->
                <p>
                    Professional photography for weddings, portraits, products, and events.
                    We turn real moments into a clear, lasting visual story.
                </p>

                <!-- Call-to-action buttons -->
                <div class="hero-buttons">
                    <a href="pages/services.php" class="btn btn-primary">Explore services</a>
                    <a href="pages/work.php" class="btn btn-secondary">See our work</a>
                </div>

                <!-- Hero image -->
                <div class="hero-image">
                    <img src="images/Brandonwoelfel12.webp" alt="Soft-focus portrait photography example">
                </div>

            </div>
        </section>

        <!-- About section -->
        <section aria-labelledby="about-heading">

            <div class="container">

                <!-- Section header -->
                <div class="section-header">
                    <h2 id="about-heading">About Lensora</h2>
                    <div class="accent-line"></div>

                    <p>
                        We are a small team of photographers focused on careful lighting, honest composition,
                        and images you will want to print—not just post.
                    </p>
                </div>

                <div class="about-grid">

                    <!-- Why choose us section -->
                    <div class="why-text">

                        <h3>Why choose us</h3>

                        <ul class="checklist">
                            <li>
                                <span class="check" aria-hidden="true">✓</span>
                                <span>Experienced photographers and consistent editing style</span>
                            </li>

                            <li>
                                <span class="check" aria-hidden="true">✓</span>
                                <span>Modern cameras and lighting for indoor and outdoor shoots</span>
                            </li>

                            <li>
                                <span class="check" aria-hidden="true">✓</span>
                                <span>Flexible packages for individuals, couples, and brands</span>
                            </li>

                            <li>
                                <span class="check" aria-hidden="true">✓</span>
                                <span>Typical delivery: edited photos within 5–7 business days</span>
                            </li>

                            <li>
                                <span class="check" aria-hidden="true">✓</span>
                                <span>We review your goals before the session so nothing feels rushed</span>
                            </li>
                        </ul>

                        <!-- Quote highlight -->
                        <div class="quote-panel">
                            <blockquote>
                                <p>
                                    Our job is to make you forget the camera is there—then deliver images that feel
                                    unmistakably <em>you</em>.
                                </p>
                            </blockquote>

                            <cite>— Lensora Studio, lead team</cite>
                        </div>

                    </div>

                    <!-- About image -->
                    <div class="about-media">
                        <img src="images/camera.jpeg" alt="Photographer working in a studio">
                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- Footer include -->
    <?php include 'includes/footer.php'; ?>

    <!-- Main JavaScript file -->
    <script src="scripts/main.js"></script>

</body>
</html>