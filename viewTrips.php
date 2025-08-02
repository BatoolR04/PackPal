<?php
session_start();
include 'includes/db.php';

// Load theme from site_settings table
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));
include 'includes/theme.php'; // Loads $themeStyle

// Fetch all trips from the database
$sql = "SELECT * FROM trips ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Planned Trips</title>
  <meta name="description" content="View all planned trips created by users using PackPal. Explore trip types, destinations, and travel dates.">
  <meta name="keywords" content="PackPal trip list, all trips, planned vacations, travel history">
  <meta name="author" content="PackPal Team">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    <?= $themeStyle ?> /* Dynamic theme background */

    body, td, th, span, p, div {
      color: #000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
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
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
      background: #ffffffd9;
      border-radius: 12px;
      margin-top: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .table-responsive {
      overflow-x: auto;
      width: 100%;
      margin-top: 20px;
    }

    .trip-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    .trip-table th, .trip-table td {
      padding: 10px;
      border: 1px solid rgba(0,0,0,0.4);
      text-align: center;
    }

    .trip-table th {
      background-color: rgba(173, 216, 230, 0.8); /* Light blue */
      color: #000;
    }

    .trip-table tr:hover {
      background-color: #f1f1f1;
    }

    .back-link {
      margin-top: 20px;
      display: inline-block;
      text-decoration: none;
      padding: 10px 20px;
      background-color: rgba(173, 216, 230, 0.8); /* Light blue */
      color: #000;
      border-radius: 8px;
      font-weight: bold;
    }

    .back-link:hover {
      background-color: rgba(173, 216, 230, 1);
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 15px;
      }

      .trip-table {
        font-size: 13px;
        min-width: 500px;
      }

      .trip-table th, .trip-table td {
        padding: 8px;
      }

      .back-link {
        font-size: 14px;
        padding: 8px 16px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>All Planned Trips</h1>

    <?php if ($result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="trip-table">
          <tr>
            <th>ID</th>
            <th>Destination</th>
            <th>Trip Type</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['destination']) ?></td>
              <td><?= htmlspecialchars($row['trip_type']) ?></td>
              <td><?= htmlspecialchars($row['start_date']) ?></td>
              <td><?= htmlspecialchars($row['end_date']) ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    <?php else: ?>
      <p>No trips have been added yet.</p>
    <?php endif; ?>

    <a class="back-link" href="tripForm.php">← Back to Trip Planner</a>
  </div>
</body>
</html>
