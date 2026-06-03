<?php
require_once "../includes/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT video_path FROM site_videos WHERE id = ?");
    $stmt->execute([$id]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($video) {
        $filePath = "../" . $video["video_path"];

        if (file_exists($filePath) && str_starts_with($video["video_path"], "uploads/")) {
            unlink($filePath);
        }

        $delete = $pdo->prepare("DELETE FROM site_videos WHERE id = ?");
        $delete->execute([$id]);
    }
}

header("Location: videos-manage.php");
exit();
?>
