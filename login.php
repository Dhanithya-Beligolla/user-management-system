<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check for the user in `users` table
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Check in `admins` table if not found in users
  if (!$user) {
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
  }

  // Validate password
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    if ($user['role'] === 'admin') {
      header('Location: admin_dashboard.php');
    } else {
      header('Location: user_dashboard.php');
    }
    exit;
  } else {
    echo "Invalid email or password!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-container">
    <form action="login.php" method="POST">
      <h2>Login</h2>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <button type="submit">Login</button>
      <p>Don't have an account?</p>
      <p><a href="signup_user.php">Sign Up as User</a></p>
      <p><a href="signup_admin.php">Sign Up as Admin</a></p>
    </form>
  </div>
</body>
</html>
