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
  <title>Customizing Items | PackPal Help</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Instructions on how to customize your PackPal packing list.">
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
      <h1>🛠️ Customizing Items</h1>
    </div>

    <p>Your packing list is just the starting point! You can customize it further to suit your unique needs.</p>

    <div class="tip">📝 Use the checkboxes to mark items you’ve packed. You can uncheck them anytime.</div>
    <div class="tip">➕ If you’d like to add your own custom items, look for the “Edit” or “Customize” option (coming soon!).</div>
    <div class="tip">🗑️ You can also ignore certain items by simply not checking them - they won’t appear in your printout or download.</div>

    <p>We’re always improving - so stay tuned for new ways to personalize your list!</p>

    <div class="back-link">
      <a href="index.php">← Back to Help Centre</a>
    </div>
  </div>
</body>
</html>
