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
session_start();

// Start session to access existing session data

// Destroy all session data to log the user out completely
session_destroy();

// Redirect user to authentication page after logout
header("Location: pages/auth.php");
exit();
?>