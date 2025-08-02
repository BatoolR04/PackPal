<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to PackPal</title>
  <meta name="description" content="PackPal is your smart travel companion. Create personalized packing lists, save trips, and manage your travel plans easily.">
  <meta name="keywords" content="packing list, trip planner, travel app, PackPal">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: url('assets/images/cover.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      color: white;
      text-align: center;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.85);
      padding: 60px 30px;
      border-radius: 12px;
      max-width: 700px;
      margin: 100px auto;
    }

    h1 {
      font-size: 3em;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.2em;
      margin-bottom: 30px;
      color: white;
    }

    .black-text {
      color: black;
    }

    .buttons {
      margin-top: 30px;
    }

    .buttons a {
      text-decoration: none;
      color: white;
      background: #0984e3;
      padding: 12px 24px;
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
    <h1>Welcome to PackPal</h1>
    <p class="black-text">Your smart travel companion. Plan trips, get customized packing lists, and manage everything in one place.</p>

    <div class="buttons">
      <a href="tripForm.php">Start Planning</a>
      <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      <?php else: ?>
        <a href="profile.php">My Profile</a>
      <?php endif; ?>
      <a href="help/index.php">Need Help?</a>
    </div>
  </div>
</body>
</html>
