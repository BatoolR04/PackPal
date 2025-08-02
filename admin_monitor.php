<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

// Load theme
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];

include 'includes/theme.php'; // Injects $themeStyle

// Counts
$userCount = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$tripCount = $conn->query("SELECT COUNT(*) as total FROM trips")->fetch_assoc()['total'];

// Most common trip type
$typeResult = $conn->query("SELECT trip_type, COUNT(*) as count FROM trips GROUP BY trip_type ORDER BY count DESC LIMIT 1");
$commonType = $typeResult->num_rows > 0 ? $typeResult->fetch_assoc()['trip_type'] : 'N/A';

// Recent 5 trips
$recentTrips = $conn->query("SELECT trips.*, users.username FROM trips JOIN users ON trips.user_id = users.id ORDER BY trips.id DESC LIMIT 5");

// Simulate service status
$databaseStatus = ($conn->ping()) ? "Online" : "Offline";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Site Monitor | PackPal Admin</title>
  <meta name="description" content="Admin monitoring page for PackPal: track database, user activity, trip stats.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="PackPal Team">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Dynamic background */

    body, td, th, span, p, div {
      color: #000000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      color: #0984e3 !important;
    }

    h2 {
      color: #2d3436;
    }

    a {
      color: #0984e3 !important;
      font-weight: bold;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: #ffffffd9;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .stat {
      font-size: 1.2em;
      margin: 15px 0;
    }

    .stat span {
      font-weight: bold;
      color: #0984e3 !important;
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
      color: white !important;
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

    .status {
      font-weight: bold;
      color: green !important;
    }

    .offline {
      color: red !important;
    }

    .back-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #0984e3;
      color: white !important;
      border-radius: 6px;
    }

    .back-btn:hover {
      background-color: #74b9ff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Site Monitoring Dashboard</h1>

    <div class="stat">📡 <strong>Database Status:</strong> <span class="<?= $databaseStatus === 'Online' ? 'status' : 'offline' ?>"><?= $databaseStatus ?></span></div>
    <div class="stat">👥 <strong>Total Registered Users:</strong> <span><?= $userCount ?></span></div>
    <div class="stat">🎒 <strong>Total Trips Planned:</strong> <span><?= $tripCount ?></span></div>
    <div class="stat">🏷️ <strong>Most Popular Trip Type:</strong> <span><?= $commonType ?></span></div>

    <h2>🕒 Recent 5 Trips</h2>
    <div class="table-responsive">
      <table>
        <tr>
          <th>User</th>
          <th>Destination</th>
          <th>Trip Type</th>
          <th>Start</th>
          <th>End</th>
        </tr>
        <?php while ($trip = $recentTrips->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($trip['username']) ?></td>
            <td><?= htmlspecialchars($trip['destination']) ?></td>
            <td><?= htmlspecialchars($trip['trip_type']) ?></td>
            <td><?= htmlspecialchars($trip['start_date']) ?></td>
            <td><?= htmlspecialchars($trip['end_date']) ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <a href="admin.php" class="back-btn">← Back to Admin Dashboard</a>
  </div>
</body>
</html>
