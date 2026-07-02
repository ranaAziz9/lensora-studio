<?php
session_start();

// Check if the user is logged in
function checkLogin() {

    // If no user session exists, redirect to login page
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
}

// Check if the user is an admin
function checkAdmin() {

    // Ensure the user is logged in first
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

    // Deny access if the user is not an admin
    if (($_SESSION['role'] ?? null) !== 'admin') {
        header("Location: ../index.php?error=unauthorized");
        exit();
    }
}
?>