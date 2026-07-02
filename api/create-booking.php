<?php
header("Content-Type: application/json");

session_start();

require_once("../includes/mailer.php");
require_once("../includes/db.php");

try {

    // 1. Read JSON input
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid JSON request"
        ]);
        exit;
    }

    // 2. Get user_id from session (MAIN FIX)
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        echo json_encode([
            "status" => "error",
            "message" => "Please login or register before booking"
        ]);
        exit;
    }

    // 3. Get user email from database (NOT session)
    $stmtUser = $pdo->prepare("SELECT email, name FROM users WHERE id = :id LIMIT 1");
    $stmtUser->execute([":id" => $userId]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode([
            "status" => "error",
            "message" => "User not found"
        ]);
        exit;
    }

    $email = $user['email'];
    $nameFromDB = $user['name'];

    // 4. Get booking data
    $package = trim($data["package"] ?? "");
    $date    = trim($data["date"] ?? "");
    $time    = trim($data["time"] ?? "");
    $name    = trim($data["name"] ?? "");

    // 5. Validation
    if ($package === "" || $date === "" || $time === "" || $name === "") {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required fields"
        ]);
        exit;
    }

    // 6. Insert booking
    $stmt = $pdo->prepare("
        INSERT INTO bookings (package, booking_date, booking_time, name, email, status)
        VALUES (:package, :date, :time, :name, :email, 'pending')
    ");

    $stmt->execute([
        ":package" => $package,
        ":date"    => $date,
        ":time"    => $time,
        ":name"    => $name,
        ":email"   => $email
    ]);

    // 7. Send confirmation email
    $subject = "Booking Confirmation - Lensora Studio";

    $body = "
        <h2>Booking Confirmed</h2>

        <p>Hello <strong>$nameFromDB</strong>,</p>

        <p>Your booking has been received successfully.</p>

        <p><strong>Package:</strong> $package</p>
        <p><strong>Date:</strong> $date</p>
        <p><strong>Time:</strong> $time</p>

        <p>We look forward to working with you.</p>
    ";

    sendMail($email, $subject, $body);

    // 8. Success response
    echo json_encode([
        "status" => "success",
        "message" => "Booking saved successfully"
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => "Database error"
    ]);
}