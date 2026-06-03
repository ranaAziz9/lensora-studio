<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? null;
$title = $data["title"] ?? "";
$description = $data["description"] ?? "";
$price = $data["price"] ?? "";

if (!$id) {
    echo json_encode(["status"=>"error","message"=>"Missing ID"]);
    exit;
}

$stmt = $pdo->prepare("
    UPDATE services
    SET title=?, description=?, price=?
    WHERE id=?
");

$stmt->execute([$title, $description, $price, $id]);

echo json_encode([
    "status"=>"success",
    "message"=>"Service updated"
]);