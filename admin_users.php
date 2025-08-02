<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Load theme
if (!isset($_SESSION['theme'])) {
    $result = $conn->query("SELECT value FROM site_settings WHERE setting = 'theme'");
    $_SESSION['theme'] = $result->fetch_assoc()['value'] ?? 'tropical';
}
$theme = $_SESSION['theme'];
include 'includes/theme.php'; // Injects $themeStyle

$result = $conn->query("SELECT id, username, email, is_admin, is_active, created_at FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users | PackPal Admin</title>
    <meta name="description" content="Admin dashboard for managing user accounts on PackPal. Enable, disable, or review users.">
    <meta name="keywords" content="admin, user management, PackPal, enable user, disable user">
    <meta name="author" content="PackPal Team">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        <?= $themeStyle ?> /* Inject theme gradient */

        body, td, th, p, span, div {
            color: #000000 !important;
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            color: #0984e3 !important;
        }

        a {
            color: #0984e3 !important;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #ffffffdd;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
            margin-top: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            background-color: #0984e3;
            color: white !important;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            table {
                font-size: 13px;
                min-width: 500px;
            }
            th, td {
                padding: 8px;
            }
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage User Accounts</h1>

        <div class="table-responsive">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Active</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= $row['is_admin'] ? 'Yes' : 'No' ?></td>
                        <td><?= $row['is_active'] ? 'Yes' : 'No' ?></td>
                        <td><?= $row['created_at'] ?? '—' ?></td>
                        <td>
                            <?php if ($row['id'] != $_SESSION['user_id']): ?>
                                <a href="admin_toggle.php?id=<?= $row['id'] ?>">
                                    <?= $row['is_active'] ? 'Disable' : 'Enable' ?>
                                </a>
                            <?php else: ?>
                                <em>Current Admin</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <p style="margin-top: 20px;"><a href="admin.php">← Back to Admin Dashboard</a></p>

        <footer>&copy; 2025 PackPal Admin</footer>
    </div>
</body>
</html>
