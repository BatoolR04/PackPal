<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Get current active status
  $stmt = $conn->prepare("SELECT is_active FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user) {
    $new_status = $user['is_active'] ? 0 : 1;

    $update = $conn->prepare("UPDATE users SET is_active = ? WHERE id = ?");
    $update->bind_param("ii", $new_status, $id);
    $update->execute();
  }
}

header("Location: admin.php");
exit();
?>
