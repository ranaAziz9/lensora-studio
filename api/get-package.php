<?php
header("Content-Type: application/json");

require_once("../includes/db.php");

try {
    $stmt = $pdo->query("SELECT * FROM packages");
    $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "data" => $packages
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}