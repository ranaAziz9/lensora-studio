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
session_start();
require_once "../includes/db.php";

// Ensure user is logged in before accessing profile page
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

// Get logged-in user ID and role from session
$userId = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? 'user';

// Fetch user details from database
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If user not found, force logout for safety
if (!$user) {
    header("Location: logout.php");
    exit();
}

// Fetch all bookings related to the user's email
$stmtBookings = $pdo->prepare("
    SELECT * FROM bookings 
    WHERE email = :email 
    ORDER BY booking_date DESC, booking_time DESC
");

$stmtBookings->execute([':email' => $user['email']]);
$myBookings = $stmtBookings->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Responsive design setup -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | Lensora Studio</title>

    <!-- Font Awesome icons library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Global and profile-specific styles -->
    <link rel="stylesheet" href="../global/main.css">
    <link rel="stylesheet" href="../global/profile.css">
</head>

<body>

    <!-- Navigation header -->
    <?php include '../includes/header_nav.php'; ?>

    <main class="profile-wrapper">

        <!-- User profile card -->
        <div class="profile-card">

            <div class="user-header">

                <!-- User avatar (first letter of name) -->
                <div class="avatar">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>

                <div>
                    <h2>
                        Welcome, 
                        <?= htmlspecialchars($user['name']) ?>
                        <?= $role === 'admin' ? '👑' : '' ?>
                    </h2>

                    <!-- Account role display -->
                    <p class="account-badge">
                        <?= $role === 'admin' ? 'Admin Account' : 'User Account' ?>
                    </p>
                </div>

            </div>

            <!-- User name field (read-only) -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?= htmlspecialchars($user['name']) ?>" disabled>
            </div>

            <!-- User email field (read-only) -->
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>

            <!-- Role-based message -->
            <?php if ($role === 'admin'): ?>
                <p class="privilege-text admin-text">
                    <i class="fa-solid fa-shield-halved"></i> You have admin privileges 
                </p>
            <?php else: ?>
                <p class="privilege-text standard-text">
                    <i class="fa-regular fa-user"></i> Standard user profile
                </p>
            <?php endif; ?>

        </div>

        <!-- Bookings section -->
        <div class="appointments-card lensora-card">

            <div class="appointments-header lensora-header">

                <div>
                    <h3>
                        <i class="fa-solid fa-calendar-check"></i>
                        My Booked Sessions
                    </h3>

                    <p class="subtext">
                        Track your photography sessions and upcoming shoots
                    </p>
                </div>

                <!-- Total bookings count -->
                <div class="header-meta">
                    <span class="booking-count">
                        <?= count($myBookings) ?> bookings
                    </span>
                </div>

            </div>

            <!-- If user has bookings -->
            <?php if (count($myBookings) > 0): ?>

                <div class="table-responsive lensora-table-wrap">

                    <!-- Bookings table -->
                    <table class="booking-history-table lensora-table">
                        <thead>
                            <tr>
                                <th>Package</th>
                                <th>Client</th>
                                <th>Date &amp; Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- Loop through bookings -->
                            <?php foreach ($myBookings as $booking): ?>
                                <tr class="lensora-row">

                                    <!-- Package name -->
                                    <td class="pkg-cell">
                                        <span class="pkg-bar"></span>
                                        <strong><?= htmlspecialchars($booking['package']) ?></strong>
                                    </td>

                                    <!-- Client name -->
                                    <td class="client-cell">
                                        <?= htmlspecialchars($booking['name']) ?>
                                    </td>

                                    <!-- Booking date and time -->
                                    <td class="datetime-cell">

                                        <div class="date-block">
                                            <i class="fa-regular fa-calendar"></i>
                                            <?= htmlspecialchars($booking['booking_date']) ?>
                                        </div>

                                        <div class="time-block">
                                            <i class="fa-regular fa-clock"></i>
                                            <?= htmlspecialchars($booking['booking_time']) ?>
                                        </div>

                                    </td>

                                    <!-- Booking status -->
                                    <td class="status-cell">
                                        <span class="status-badge status-<?= htmlspecialchars($booking['status']) ?>">
                                            <span class="dot"></span>
                                            <?= htmlspecialchars($booking['status']) ?>
                                        </span>
                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            <?php else: ?>

                <!-- Empty state when no bookings exist -->
                <div class="empty-bookings-state lensora-empty">

                    <div class="empty-icon-wrap">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>

                    <h4>No Sessions Booked Yet</h4>

                    <p>
                        Your creative journey starts here. Book your first Lensora photography session and capture timeless moments.
                    </p>

                    <a href="services.php" class="lensora-btn">
                        Explore Packages
                    </a>

                </div>

            <?php endif; ?>

        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>