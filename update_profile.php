<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/lensora_studio/includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: pages/auth.html");
    exit();
}

$userId = $_SESSION['user_id'];

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        UPDATE users 
        SET email = ?, password = ?
        WHERE id = ?
    ");
    $stmt->execute([$email, $hashed, $userId]);

} else {

    $stmt = $pdo->prepare("
        UPDATE users 
        SET email = ?
        WHERE id = ?
    ");
    $stmt->execute([$email, $userId]);
}

header("Location: pages/profile.php?success=1");
exit();
?>