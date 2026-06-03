<?php

header("Content-Type: application/json");

require_once("../includes/db.php");

$search = $_GET['search'] ?? '';

$sql = "
SELECT *
FROM feedback
WHERE client_name LIKE ?
ORDER BY submitted_at DESC
";

$stmt = $pdo->prepare($sql);

$stmt->execute(["%$search%"]);

$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($feedbacks);