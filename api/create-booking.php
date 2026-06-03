<?php
header("Content-Type: application/json");
require_once("../includes/mailer.php");
require_once("../includes/db.php");

try {

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!$data) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid JSON request"
        ]);
        exit;
    }

    $package = trim($data["package"] ?? "");
    $date    = trim($data["date"] ?? "");
    $time    = trim($data["time"] ?? "");
    $name    = trim($data["name"] ?? "");
    $email   = trim($data["email"] ?? "");

    $subject = "Booking Confirmation - Lensora Studio";

$body = "
    <h2>Booking Confirmed</h2>

    <p>Hello <strong>$name</strong>,</p>

    <p>Your booking has been received successfully.</p>

    <p><strong>Package:</strong> $package</p>
    <p><strong>Date:</strong> $date</p>
    <p><strong>Time:</strong> $time</p>

    <p>We look forward to working with you.</p>
";

sendMail($email, $subject, $body);

    if ($package === "" || $date === "" || $time === "" || $name === "" || $email === "") {
        
        echo json_encode([
            "status" => "error",
            "message" => "Missing required fields"
        ]);
        exit;
    }

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

    echo json_encode([
        "status" => "success",
        "message" => "Booking saved successfully"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}