<?php
session_start();
include 'includes/db.php';

// Load theme from DB only if not already set
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];

include 'includes/theme.php'; // Injects $themeStyle

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $destination = $_POST['destination'];
  $trip_type = $_POST['trip_type'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  $_SESSION['trip_type'] = $trip_type;

  $stmt = $conn->prepare("INSERT INTO trips (destination, trip_type, start_date, end_date) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $destination, $trip_type, $start_date, $end_date);
  $stmt->execute();
  $stmt->close();

  header("Location: listView.php?destination=$destination&trip_type=$trip_type&start_date=$start_date&end_date=$end_date");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plan Your Trip | PackPal</title>
  <meta name="description" content="Plan your perfect trip with PackPal – get personalized packing lists based on your destination and travel type.">
  <meta name="keywords" content="travel planner, packing list, trip planning, PackPal, vacation checklist, luggage prep">
  <meta name="author" content="PackPal Team">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?>

    body, p, label, input, select, h1, h2, h3, footer {
      color: #000 !important;
    }

    a {
      color: #0984e3 !important;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #3498db;
      color: white;
      padding: 20px 0;
      position: relative;
    }

    .header-inner {
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header-inner h1 {
      margin: 0;
      font-size: 28px;
    }

    .header-inner img {
      height: 60px;
      margin-right: 15px;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffffdd;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    button {
      background-color: #00b894;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #26a69a;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #777;
      font-size: 0.9em;
    }

    details {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 10;
    }

    details summary {
      background: white;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      color: #3498db;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      list-style: none;
    }

    details[open] > summary::after {
      content: "▲";
      float: right;
      margin-left: 10px;
    }

    details summary::after {
      content: "▼";
      float: right;
      margin-left: 10px;
    }

    details ul {
      background: rgba(0, 0, 0, 0.6); 
      list-style: none;
      margin: 0;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      position: absolute;
      right: 0;
      top: 40px;
      width: 200px;
      z-index: 1001;
    }

    details ul li {
      margin: 0;
      padding: 0;
      background: transparent;
      list-style: none;
    }

    details ul li a {
      display: block;
      background-color: white;
      padding: 10px 14px;
      margin: 8px 0;
      border-radius: 8px;
      color: #3498db;
      font-weight: normal;
      text-align: center;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    }

    details ul li a:hover {
      background-color: #3498db;
      color: white !important;
      font-weight: bold;
    }

    /* MOBILE FRIENDLY OVERRIDES */
    @media (max-width: 768px) {
      .header-inner {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
        gap: 10px;
      }

      .header-inner h1 {
        font-size: 22px;
      }

      .header-inner img {
        height: 50px;
        margin: 0 0 10px 0;
      }

      .container {
        width: 90%;
        padding: 20px;
      }

      input, select, button {
        font-size: 16px;
      }

      details {
        position: static;
        margin-top: 10px;
        width: 100%;
      }

      details ul {
        position: static;
        width: 100%;
        background: #ffffff;
        box-shadow: none;
        padding: 10px;
        border-radius: 10px;
      }

      details ul li a {
        margin: 6px 0;
      }

      footer {
        padding: 15px 10px;
        font-size: 0.85em;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="header-inner">
      <div style="display: flex; align-items: center;">
        <img src="assets/images/luggage.png" alt="Luggage Icon">
        <h1>Plan Your Trip</h1>
      </div>

      <details>
        <summary>Need Help?</summary>
        <ul>
          <li><a href="help/howtopack.php">How to Pack</a></li>
          <li><a href="help/saving.php">Saving Lists</a></li>
          <li><a href="help/triptypes.php">Trip Types</a></li>
          <li><a href="help/customizing.php">Customizing Items</a></li>
          <li><a href="help/admin.php">Admin Features</a></li>
          <li><a href="faq.html">FAQ</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </details>
    </div>
  </header>

  <div class="container">
    <form method="post" action="">
      <label for="destination">Destination:</label>
      <input type="text" id="destination" name="destination" placeholder="e.g. Paris, Miami, Tokyo" required>

      <label for="trip_type">Trip Type:</label>
      <select id="trip_type" name="trip_type" required>
        <option value="">--Select--</option>
        <option value="Beach">Beach</option>
        <option value="Winter">Winter</option>
        <option value="City">City</option>
        <option value="Hiking">Hiking</option>
      </select>

      <label for="start_date">Start Date:</label>
      <input type="date" id="start_date" name="start_date" required>

      <label for="end_date">End Date:</label>
      <input type="date" id="end_date" name="end_date" required>

      <button type="submit">Generate Packing List</button>
    </form>
  </div>

  <footer>
    &copy; 2025 PackPal. All rights reserved. |
    <a href="terms.html">Terms</a> |
    <a href="privacy.html">Privacy</a>  </footer>
</body>
</html>
