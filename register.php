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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | PackPal</title>
  <meta name="description" content="Create an account on PackPal to plan and save your trips.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?>

    body, p, label, input, a {
      font-family: 'Segoe UI', sans-serif;
      color: #000 !important;
    }

    h1 {
      color: #0984e3 !important;
      text-align: center;
      margin-bottom: 20px;
    }

    .container {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      background: #ffffffdd;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    input[type="submit"] {
      background-color: #0984e3;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #74b9ff;
    }

    .login-link {
      margin-top: 15px;
      text-align: center;
    }

    .terms-note {
      font-size: 0.9em;
      color: #555;
      text-align: center;
      margin-top: -5px;
    }

    a {
      color: #0984e3 !important;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.9em;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Account</h1>
    <form method="POST" action="register_handler.php">
      <label>Username: <input type="text" name="username" required></label>
      <label>Email: <input type="email" name="email" required></label>
      <label>Password: <input type="password" name="password" required></label>

      <p class="terms-note">
        By creating an account, you agree to our 
        <a href="terms.html" target="_blank">Terms of Service</a> and 
        <a href="privacy.html" target="_blank">Privacy Policy</a>.
      </p>

      <input type="submit" value="Register">
    </form>
    <div class="login-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
  <footer>
    &copy; 2025 PackPal. All rights reserved. |
    <a href="terms.html">Terms</a> |
    <a href="privacy.html">Privacy</a> |
    <a href="sitemap.html">Sitemap</a>
  </footer>
</body>
</html>
