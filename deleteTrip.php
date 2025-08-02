<?php
session_start();
include 'includes/db.php';

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get trip ID securely from POST request
$trip_id = $_POST['trip_id'] ?? 0;
$user_id = $_SESSION['user_id'];

// Delete only if the trip belongs to the logged-in user
$stmt = $conn->prepare("DELETE FROM trips WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $trip_id, $user_id);
$stmt->execute();
$stmt->close();

// Redirect back to profile after deletion
header("Location: profile.php");
exit();
?>
