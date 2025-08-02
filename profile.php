<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Load theme
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];
include 'includes/theme.php';

$user_id = $_SESSION['user_id'];

// Fetch trips for this user
$stmt = $conn->prepare("SELECT * FROM trips WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Trips - PackPal</title>
  <meta name="description" content="View and manage your saved trips on PackPal. Access your destinations, trip types, and travel dates.">
  <meta name="keywords" content="saved trips, PackPal, travel history, trip management">
  <meta name="author" content="PackPal Team">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Theme gradient */

    body, h1, th, td, p, a {
      color: #000000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      color: #0984e3 !important;
      text-align: center;
      margin-top: 40px;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background: #ffffffd9;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table-responsive {
      overflow-x: auto;
      margin-top: 20px;
      width: 100%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    th, td {
      padding: 12px;
      border: 1px solid rgba(0,0,0,0.4);
      text-align: center;
    }

    th {
      background-color: #0984e3;
      color: white !important;
    }

    .delete-btn {
      color: red;
      text-decoration: none;
      font-weight: bold;
      background: none;
      border: none;
      cursor: pointer;
    }

    .delete-btn:hover {
      text-decoration: underline;
    }

    a {
      color: #0984e3 !important;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    p.no-trips {
      text-align: center;
      font-size: 1.1em;
      margin-top: 40px;
    }

    .nav-links {
      text-align: center;
      margin-top: 30px;
    }

    .nav-links a {
      margin: 0 10px;
    }

    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 15px;
      }

      table {
        font-size: 14px;
      }

      th, td {
        padding: 10px;
      }

      .delete-btn {
        font-size: 13px;
      }

      .nav-links a {
        display: block;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Your Saved Trips</h1>

    <?php if ($result->num_rows > 0): ?>
      <div class="table-responsive">
        <table>
          <tr>
            <th>Destination</th>
            <th>Trip Type</th>
            <th>Start</th>
            <th>End</th>
            <th>Action</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['destination']) ?></td>
              <td><?= htmlspecialchars($row['trip_type']) ?></td>
              <td><?= htmlspecialchars($row['start_date']) ?></td>
              <td><?= htmlspecialchars($row['end_date']) ?></td>
              <td>
                <form method="POST" action="deleteTrip.php" onsubmit="return confirm('Are you sure you want to delete this trip?');">
                  <input type="hidden" name="trip_id" value="<?= $row['id'] ?>">
                  <button class="delete-btn" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    <?php else: ?>
      <p class="no-trips">You have not saved any trips yet.</p>
    <?php endif; ?>

    <div class="nav-links">
      <a href="tripForm.php">← Plan a New Trip</a> |
      <a href="dashboard.php">Back to Dashboard</a> |
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
