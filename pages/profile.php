<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

$userId = $_SESSION['user_id'];

// جلب بيانات المستخدم
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>My Profile | Lensora</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f2f7;
}

/* layout */
.container {
    display: flex;
    max-width: 900px;
    margin: 60px auto;
    gap: 20px;
}

/* LEFT CARD */
.left {
    width: 280px;
    background: #8f79b8;
    color: white;
    border-radius: 18px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: white;
    color: #8f79b8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    font-weight: bold;
    margin: 0 auto 15px;
}

/* RIGHT CARD */
.right {
    flex: 1;
    background: white;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

h2 {
    margin-top: 0;
    color: #333;
}

/* form */
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background: #8f79b8;
    border: none;
    color: white;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background: #6d5b98;
}

.label {
    font-size: 13px;
    color: #777;
    margin-top: 10px;
}

.back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 10px 15px;
    background: #6D5B98;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
}

.back-btn:hover {
    background: #4A3A70;
}
</style>

</head>

<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <div class="avatar">
            <?= strtoupper(substr($user['name'], 0, 1)) ?>
        </div>

        <h3><?= $user['name'] ?></h3>
        <p><?= $user['email'] ?></p>

        <p class="label">Lensora User</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <h2>My Profile</h2>

        <p class="label">Update your information</p>

        <form method="POST" action="../update_profile.php">

            <input type="text" value="<?= $user['name'] ?>" disabled>

            <input type="email" name="email" value="<?= $user['email'] ?>" required>

            <input type="password" name="password" placeholder="New Password (optional)">

            <button type="submit">Save Changes</button>
            <a href="../index.php" class="back-btn">
    ← Home
</a>

        </form>

    </div>

</div>

</body>
</html>