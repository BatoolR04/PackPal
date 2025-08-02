<?php
session_start();
include 'includes/db.php';

// Only allow admins
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

// Load theme
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));
include 'includes/theme.php'; // provides $themeStyle
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Help | PackPal</title>
  <meta name="description" content="Admin user guide for managing users, trips, and themes on PackPal.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* dynamic theme background */

    body, td, th, span, p, div {
      color: #000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 10px;
      color: #0984e3;
    }

    h2 {
      color: #0984e3;
      font-size: 20px;
      margin-top: 30px;
    }

    p {
      line-height: 1.6;
      margin-bottom: 15px;
    }

    ul {
      margin-left: 20px;
      list-style-type: disc;
    }

    a {
      color: #0984e3;
      font-weight: bold;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      background-color: #ffffffd9;
      max-width: 800px;
      margin: 50px auto;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .back-link {
      text-align: center;
      margin-top: 30px;
    }

    .intro {
      text-align: center;
      font-size: 16px;
      margin-bottom: 25px;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Help Guide</h1>
    <p class="intro">This page explains how to manage themes, users, trips, and monitor site activity using your Admin Dashboard.</p>

    <h2>🎨 Change Site Theme</h2>
    <p>Click <strong>Change Site Theme</strong> in the Admin Dashboard to update the website's look. Choose from tropical, dark, city, or nature styles. All users will see the new theme instantly.</p>

    <h2>👥 Manage User Accounts</h2>
    <p>From the Admin Dashboard:</p>
    <ul>
      <li>View all registered users with their email, role, and status</li>
      <li>Enable or disable user accounts (disabling prevents login)</li>
      <li>You cannot disable your own account</li>
    </ul>

    <h2>🧳 Manage User Trips</h2>
    <p>Go to <strong>Manage User Trips</strong> to view trips saved by users. Each trip includes the destination, type, and travel dates. Admins can now both <strong>edit</strong> and <strong>delete</strong> user trips.</p>

    <h2>📊 Monitor Site Activity</h2>
    <p>Click <strong>Monitor Site</strong> to view the total number of registered users, number of saved trips, and currently active theme. This helps admins track platform usage and status.</p>

    <div class="back-link">
      <a href="admin.php">← Back to Admin Dashboard</a>
    </div>
  </div>
</body>
</html>
