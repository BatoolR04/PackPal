<?php
session_start();
include '../includes/db.php';

// Load theme from session or DB
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));
include '../includes/theme.php'; // sets $themeStyle
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>How to Use | PackPal Help</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Learn how to use the PackPal packing planner step-by-step.">
  <style>
    <?= $themeStyle ?> /* dynamic theme background */

    body, td, th, span, p, div {
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
      font-weight: bold;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      background-color: #ffffffd9;
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
      <h1>How to Use PackPal</h1>
    </div>

    <div class="tip">🗺️ <strong>Step 1:</strong> Fill out your trip details on the trip form – including destination, type, and dates.</div>
    <div class="tip">📋 <strong>Step 2:</strong> Once submitted, your personalized packing list will be generated automatically.</div>
    <div class="tip">✅ <strong>Step 3:</strong> Check off items as you pack to track your progress.</div>
    <div class="tip">💾 <strong>Step 4:</strong> If logged in, you can save your trip to your account for future use.</div>
    <div class="tip">🖨️ <strong>Step 5:</strong> You can also print or download the list as a TXT file for travel convenience.</div>

    <p>PackPal is designed to make planning stress-free and fun. Try it out and travel smart!</p>

    <div class="back-link">
      <a href="index.php">← Back to Help Centre</a>
    </div>
  </div>
</body>
</html>
