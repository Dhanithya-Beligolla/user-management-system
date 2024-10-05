<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>User Dashboard</h1>
  <h2>Welcome, <?= $_SESSION['user']['name'] ?></h2>

  <!-- Navigation Menu -->
  <nav>
    <ul>
      <li><a href="user_dashboard.php">Dashboard</a></li>
      <li><a href="edit_profile.php">Edit Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <h3>User Functions</h3>
  <!-- User-specific content -->
</body>
</html>
