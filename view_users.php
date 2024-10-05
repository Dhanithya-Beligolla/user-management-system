<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Fetch all users from the database
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View All Users</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>All Users</h1>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Account Type</th>
      <th>Actions</th>
    </tr>
    <?php while ($user = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $user['name'] ?></td>
      <td><?= $user['email'] ?></td>
      <td><?= $user['phone'] ?></td>
      <td><?= $user['account_type'] ?></td>
      <td>
        <a href="reset_password.php?id=<?= $user['id'] ?>">Reset Password</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>

  <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
