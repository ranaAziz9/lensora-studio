<<<<<<< HEAD
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

// Load the database connection.
require_once "../includes/db.php";

// Check if a video ID was provided in the request.
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the video file path from the database.
=======
<?php
require_once "../includes/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
    $stmt = $pdo->prepare("SELECT video_path FROM site_videos WHERE id = ?");
    $stmt->execute([$id]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

<<<<<<< HEAD
    // Continue only if the video record exists.
    if ($video) {
        
        // Build the full server path to the video file.
        $filePath = "../" . $video["video_path"];

        // Delete the uploaded video file from the server if it exists.
=======
    if ($video) {
        $filePath = "../" . $video["video_path"];

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        if (file_exists($filePath) && str_starts_with($video["video_path"], "uploads/")) {
            unlink($filePath);
        }

<<<<<<< HEAD
        // Delete the video record from the database.
=======
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        $delete = $pdo->prepare("DELETE FROM site_videos WHERE id = ?");
        $delete->execute([$id]);
    }
}

<<<<<<< HEAD
// Redirect back to the video management page after deletion.
header("Location: videos-manage.php");
exit();
?>
=======
header("Location: dashboard.php");
exit();
?>
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
