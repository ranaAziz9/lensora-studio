<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

$stmt = $pdo->query("SELECT * FROM bookings ORDER BY id DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "success",
    "data" => $bookings
]);