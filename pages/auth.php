<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account | Lensora Studio</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="../global/login.css">

<style>

</style>
</head>



<body>

<div class="auth-container">

    <div class="logo">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Lensora Logo">
        </a>
    </div>

    <div class="tabs">
        <button id="tab-login-btn" class="active" onclick="showForm('login')" type="button">
            Login
        </button>
        <button id="tab-register-btn" onclick="showForm('register')" type="button">
            Register
        </button>
    </div>

    <div id="error-alert" class="alert alert-error"></div>
    <div id="success-alert" class="alert alert-success"></div>

    <!-- LOGIN -->
    <form id="login" class="active" method="POST" action="../login.php">
        <input type="email" name="email" placeholder="Email Address" required>
<div class="password-box">
  <input type="password" id="login-password" name="password" placeholder="Password" required>

  <i class="fa-solid fa-eye toggle-password"
     onclick="togglePassword('login-password', this)"></i>
</div>       <button type="submit" class="submit">Login</button>
    </form>

    <!-- REGISTER -->
    <form id="register" method="POST" action="../register.php" novalidate>
        <div id="error-alert" class="alert alert-error"></div>
<div id="success-alert" class="alert alert-success"></div>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
<div class="password-box">
  <input type="password" id="register-password" name="password" placeholder="Password" required>

  <i class="fa-solid fa-eye toggle-password"
     onclick="togglePassword('register-password', this)"></i>
</div>
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

    <p class="small-text">Lensora Studio ©️ 2026</p>

</div>
<script src="../scripts/main.js"></script>
</body>
</html>