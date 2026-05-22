<?php
require_once "../includes/auth.php";
require_once "../includes/db.php";

checkAdmin();

$stmt = $pdo->query("SELECT id, name, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management | Lensora Studio</title>
    <link rel="stylesheet" href="../global/main.css">
</head>

<body>
    <header class="site-header">
        <nav class="site-nav">
            <div class="container nav-container">
                <a href="../index.html" class="nav-logo">
                    <img src="../images/logo.png" alt="Lensora Studio logo">
                </a>
                <ul class="nav-links">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="users.php" class="active">Users</a></li>
                    <li><a href="../index.php">View Website</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <section class="hero hero-compact">
            <div class="container">
                <h1>Users Management</h1>
                <p>Manage registered users and admin permissions.</p>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="form-panel">
                    <table class="booking-table">
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
                            <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <?php if($user['role'] == 'admin'): ?>
                                        <span class="badge-admin">Admin</span>
                                    <?php else: ?>
                                        <span class="badge-user">User</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user['id'] != $_SESSION['user_id']): ?>
                                        <form action="update-role.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <?php if($user['role'] == 'user'): ?>
                                                <input type="hidden" name="new_role" value="admin">
                                                <button type="submit" class="btn btn-secondary">Make Admin</button>
                                            <?php else: ?>
                                                <input type="hidden" name="new_role" value="user">
                                                <button type="submit" class="btn btn-dark">Remove Admin</button>
                                            <?php endif; ?>
                                        </form>
                                    <?php else: ?>
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

    <footer class="site-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2026 Lensora Studio. Admin Panel.</p>
            </div>
        </div>
    </footer>
</body>
</html>