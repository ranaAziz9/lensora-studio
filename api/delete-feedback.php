<?php

header("Content-Type: application/json");

require_once("../includes/db.php");

$id = $_GET['id'] ?? 0;

$sql = "DELETE FROM feedback WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

echo json_encode([
    "status" => "success",
    "message" => "Feedback deleted successfully"
]);