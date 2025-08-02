<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$destination = trim($_POST['destination'] ?? '');
$trip_type = trim($_POST['trip_type'] ?? '');
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';

// Basic validation
if ($destination && $trip_type && $start_date && $end_date) {
    $stmt = $conn->prepare("INSERT INTO trips (destination, trip_type, start_date, end_date, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $destination, $trip_type, $start_date, $end_date, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: profile.php");
        exit();
    } else {
        echo "Failed to save trip. Please try again.";
    }
} else {
    echo "All fields are required.";
}
?>
