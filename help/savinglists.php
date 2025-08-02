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
  <title>Saving Lists | PackPal Help</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Guide to saving your trip packing lists in PackPal.">
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
      <h1>💾 Saving Lists</h1>
    </div>

    <p>Once you've created a packing list, you can save it to your account for later access.</p>

    <div class="tip">💾 Log in or register to access the "Save This Trip" button on your packing list page.</div>
    <div class="tip">🗂️ Saved trips are stored under your profile and can be viewed or deleted anytime.</div>
    <div class="tip">🔄 You can regenerate packing lists anytime and save new ones!</div>

    <div class="back-link">
      <a href="index.php">← Back to Help Centre</a>
    </div>
  </div>
</body>
</html>
