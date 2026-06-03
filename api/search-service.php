<?php
header("Content-Type: application/json");
require_once("../includes/db.php");

$search = $_GET["search"] ?? "";
$minPrice = $_GET["min"] ?? 0;
$maxPrice = $_GET["max"] ?? 999999;

$sql = "
    SELECT * FROM services
    WHERE title LIKE ?
    AND price BETWEEN ? AND ?
    ORDER BY id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    "%$search%",
    $minPrice,
    $maxPrice
]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "success",
    "data" => $results
]);