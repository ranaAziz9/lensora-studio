<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? null;
$status = $data["status"] ?? null;

if (!$id || !$status) {
    echo json_encode(["status" => "error", "message" => "Missing data"]);
    exit;
}

$allowed = ["pending", "approved", "rejected"];
if (!in_array($status, $allowed)) {
    echo json_encode(["status" => "error", "message" => "Invalid status"]);
    exit;
}

$stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

echo json_encode(["status" => "success", "message" => "Booking updated"]);