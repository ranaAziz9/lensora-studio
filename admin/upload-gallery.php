<!--
  Name: Amirah Almutairi
  Name: Rana Alzaharni
  Name: Rama Aseeri
  ID: 2205930
  ID: 2206360
  ID: 2206257
  Section: DAR
  Date: 5/6/2026
-->

<?php
// Include database connection file
require_once "../includes/db.php";

// Check if request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get selected category from form (or empty string if not set)
    $category = $_POST["category"] ?? "";

    // Get uploaded image file from form
    $image = $_FILES["image"] ?? null;

    // Validate required inputs
    if (empty($category) || !$image) {
        die("Please select category and image.");
    }

    // Allowed file extensions
    $allowed = ["jpg", "jpeg", "png", "webp"];

    // Maximum file size (2MB)
    $maxSize = 2 * 1024 * 1024; // 2MB

    // Extract file information
    $fileName = $image["name"];
    $fileTmp = $image["tmp_name"];
    $fileSize = $image["size"];

    // Get file extension in lowercase
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($ext, $allowed)) {
        die("Invalid file type. Only JPG, PNG, JPEG, WEBP allowed.");
    }

    // Validate file size
    if ($fileSize > $maxSize) {
        die("File is too large. Maximum size is 2MB.");
    }

    // Generate unique file name for upload
    $newName = uniqid("gallery_", true) . "." . $ext;

    // Upload directory path
    $uploadDir = "../uploads/";

    // Full upload file path
    $uploadPath = $uploadDir . $newName;

    // Validate that file is a real uploaded file
    if (!is_uploaded_file($fileTmp)) {
        die("Invalid upload.");
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($fileTmp, $uploadPath)) {

        // Path saved in database (relative path)
        $dbPath = "uploads/" . $newName;

        // Insert image record into database
        $stmt = $pdo->prepare(
            "INSERT INTO gallery_images (category, image_path) VALUES (:category, :image_path)"
        );

        // Execute insert query with parameters
        $stmt->execute([
            ":category" => $category,
            ":image_path" => $dbPath
        ]);

        // Redirect back to gallery management page
        header("Location: gallery-manage.php");
        exit();

    } else {
        // If upload fails
        echo "Upload failed.";
    }

} else {
    // If request is not POST
    echo "Invalid request.";
}
?>
