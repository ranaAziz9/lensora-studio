<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base = "http://localhost/lensora-studio/";
$viewMode = $_SESSION['view_mode'] ?? 'admin';
$role = $_SESSION['role'] ?? null;
$userId = $_SESSION['user_id'] ?? null;

$profileLink = $userId 
    ? $base . 'pages/profile.php' 
    : $base . 'pages/auth.php';
?>

<link rel="stylesheet" href="/global/main.css">

<header class="site-header">
    <nav class="site-nav" aria-label="Primary navigation">
        <div class="container nav-container">

            <div class="left-section">

                <!-- USER ICON -->
                <a href="<?= $profileLink ?>" class="profile-btn">
                    <i class="fa-solid fa-user"></i>
                </a>

                <!-- LOGO -->
                <a href="<?= $base ?>index.php" class="nav-logo">
<img src="<?= $base ?>images/logo.png" alt="Lensora Studio logo">          
      </a>

            </div>

            <ul id="primary-nav" class="nav-links">

                <!-- GUEST -->
                <?php if (!$userId): ?>
                    <li><a href="<?= $base ?>index.php">Home</a></li>
                    <li><a href="<?= $base ?>pages/services.php">Services</a></li>
                    <li><a href="<?= $base ?>pages/work.php">Our Work</a></li>
                    <li><a href="<?= $base ?>pages/video.php">Video</a></li>

                <!-- USER -->
                <?php elseif ($role !== 'admin'): ?>
                    <li><a href="<?= $base ?>index.php">Home</a></li>
                    <li><a href="<?= $base ?>pages/services.php">Services</a></li>
                    <li><a href="<?= $base ?>pages/work.php">Our Work</a></li>
                    <li><a href="<?= $base ?>pages/video.php">Video</a></li>
                    <li><a href="<?= $base ?>pages/feedback.php">Feedback</a></li>

                <!-- ADMIN -->
                <?php else: ?>
                    <li><a href="<?= $base ?>admin/dashboard.php">Dashboard</a></li>
                    <li><a href="<?= $base ?>admin/users.php">Users</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-trigger">View Site ▾</a>

                        <ul class="dropdown-menu">
                            <li><a href="<?= $base ?>index.php?mode=user">Home</a></li>
                            <li><a href="<?= $base ?>pages/services.php?mode=user">Services</a></li>
                            <li><a href="<?= $base ?>pages/work.php?mode=user">Our Work</a></li>
                            <li><a href="<?= $base ?>pages/video.php?mode=user">Video</a></li>
                            <li><a href="<?= $base ?>pages/feedback.php?mode=user">Feedback</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- LOGOUT -->
                <?php if ($userId): ?>
                    <li><a href="<?= $base ?>logout.php">Logout</a></li>
                <?php endif; ?>

            </ul>

        </div>
    </nav>
</header>