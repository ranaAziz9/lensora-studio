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
=======
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

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        $deleteStmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
        $deleteStmt->execute([$id]);
    }
}
<<<<<<< HEAD
// Redirect back to the gallery management page after deletion.
header("Location: gallery-manage.php");
exit();
?>
=======

header("Location: dashboard.php");
exit();
?>
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
