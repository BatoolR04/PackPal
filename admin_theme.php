<?php
session_start();
include 'includes/db.php';

// Redirect if not admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
  header("Location: login.php");
  exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['theme'])) {
  $selected = $_POST['theme'];
  $stmt = $conn->prepare("UPDATE site_settings SET value = ? WHERE setting = 'theme'");
  $stmt->bind_param("s", $selected);
  $stmt->execute();
  $_SESSION['theme'] = $selected; // Apply immediately
  header("Location: admin_theme.php?success=1");
  exit();
}

// Load current theme
$theme = $_SESSION['theme'] ?? 'tropical';

$themeGradients = [
  'tropical' => 'linear-gradient(to right, #fff176, #ffb74d, #f06292, #ba68c8, #64b5f6)',
  'city' => 'linear-gradient(to right, #cfd8dc, #b0bec5, #90a4ae, #78909c, #546e7a)',
  'nature'   => 'linear-gradient(to right, #fff59d, #aed581, #81c784, #66bb6a, #388e3c)',
  'dark'     => 'linear-gradient(to right, #1c1c1c, #121212, #0e0e0e, #050505)'
];

$background = $themeGradients[$theme] ?? $themeGradients['tropical'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Site Theme | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: <?= $background ?>;
      background-attachment: fixed;
      background-size: cover;
      color: #2d3436;
    }
    .container {
      max-width: 600px;
      margin: 60px auto;
      background: #ffffffdd;
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 0 12px rgba(0,0,0,0.2);
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
    }
    select, button {
      font-size: 1rem;
      padding: 10px;
      margin: 15px 0;
      width: 80%;
      max-width: 300px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .back-link {
      display: inline-block;
      margin-top: 20px;
      color: #0984e3;
      text-decoration: none;
      font-weight: bold;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    .success {
      color: green;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🎨 Change Site Theme</h1>

    <form method="post">
      <select name="theme" required>
        <option value="tropical" <?= $theme == 'tropical' ? 'selected' : '' ?>>Tropical</option>
        <option value="city" <?= $theme == 'city' ? 'selected' : '' ?>>City</option>
        <option value="nature" <?= $theme == 'nature' ? 'selected' : '' ?>>Nature</option>
        <option value="dark" <?= $theme == 'dark' ? 'selected' : '' ?>>Dark</option>
      </select>
      <br>
      <button type="submit">Apply Theme</button>
    </form>

    <?php if (isset($_GET['success'])): ?>
      <p class="success">✅ Theme updated successfully!</p>
    <?php endif; ?>

    <a class="back-link" href="admin.php">← Back to Admin Dashboard</a>
  </div>
</body>
</html>
