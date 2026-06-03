<?php
require_once "../includes/db.php";

$search = $_GET["search"] ?? "";
$min = $_GET["min"] ?? 0;
$max = $_GET["max"] ?? 999999;

$stmt = $pdo->prepare("
    SELECT *
    FROM packages
    WHERE package_name LIKE ?
    AND price BETWEEN ? AND ?
    ORDER BY id DESC
");

$stmt->execute([
    "%$search%",
    $min,
    $max
]);

$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "success",
    "data" => $packages
]);