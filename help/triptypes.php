<?php
session_start();
include '../includes/db.php';

// Load theme from site_settings table if not already set
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));
include '../includes/theme.php'; // Loads $themeStyle
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trip Types | PackPal Help</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Guide to the different trip types in PackPal and how they affect packing lists.">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Apply dynamic background */

    body, p, div, span, td, th {
      color: #000 !important;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 30px;
      color: #0984e3;
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
      background-color: white;
      max-width: 700px;
      margin: 50px auto;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .tip {
      background-color: #ecf0f1;
      padding: 14px 18px;
      border-radius: 8px;
      margin: 10px 0;
      font-size: 17px;
      text-align: left;
    }

    .back-link {
      text-align: center;
      margin-top: 30px;
    }

    .icon-title {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
    }

    .icon-title img {
      width: 30px;
      height: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon-title">
      <h1>✈️ Trip Types</h1>
    </div>

    <p>PackPal supports four types of trips, each with its own tailored packing list:</p>

    <div class="tip">🏖️ <strong>Beach:</strong> Items like swimsuits, sunscreen, flip flops, and towels.</div>
    <div class="tip">❄️ <strong>Winter:</strong> Includes jackets, gloves, boots, and hand warmers.</div>
    <div class="tip">🏙️ <strong>City:</strong> Essentials like chargers, ID, camera, and reusable bags.</div>
    <div class="tip">🥾 <strong>Hiking:</strong> Focused on boots, water, maps, snacks, and first-aid kits.</div>

    <p>Choose the trip type that best matches your destination to get a relevant, smart packing list!</p>

    <div class="back-link">
      <a href="index.php">← Back to Help Centre</a>
    </div>
  </div>
</body>
</html>
