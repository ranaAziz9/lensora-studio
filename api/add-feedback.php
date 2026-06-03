<?php

header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../includes/db.php");

try {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        throw new Exception("No data received");
    }

    $client_name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $rating = $data['rating'] ?? '';
    $services = $data['services'] ?? [];
    $style_preference = $data['style_preference'] ?? '';
    $comments = $data['comments'] ?? '';

    $services_used = is_array($services) ? implode(", ", $services) : $services;

    $sql = "INSERT INTO feedback 
    (client_name, email, rating, services_used, style_preference, comments)
    VALUES
    (:client_name, :email, :rating, :services_used, :style_preference, :comments)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":client_name" => $client_name,
        ":email" => $email,
        ":rating" => $rating,
        ":services_used" => $services_used,
        ":style_preference" => $style_preference,
        ":comments" => $comments
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "Feedback saved successfully"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

?>