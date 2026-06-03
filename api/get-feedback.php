<?php
header("Content-Type: application/json");

require_once("../includes/db.php");

try {
    $stmt = $pdo->query("SELECT * FROM feedback ORDER BY id DESC");
    $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "data" => $feedback
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}