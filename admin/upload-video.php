<?php
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $video = $_FILES["video"] ?? null;

    if (!$video) {
        die("Please choose a video.");
    }

    $allowed = ["mp4", "webm", "ogg"];
    $maxSize = 50 * 1024 * 1024; // 50MB

    $fileName = $video["name"];
    $fileTmp = $video["tmp_name"];
    $fileSize = $video["size"];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Invalid video type. Only MP4, WEBM, OGG allowed.");
    }

    if ($fileSize > $maxSize) {
        die("Video is too large. Maximum size is 50MB.");
    }

    $newName = uniqid("video_", true) . "." . $ext;
    $uploadDir = "../uploads/";
    $uploadPath = $uploadDir . $newName;

    if (move_uploaded_file($fileTmp, $uploadPath)) {
        $dbPath = "uploads/" . $newName;

        $stmt = $pdo->prepare("INSERT INTO site_videos (video_path) VALUES (?)");
        $stmt->execute([$dbPath]);

        header("Location: videos-manage.php");
        exit();
    }

    echo "Video upload failed.";
}
?>
