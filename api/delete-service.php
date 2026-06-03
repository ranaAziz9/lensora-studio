<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["status"=>"error","message"=>"Missing ID"]);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM services WHERE id=?");
$stmt->execute([$id]);

echo json_encode(["status"=>"success","message"=>"Service deleted"]);