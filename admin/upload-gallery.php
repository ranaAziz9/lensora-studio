<?php
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $category = $_POST["category"] ?? "";
    $image = $_FILES["image"] ?? null;

    if (empty($category) || !$image) {
        die("Please select category and image.");
    }

    $allowed = ["jpg", "jpeg", "png", "webp"];
    $maxSize = 2 * 1024 * 1024; // 2MB

    $fileName = $image["name"];
    $fileTmp = $image["tmp_name"];
    $fileSize = $image["size"];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Invalid file type. Only JPG, PNG, JPEG, WEBP allowed.");
    }

    if ($fileSize > $maxSize) {
        die("File is too large. Maximum size is 2MB.");
    }

    $newName = uniqid("gallery_", true) . "." . $ext;
    $uploadDir = "../uploads/";
    $uploadPath = $uploadDir . $newName;

    if (move_uploaded_file($fileTmp, $uploadPath)) {

        $dbPath = "uploads/" . $newName;

        $stmt = $pdo->prepare(
            "INSERT INTO gallery_images (category, image_path) VALUES (:category, :image_path)"
        );

        $stmt->execute([
            ":category" => $category,
            ":image_path" => $dbPath
        ]);

        echo "Image uploaded successfully.";

    } else {
        echo "Upload failed.";
    }

} else {
    echo "Invalid request.";
}
?>