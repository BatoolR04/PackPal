<?php
session_start();
include 'includes/db.php';

// Redirect if not admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

// Load theme from DB only if not already set
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));

include 'includes/theme.php'; // Load theme background gradient

// Get all users
$result = $conn->query("SELECT id, username, email, is_admin, is_active FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | PackPal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin control panel for PackPal travel planner.">
  <meta name="keywords" content="PackPal, Admin, Travel Planner">
  <meta name="author" content="PackPal Team">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Injected from theme.php */

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: #ffffffd9;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      color: #000;
    }

    .table-responsive {
      overflow-x: auto;
      width: 100%;
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
      border: 1px solid rgba(0,0,0,0.4);
    }

    th {
      background-color: #0984e3;
      color: white;
      padding: 10px;
      text-align: left;
      border: 1px solid rgba(0,0,0,0.4);
    }

    td {
      padding: 10px;
      border: 1px solid rgba(0,0,0,0.4);
    }

    @media (max-width: 768px) {
      table {
        font-size: 13px;
        min-width: 500px;
      }
      td, th {
        padding: 8px;
      }
    }

    h1, h2 {
      color: #0984e3;
    }

    a {
      margin-right: 10px;
      text-decoration: none;
      font-weight: bold;
    }

    a.enable {
      color: green;
    }

    a.disable {
      color: red;
    }

    a:hover {
      text-decoration: underline;
    }

    .nav-links {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

    <!-- Centered Admin Help -->
    <div class="nav-links" style="text-align: center; margin-bottom: 10px;">
      <a href="admin_help.php"> 📘 Admin Help</a>
    </div>

    <!-- Other Admin Links -->
    <div class="nav-links" style="text-align: center;">
      <a href="admin_theme.php">🎨 Change Site Theme</a> |
      <a href="admin_trips.php">🧳 Manage User Trips</a> |
      <a href="admin_monitor.php">📊 Monitor Site</a> |
      <a href="profile.php">👤 Back to Profile</a> 
    </div>

    <h2>Registered Users</h2>
    <div class="table-responsive">
      <table>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Admin</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= $row['is_admin'] ? 'Yes' : 'No' ?></td>
            <td><?= $row['is_active'] ? 'Yes' : 'No' ?></td>
            <td>
              <?php if ($row['id'] == $_SESSION['user_id']): ?>
                <span style="color: gray;">(Cannot disable self)</span>
              <?php else: ?>
                <?php if ($row['is_active']): ?>
                  <a class="disable" href="admin_toggle.php?id=<?= $row['id'] ?>" onclick="return confirm('Disable this user account?');">Disable</a>
                <?php else: ?>
                  <a class="enable" href="admin_toggle.php?id=<?= $row['id'] ?>" onclick="return confirm('Enable this user account?');">Enable</a>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</body>
</html>
