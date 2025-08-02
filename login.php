<?php
session_start();
include 'includes/db.php';

// Load theme
if (!isset($_SESSION['theme'])) {
  $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
  $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];
include 'includes/theme.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $username, $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $user = $result->fetch_assoc()) {
    if (!$user['is_active']) {
      $error = "Your account has been deactivated. Please contact support.";
    } elseif (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['is_admin'] = $user['is_admin'];
      $_SESSION['is_active'] = $user['is_active'];

      if ($user['is_admin'] == 1) {
        header("Location: admin.php");
      } else {
        header("Location: dashboard.php");
      }
      exit();
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "Username or email not found.";
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | PackPal</title>
  <meta name="description" content="Login to your PackPal account to access saved trips, packing lists, and travel features.">
  <meta name="keywords" content="PackPal login, travel app login, trip planner, packing list access">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    <?= $themeStyle ?> /* Dynamic background */

    body, h1, p, label, input, button {
      color: #000000 !important;
    }

    h1 {
      color: #0984e3 !important;
      margin-top: 40px;
      text-align: center;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #ffffffcc;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-box {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 15px;
      font-weight: bold;
    }

    input {
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      margin-top: 20px;
      padding: 10px;
      background-color: #0984e3;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background-color: #74b9ff;
    }

    .error-message {
      color: red;
      font-weight: bold;
      text-align: center;
      margin-bottom: 15px;
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
      color: #555;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Login</h1>
    </div>
  </header>

  <main>
    <div class="container">
      <?php if ($error): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="POST" class="form-box">
        <label for="username">Username or Email:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
      </form>

      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </main>

  <footer>
    &copy; 2025 PackPal. All rights reserved. |
    <a href="terms.html">Terms</a> |
    <a href="privacy.html">Privacy</a> |
    <a href="sitemap.html">Sitemap</a>
  </footer>
</body>
</html>
