<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
}

function checkAdmin() {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
        header("Location: ../login.php");
        exit();
    }
}
?>