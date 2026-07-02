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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Account | Lensora Studio</title>

<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Main and authentication styles -->
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="../global/login.css">

<style>

</style>
</head>

<body>

<!-- Authentication container -->
<div class="auth-container">

    <!-- Website logo -->
    <div class="logo">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Lensora Logo">
        </a>
    </div>

    <!-- Login / Register tabs -->
    <div class="tabs">
        <button id="tab-login-btn" class="active" onclick="showForm('login')" type="button">
            Login
        </button>

        <button id="tab-register-btn" onclick="showForm('register')" type="button">
            Register
        </button>
    </div>

    <!-- Alert messages -->
    <div id="error-alert" class="alert alert-error"></div>
    <div id="success-alert" class="alert alert-success"></div>
<?php 
// Show error message if email sending failed after successful registration
if(isset($_GET['error']) && $_GET['error'] == 'mailfailed'): 
?>
    <div class="alert alert-error active">
        Registration completed, but the email could not be sent.
    </div>
<?php endif; ?>

    <!-- Login Form -->
    <form id="login" class="active" method="POST" action="../login.php">

        <input type="email" name="email" placeholder="Email Address" required>

        <!-- Password field with visibility toggle -->
        <div class="password-box">
            <input type="password" id="login-password" name="password" placeholder="Password" required>

            <i class="fa-solid fa-eye toggle-password"
               onclick="togglePassword('login-password', this)"></i>
        </div>

        <button type="submit" class="submit">Login</button>

    </form>

    <!-- Registration Form -->
    <form id="register" method="POST" action="../register.php" novalidate>

        <!-- Registration alerts -->
        <div id="error-alert" class="alert alert-error"></div>
        <div id="success-alert" class="alert alert-success"></div>

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <!-- Password field with visibility toggle -->
        <div class="password-box">
            <input type="password" id="register-password" name="password" placeholder="Password" required>

            <i class="fa-solid fa-eye toggle-password"
               onclick="togglePassword('register-password', this)"></i>
        </div>

        <!-- Password requirements -->
        <div class="password-rules">

            <div class="rules-title">Password must include:</div>

            <ul>
                <li>✔️ At least 8 characters</li>
                <li>✔️ Uppercase (A–Z) and lowercase (a–z)</li>
                <li>✔️ A number (0–9)</li>
                <li>✔️ A special character (!@#$%)</li>
            </ul>

        </div>

        <button type="submit" class="submit">Register</button>

    </form>

    <!-- Footer text -->
    <p class="small-text">Lensora Studio ©️ 2026</p>

</div>

<!-- Main JavaScript file -->
<script src="../scripts/main.js"></script>

</body>
</html>