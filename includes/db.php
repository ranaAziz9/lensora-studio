<?php
$host = "sql113.infinityfree.com";
$dbname = "if0_41979018_lensora_db";
$username = "if0_41979018";
$password = "lGz5V8Pk6kYtA";
//
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
?>