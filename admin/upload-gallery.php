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
// Include database connection file
require_once "../includes/db.php";

// Check if request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get selected category from form (or empty string if not set)
    $category = $_POST["category"] ?? "";

    // Get uploaded image file from form
    $image = $_FILES["image"] ?? null;

    // Validate required inputs
=======
<?php
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $category = $_POST["category"] ?? "";
    $image = $_FILES["image"] ?? null;

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
    if (empty($category) || !$image) {
        die("Please select category and image.");
    }

<<<<<<< HEAD
    // Allowed file extensions
    $allowed = ["jpg", "jpeg", "png", "webp"];

    // Maximum file size (2MB)
    $maxSize = 2 * 1024 * 1024; // 2MB

    // Extract file information
=======
    $allowed = ["jpg", "jpeg", "png", "webp"];
    $maxSize = 2 * 1024 * 1024; // 2MB

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
    $fileName = $image["name"];
    $fileTmp = $image["tmp_name"];
    $fileSize = $image["size"];

<<<<<<< HEAD
    // Get file extension in lowercase
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
=======
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
    if (!in_array($ext, $allowed)) {
        die("Invalid file type. Only JPG, PNG, JPEG, WEBP allowed.");
    }

<<<<<<< HEAD
    // Validate file size
=======
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
    if ($fileSize > $maxSize) {
        die("File is too large. Maximum size is 2MB.");
    }

<<<<<<< HEAD
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
=======
    $newName = uniqid("gallery_", true) . "." . $ext;
    $uploadDir = "../uploads/";
    $uploadPath = $uploadDir . $newName;

    if (move_uploaded_file($fileTmp, $uploadPath)) {

        $dbPath = "uploads/" . $newName;

>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        $stmt = $pdo->prepare(
            "INSERT INTO gallery_images (category, image_path) VALUES (:category, :image_path)"
        );

<<<<<<< HEAD
        // Execute insert query with parameters
=======
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        $stmt->execute([
            ":category" => $category,
            ":image_path" => $dbPath
        ]);

<<<<<<< HEAD
        // Redirect back to gallery management page
        header("Location: gallery-manage.php");
        exit();

    } else {
        // If upload fails
=======
        header("Location: dashboard.php");
exit();

    } else {
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
        echo "Upload failed.";
    }

} else {
<<<<<<< HEAD
    // If request is not POST
    echo "Invalid request.";
}
?>
=======
    echo "Invalid request.";
}
?>
>>>>>>> 85d1596fa74e6d08e50182731c676513bc9b7f71
