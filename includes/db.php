<?php

// Database connection settings
$host = "localhost";
$dbname = "lensora_studio";
$username = "root";
$password = "";

try {

    // Create PDO connection to MySQL database
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    // Enable exception mode for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Display error message if connection fails
    die("DB Connection Failed: " . $e->getMessage());
<<<<<<< HEAD
}
=======
}
?>

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
