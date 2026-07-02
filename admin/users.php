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
require_once '../includes/auth.php';

// Allow only admins to access this page
checkAdmin();

require_once "../includes/db.php";

// Retrieve all users from database
$stmt = $pdo->query("SELECT id, name, email, role FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Users Management | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<!-- Accessibility skip link -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<!-- Page header section -->
<section class="hero hero-compact">
<div class="container">
<h1>Users Management</h1>
<p>Manage registered users and admin permissions.</p>
</div>
</section>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2>Users List</h2>
<div class="accent-line"></div>
</div>

<div class="form-panel table-responsive">

<!-- Users table -->
<table class="booking-table users-table">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<!-- Display each user -->
<?php foreach ($users as $user): ?>
<tr>

<td><?= htmlspecialchars($user['id']) ?></td>
<td><?= htmlspecialchars($user['name']) ?></td>
<td><?= htmlspecialchars($user['email']) ?></td>

<td>

<!-- Show role badge -->
<?php if ($user['role'] === 'admin'): ?>
<span class="badge-admin">Admin</span>
<?php else: ?>
<span class="badge-user">User</span>
<?php endif; ?>

</td>

<td>

<!-- Prevent admin from changing their own role -->
<?php if ($user['id'] != $_SESSION['user_id']): ?>

<!-- Form for updating user role -->
<form action="update-role.php" method="POST" class="inline-form">

<input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">

<?php if ($user['role'] === 'user'): ?>

<!-- Promote user to admin -->
<input type="hidden" name="new_role" value="admin">
<button type="submit" class="btn btn-secondary">Make Admin</button>

<?php else: ?>

<!-- Remove admin privileges -->
<input type="hidden" name="new_role" value="user">
<button type="submit" class="btn btn-dark">Remove Admin</button>

<?php endif; ?>

</form>

<?php else: ?>

<!-- Current logged-in admin -->
<span class="text-muted">Current Admin</span>

<?php endif; ?>

</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>

</div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>