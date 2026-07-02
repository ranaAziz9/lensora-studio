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
require_once "../includes/auth.php";
checkAdmin();

require_once "../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile | Lensora Studio</title>

<!-- نفس CSS حق الموقع الأساسي -->
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>

/* =====================
   PROFILE THEME (Lensora)
   ===================== */

:root {
    --primary-purple: #8f79b8;
    --dark-purple: #6d5b98;
    --light-bg: #f5f3f8;
    --card: #ffffff;
}

/* page */
body {
    margin: 0;
    background: var(--light-bg);
    font-family: Arial, sans-serif;
}

/* wrapper */
.profile-wrapper {
    max-width: 850px;
    margin: 70px auto;
    padding: 20px;
}

/* card */
.profile-card {
    background: var(--card);
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(143,121,184,0.15);
}

/* header section */
.user-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

/* avatar */
.avatar {
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    font-weight: bold;
}

/* text */
h2 {
    margin: 0;
    color: var(--dark-purple);
}

.user-header p {
    color: #777;
    margin-top: 5px;
}

/* form */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--dark-purple);
}

/* inputs */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-sizing: border-box;
    transition: 0.2s;
}

input:focus {
    border-color: var(--primary-purple);
    box-shadow: 0 0 0 3px rgba(143,121,184,0.2);
    outline: none;
}

/* button */
.btn-save {
    background: var(--primary-purple);
    color: white;
    padding: 12px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
    width: 100%;
    transition: 0.2s;
}

.btn-save:hover {
    background: var(--dark-purple);
    transform: translateY(-2px);
}

/* header override (important) */
.site-header {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.site-nav a {
    color: #333;
}

.site-nav a:hover {
    color: var(--primary-purple);
}
.profile-btn {
    background: #8f79b8;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: none;
    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    color: white;
    transition: 0.2s;
}

.profile-btn i {
    font-size: 18px;
    color: white;
}

.profile-btn:hover {
    background: #6d5b98;
    transform: scale(1.05);
}
</style>
</head>

<body>

<!-- ================= HEADER (same as home) ================= -->
<header class="site-header">
    <nav class="site-nav" aria-label="Primary navigation">
        <div class="container nav-container">

            <a href="../index.php" class="nav-logo">
                <img src="../images/logo.png" alt="Lensora Studio logo">
            </a>

            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="work.php">Our Work</a></li>
                <li><a href="video.php">Video</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <button onclick="location.href='profile_admin.php'" class="profile-btn">
    <i class="fa-solid fa-user"></i>
</button>
            </ul>

        </div>
    </nav>
</header>

<!-- ================= PROFILE ================= -->
<main class="profile-wrapper">

    <div class="profile-card">

        <div class="user-header">
            <div class="avatar">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>

            <div>
                <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
                <p>Manage your account details</p>
            </div>
        </div>

        <form method="POST" action= "../pages/update_profile.php">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?= htmlspecialchars($user['name']) ?>" disabled>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current">
            </div>

            <button type="submit" class="btn-save">Update Profile</button>

        </form>

    </div>

</main>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
    <div class="container">
        <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
    </div>
</footer>

</body>
</html>