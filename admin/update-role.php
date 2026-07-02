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
// Include authentication file (for user session handling if needed)
require_once "../includes/auth.php";

// Include database connection file
require_once "../includes/db.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if required POST parameters exist
    if (isset($_POST['user_id']) && isset($_POST['new_role'])) {
        
        // Get user ID from POST data
        $userId = $_POST['user_id'];
        
        // Get new role value from POST data
        $newRole = $_POST['new_role'];

        // Prepare SQL query to update user role
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");

        // Execute the query with provided values
        $stmt->execute([$newRole, $userId]);

        // Redirect back to users page after update
        header("Location: users.php");
        exit();
    }
}
?>