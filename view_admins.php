<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Fetch all admins from the database
$result = $conn->query("SELECT * FROM admins");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View All Admins</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>All Admins</h1>
  
  <!-- Navigation -->
  <nav>
    <ul>
      <li><a href="admin_dashboard.php">Back to Dashboard</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
    <?php while ($admin = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $admin['name'] ?></td>
      <td><?= $admin['email'] ?></td>
      <td><?= $admin['phone'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
