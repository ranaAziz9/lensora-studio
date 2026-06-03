<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

try {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data["package_name"] ?? "";
    $price = $data["price"] ?? "";
    $description = $data["description"] ?? "";
    $slug = $data["slug"] ?? "";

    if (!$name || !$price || !$slug) {
        throw new Exception("Missing fields");
    }

    $stmt = $pdo->prepare("
        INSERT INTO packages (package_name, price, description, slug)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$name, $price, $description, $slug]);

    echo json_encode([
        "status" => "success",
        "message" => "Package added"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}