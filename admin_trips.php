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

$message = '';

// Delete trip if requested
if (isset($_GET['delete_id'])) {
  $id = $_GET['delete_id'];
  $stmt = $conn->prepare("DELETE FROM trips WHERE id = ?");
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
    $message = "Trip deleted successfully.";
  }
  $stmt->close();
  header("Location: admin_trips.php?msg=" . urlencode($message));
  exit();
}

// Fetch all trips
$result = $conn->query("SELECT trips.id, destination, trip_type, start_date, end_date, username 
                        FROM trips JOIN users ON trips.user_id = users.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Trip Management | PackPal</title>
  <meta name="description" content="Admin dashboard for managing all user trips in PackPal. View, delete, and oversee submitted trip plans.">
  <meta name="keywords" content="admin trips, manage trips, PackPal admin, trip deletion">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="PackPal Team">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Injects background gradient */

    body, td, th, p, span, div {
      color: #000000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      color: #0984e3 !important;
    }

    a {
      color: #0984e3 !important;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background: #ffffffd9;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
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
    }

    table, th, td {
      border: 1px solid rgba(0,0,0,0.4);
    }

    th {
      background-color: #0984e3;
      color: white !important;
      padding: 10px;
      text-align: left;
    }

    td {
      padding: 10px;
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

    .msg {
      color: green;
      font-weight: bold;
      margin-top: 10px;
    }

    footer {
      text-align: center;
      margin-top: 30px;
      font-size: 0.9em;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>All User Trips</h1>
      <?php if (isset($_GET['msg'])): ?>
        <p class="msg"><?= htmlspecialchars($_GET['msg']) ?></p>
      <?php endif; ?>
    </header>

    <main>
      <div class="table-responsive">
        <table>
          <tr>
            <th>User</th>
            <th>Destination</th>
            <th>Trip Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['destination']) ?></td>
              <td><?= htmlspecialchars($row['trip_type']) ?></td>
              <td><?= htmlspecialchars($row['start_date']) ?></td>
              <td><?= htmlspecialchars($row['end_date']) ?></td>
              <td>
                <a href="admin_edit_trip.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this trip?')">🗑️ Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>

      <p style="margin-top: 20px;"><a href="admin.php">← Back to Admin Dashboard</a></p>
    </main>

    <footer>
      &copy; 2025 PackPal Admin Panel
    </footer>
  </div>
</body>
</html>
