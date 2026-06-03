<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

try {

    $data = json_decode(file_get_contents("php://input"), true);

    $title = trim($data["title"] ?? "");
    $description = trim($data["description"] ?? "");
    $price = $data["price"] ?? null;

    // VALIDATION (important for debugging)
    if ($title === "" || $price === null || $price === "") {
        throw new Exception("Missing title or price");
    }

    if (!is_numeric($price)) {
        throw new Exception("Price must be a number");
    }

    $stmt = $pdo->prepare("
        INSERT INTO services (title, description, price)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$title, $description, $price]);

    echo json_encode([
        "status" => "success",
        "message" => "Service added successfully"
    ]);

} catch (Exception $e) {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}