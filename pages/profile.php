<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$userId = $_SESSION['user_id'];

$role = $_SESSION['role'] ?? 'user';

$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="../global/main.css">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile | Lensora Studio</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="../global/profile.css">

<style>

</style>
</head>

<body>

<!-- Header nav-->
<?php include '../includes/header_nav.php'; ?>
<main class="profile-wrapper">

    <div class="profile-card">

        <div class="user-header">
            <div class="avatar">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>

            <div>
                <h2>
                    Welcome, 
                    <?= htmlspecialchars($user['name']) ?>
                    <?= $role === 'admin' ? '👑' : '' ?>
                </h2>

                <p>
                    <?= $role === 'admin' ? 'Admin Account' : 'User Account' ?>
                </p>
            </div>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" value="<?= htmlspecialchars($user['name']) ?>" disabled>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
        </div>

        <?php if ($role === 'admin'): ?>
            <p style="color: #8f79b8; font-weight: bold;">
                You have admin privileges 
            </p>
        <?php else: ?>
            <p style="color: #777;">
                Standard user profile
            </p>
        <?php endif; ?>

    </div>

</main>

<footer class="site-footer">
    <div class="container">
        <p>&copy; 2026 Lensora Studio. All rights reserved.</p>
    </div>
</footer>

</body>
</html>