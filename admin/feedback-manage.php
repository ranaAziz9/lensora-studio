<?php
require_once '../includes/auth.php';
checkAdmin();
require_once "../includes/db.php";

$stmt = $pdo->query("SELECT * FROM feedback ORDER BY id DESC");
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Feedback | Lensora Studio</title>

<link rel="stylesheet" href="../global/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php include '../includes/header_nav.php'; ?>

<main id="main-content" class="main-content">

<section class="hero hero-compact">
<div class="container">
<h1>Manage Feedback</h1>
<p>Search and delete client feedback.</p>
</div>
</section>

<section class="section-alt">
<div class="container">

<div class="section-header">
<h2>Feedback Management</h2>
<div class="accent-line"></div>
</div>

<div class="form-card">
<input
type="text"
id="feedback-search"
class="input"
placeholder="Search feedback by client name"
>
</div>

<div id="feedback-results" class="grid admin-grid">

<?php if (count($feedbacks) > 0): ?>

<?php foreach ($feedbacks as $item): ?>

<div class="card feedback-card">

<h3 class="card-title">
<?= htmlspecialchars($item["client_name"]) ?>
</h3>

<p class="card-text">
<strong>Email:</strong> <?= htmlspecialchars($item["email"]) ?>
</p>

<p class="card-text">
<strong>Rating:</strong> <?= htmlspecialchars($item["rating"]) ?>
</p>

<p class="card-text">
<strong>Services:</strong> <?= htmlspecialchars($item["services_used"]) ?>
</p>

<p class="card-text">
<strong>Style:</strong> <?= htmlspecialchars($item["style_preference"]) ?>
</p>

<p class="card-text">
<strong>Comments:</strong> <?= htmlspecialchars($item["comments"]) ?>
</p>

<?php if (!empty($item["submitted_at"])): ?>
<p class="card-text">
<strong>Submitted:</strong> <?= htmlspecialchars($item["submitted_at"]) ?>
</p>
<?php endif; ?>

<button
type="button"
class="btn btn-dark btn-full delete-feedback-btn"
data-id="<?= htmlspecialchars($item["id"], ENT_QUOTES) ?>"
>
Delete
</button>

</div>

<?php endforeach; ?>

<?php else: ?>

<p>No feedback found.</p>

<?php endif; ?>

</div>

</div>
</section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script src="../scripts/main.js"></script>

</body>
</html>