<?php

session_start();

require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);

    $email = filter_var(
        trim($_POST['email']),
        FILTER_SANITIZE_EMAIL
    );

    $password = $_POST['password'];

    // empty fields

    if (
        empty($name) ||
        empty($email) ||
        empty($password)
    ) {

        header("Location: pages/auth.html?error=empty&tab=register");

        exit();
    }

    // strong password validation

    if (
        strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/[0-9]/", $password) ||
        !preg_match("/[\W]/", $password)
    ) {

        header("Location: pages/auth.html?error=weakpassword&tab=register");

        exit();
    }

    // check email exists

    $stmt = $pdo->prepare("
        SELECT id
        FROM users
        WHERE email = :email
    ");

    $stmt->execute([
        'email' => $email
    ]);

    if ($stmt->rowCount() > 0) {

        header("Location: pages/auth.html?error=exists&tab=register");

        exit();
    }

    // hash password

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    try {

        $sql = "
            INSERT INTO users
            (name, email, password, role)

            VALUES
            (:name, :email, :password, 'user')
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            'name' => $name,

            'email' => $email,

            'password' => $hashedPassword

        ]);

        header("Location: pages/auth.html?success=registered&tab=login");

        exit();

    } catch (PDOException $e) {

        die("ERROR: " . $e->getMessage());
    }

} else {

    header("Location: pages/auth.html");

    exit();
}
?>