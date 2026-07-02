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
require_once "includes/db.php";

// Ensure request is POST (login form submission only)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and retrieve email input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Get raw password input
    $password = $_POST['password'];

    // Fetch user data by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify user exists and password matches hashed password
    if ($user && password_verify($password, $user['password'])) {

        // Store user data in session after successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        // Redirect based on user role
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();

    }

    // If login fails, redirect back with error message
    header("Location: pages/auth.php?error=invalid&tab=login");
    exit();

} else {

    // If accessed without POST request, redirect to auth page
    header("Location: pages/auth.php");
    exit();
}
?>