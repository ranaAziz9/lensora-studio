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

    // Get uploaded video file from form
    $video = $_FILES["video"] ?? null;

    // Validate that a file was uploaded
    if (!$video) {
        die("Please choose a video.");
    }

    // Allowed video formats
    $allowed = ["mp4", "webm", "ogg"];

    // Maximum file size (50MB)
    $maxSize = 50 * 1024 * 1024; // 50MB

    // Extract file information
    $fileName = $video["name"];
    $fileTmp = $video["tmp_name"];
    $fileSize = $video["size"];

    // Get file extension in lowercase
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate video file type
    if (!in_array($ext, $allowed)) {
        die("Invalid video type. Only MP4, WEBM, OGG allowed.");
    }

    // Validate file size
    if ($fileSize > $maxSize) {
        die("Video is too large. Maximum size is 50MB.");
    }

    // Generate unique file name for upload
    $newName = uniqid("video_", true) . "." . $ext;

    // Upload directory path
    $uploadDir = "../uploads/";

    // Full upload path
    $uploadPath = $uploadDir . $newName;

    // Move uploaded file to target directory
    if (move_uploaded_file($fileTmp, $uploadPath)) {

        // Path saved in database
        $dbPath = "uploads/" . $newName;

        // Insert video record into database
        $stmt = $pdo->prepare("INSERT INTO site_videos (video_path) VALUES (?)");
        $stmt->execute([$dbPath]);

        // Redirect to video management page
        header("Location: videos-manage.php");
        exit();
    }

    // If upload fails
    echo "Video upload failed.";
}
?>
