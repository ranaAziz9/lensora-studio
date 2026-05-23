<?php
require_once "../includes/db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $filePath = "../" . $image["image_path"];

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $deleteStmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
        $deleteStmt->execute([$id]);
    }
}

header("Location: dashboard.php");
exit();
?>