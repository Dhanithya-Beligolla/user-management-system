<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Get the user's ID from the URL
$user_id = $_GET['id'];

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param('si', $new_password, $user_id);

    if ($stmt->execute()) {
        header('Location: view_users.php');
    } else {
        echo "Error resetting password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password for <?= $user['name'] ?></title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Reset Password for <?= $user['name'] ?></h1>

  <form action="reset_password.php?id=<?= $user_id ?>" method="POST">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>
    <button type="submit">Reset Password</button>
  </form>

  <a href="view_users.php">Back to Users List</a>
</body>
</html>
