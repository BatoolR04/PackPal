<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Load theme (only if admin, otherwise default to tropical)
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];
include 'includes/theme.php'; // Injects $themeStyle
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard | PackPal</title>
  <meta name="description" content="Your personalized PackPal dashboard. Start planning trips, view your saved packing lists, or manage your account.">
  <meta name="keywords" content="dashboard, PackPal user area, plan trip, travel checklist">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Apply dynamic background */

    body, h1, p, span, div {
      font-family: 'Segoe UI', sans-serif;
      color: #000000 !important;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #0984e3 !important;
    }

    .container {
      max-width: 700px;
      margin: 80px auto;
      background: #ffffffdd;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
      text-align: center;
    }

    p {
      font-size: 1.1em;
      margin: 20px 0;
    }

    a {
      display: inline-block;
      margin: 12px;
      padding: 10px 20px;
      background-color: #0984e3;
      color: white !important;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }

    a:hover {
      background-color: #74b9ff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>What would you like to do today?</p>

    <a href="tripForm.php">🎒 Plan a New Trip</a>
    <a href="profile.php">📂 View Saved Trips</a>
    
    <?php if ($_SESSION['is_admin']): ?>
      <a href="admin.php">🛠️ Admin Dashboard</a>
    <?php endif; ?>
    
    <a href="logout.php">🚪 Logout</a>
  </div>
</body>
</html>
