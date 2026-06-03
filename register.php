<?php

require_once "includes/mailer.php";
session_start();
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =========================
    // 1. GET INPUTS + CLEAN
    // =========================
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // =========================
    // 2. EMPTY CHECK (FIRST)
    // =========================
    if (empty($name) || empty($email) || empty($password)) {
        header("Location: pages/auth.php?error=empty&tab=register");
        exit();
    }

    // =========================
    // 3. NAME VALIDATION
    // letters + spaces only+ arabic letters
    // =========================
    if (!preg_match("/^[\p{L}\s]+$/u", $name)) {
    header("Location: pages/auth.php?error=invalidname&tab=register");
    exit();
}

    // =========================
    // 4. EMAIL VALIDATION
    // proper email format
    // =========================
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: pages/auth.php?error=invalidemail&tab=register");
        exit();
    }

    // =========================
    // 5. PASSWORD VALIDATION
    // strong password rules
    // =========================
    if (
        strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/[0-9]/", $password) ||
        !preg_match("/[\W]/", $password)
    ) {
        header("Location: pages/auth.php?error=weakpassword&tab=register");
        exit();
    }

    // =========================
    // 6. CHECK EMAIL EXISTS
    // =========================
    $stmt = $pdo->prepare("
        SELECT id
        FROM users
        WHERE email = :email
    ");

    $stmt->execute([
        'email' => $email
    ]);

    if ($stmt->rowCount() > 0) {
        header("Location: pages/auth.php?error=exists&tab=register");
        exit();
    }

    // =========================
    // 7. HASH PASSWORD
    // =========================
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // =========================
    // 8. INSERT USER
    // =========================
    try {

        $sql = "
            INSERT INTO users (name, email, password, role)
            VALUES (:name, :email, :password, 'user')
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        // =========================
        // 9. SEND WELCOME EMAIL
        // =========================
        $subject = "Welcome to Lensora Studio";

        $body = "
            <h2>Welcome to Lensora Studio</h2>
            <p>Hello <strong>$name</strong>,</p>
            <p>Your account has been created successfully.</p>
            <p>Thank you for joining Lensora Studio.</p>
        ";

        sendMail($email, $subject, $body);

        // =========================
        // 10. SUCCESS REDIRECT
        // =========================
        header("Location: pages/auth.php?success=registered&tab=login");
        exit();

    } catch (PDOException $e) {
        die("ERROR: " . $e->getMessage());
    }

} else {

    header("Location: pages/auth.php");
    exit();
}
?>