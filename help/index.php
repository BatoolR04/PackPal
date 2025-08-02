<?php
session_start();
include '../includes/db.php';

// Load admin theme if available
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = strtolower(trim($_SESSION['theme']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Help Index | PackPal</title>
  <meta name="description" content="Central help index for PackPal. Find all user guides and tips here.">
  <meta name="keywords" content="PackPal help, travel packing guide, trip planner support">
  <meta name="author" content="PackPal Team">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme-<?= $theme ?>.css">
  <style>
    body {
      background: url('../assets/images/cover.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.85);
      padding: 60px 30px;
      border-radius: 12px;
      max-width: 800px;
      margin: 80px auto;
      color: black;
    }

    h1 {
      font-size: 2.8em;
      margin-bottom: 20px;
      color: #0984e3;
    }

    p {
      font-size: 1.1em;
      margin-bottom: 20px;
      text-align: left;
    }

    ul {
      list-style: none;
      padding-left: 0;
      text-align: left;
    }

    a {
      text-decoration: none;
    }

    a li {
      background-color: #ecf0f1;
      margin: 6px 0;
      padding: 10px 14px;
      border-radius: 10px;
      font-size: 15px;
      font-weight: bold;
      color: #0984e3;
      transition: all 0.3s ease;
    }

    a:hover li {
      background-color: #0984e3;
      color: white;
    }

    .buttons {
      margin-top: 30px;
    }

    .buttons a {
      text-decoration: none;
      color: white;
      background: #0984e3;
      padding: 10px 20px;
      border-radius: 8px;
      margin: 10px;
      display: inline-block;
      font-weight: bold;
    }

    .buttons a:hover {
      background: #74b9ff;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h1>📚 Help Centre</h1>
    <p>Explore our helpful guides to get the most out of PackPal:</p>

    <ul>
      <a href="howto.php"><li>🧭 How to Use PackPal</li></a>
      <a href="howtopack.php"><li>🎒 Packing Tips</li></a>
      <a href="savinglists.php"><li>💾 Saving Your Trip Lists</li></a>
      <a href="triptypes.php"><li>🌍 Trip Type Differences</li></a>
      <a href="customizing.php"><li>🛠️ Customizing Items</li></a>
      <a href="adminfeatures.php"><li>🧑‍💼 Admin Dashboard Guide</li></a>
      <a href="../faq.html"><li>❓ FAQ</li></a>
    </ul>

    <div class="buttons">
      <a href="../about.php">← About Us</a>
      <a href="../tripForm.php">Plan a Trip</a>
      <a href="../contact.html">Contact Us</a>
    </div>
  </div>
</body>
</html>
