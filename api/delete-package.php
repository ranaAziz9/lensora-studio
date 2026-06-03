<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

try {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data["id"] ?? null;

    if (!$id) {
        throw new Exception("ID required");
    }

    $stmt = $pdo->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode([
        "status" => "success",
        "message" => "Package deleted"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}