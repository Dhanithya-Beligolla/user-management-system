<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Admin Dashboard</h1>
  <h2>Welcome, <?= $_SESSION['user']['name'] ?></h2>

  <!-- Navigation -->
  <nav>
    <ul>
      <li><a href="view_users.php">View All Users</a></li>
      <li><a href="view_admins.php">View All Admins</a></li>
      <li><a href="edit_profile.php">Edit Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</body>
</html>
