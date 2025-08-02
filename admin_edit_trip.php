<?php
session_start();
include 'includes/db.php';

// Redirect if not admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

// Get trip ID from URL
$trip_id = $_GET['id'] ?? null;

if (!$trip_id) {
  echo "No trip ID provided.";
  exit();
}

// Fetch trip details
$stmt = $conn->prepare("SELECT * FROM trips WHERE id = ?");
$stmt->bind_param("i", $trip_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
  echo "Trip not found.";
  exit();
}

$trip = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $destination = trim($_POST['destination']);
  $trip_type = trim($_POST['trip_type']);
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  $update = $conn->prepare("UPDATE trips SET destination=?, trip_type=?, start_date=?, end_date=? WHERE id=?");
  $update->bind_param("ssssi", $destination, $trip_type, $start_date, $end_date, $trip_id);
  
  if ($update->execute()) {
    header("Location: admin_trips.php?msg=updated");
    exit();
  } else {
    $error = "Update failed.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Trip | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f8ff;
      margin: 0;
      padding: 20px;
    }

    .container {
      background: white;
      padding: 30px;
      max-width: 600px;
      margin: 50px auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #0984e3;
      margin-bottom: 20px;
      text-align: center;
    }

    label {
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background: #0984e3;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background: #0b66c3;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      text-decoration: none;
      color: #0984e3;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Trip (ID: <?= $trip_id ?>)</h2>

    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="post">
      <label>Destination</label>
      <input type="text" name="destination" value="<?= htmlspecialchars($trip['destination']) ?>" required>

      <label>Trip Type</label>
      <select name="trip_type" required>
        <option value="Beach" <?= $trip['trip_type'] === 'Beach' ? 'selected' : '' ?>>Beach</option>
        <option value="City" <?= $trip['trip_type'] === 'City' ? 'selected' : '' ?>>City</option>
        <option value="Hiking" <?= $trip['trip_type'] === 'Hiking' ? 'selected' : '' ?>>Hiking</option>
        <option value="Winter" <?= $trip['trip_type'] === 'Winter' ? 'selected' : '' ?>>Winter</option>
      </select>

      <label>Start Date</label>
      <input type="date" name="start_date" value="<?= $trip['start_date'] ?>" required>

      <label>End Date</label>
      <input type="date" name="end_date" value="<?= $trip['end_date'] ?>" required>

      <button type="submit">Update Trip</button>
    </form>

    <div class="back-link">
      <a href="admin_trips.php">← Back to Manage Trips</a>
    </div>
  </div>
</body>
</html>
