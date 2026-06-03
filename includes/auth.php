<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
}

function checkAdmin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

    if (($_SESSION['role'] ?? null) !== 'admin') {
        header("Location: ../index.php?error=unauthorized");
        exit();
    }
}
?>