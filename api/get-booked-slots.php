<?php

require_once "../includes/db.php";

$stmt = $pdo->query("
    SELECT booking_date, booking_time
    FROM bookings
    WHERE status IN ('pending', 'approved')
");

header("Content-Type: application/json");

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);