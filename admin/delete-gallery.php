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
require_once "../includes/db.php";

// Check if an image ID was provided in the request.
if (isset($_GET["id"])) {
    $id = $_GET["id"];
// Retrieve the image file path from the database.
    $stmt = $pdo->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
// Continue only if the image record exists.
    if ($image) {
        // Build the full server path to the image file.
        $filePath = "../" . $image["image_path"];
// Verify that the image file exists before deleting it.
        if (file_exists($filePath)) {
            // Remove the image file from the server.
            unlink($filePath);
        }
// Delete the image record from the database.
        $deleteStmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
        $deleteStmt->execute([$id]);
    }
}
// Redirect back to the gallery management page after deletion.
header("Location: gallery-manage.php");
exit();
?>
