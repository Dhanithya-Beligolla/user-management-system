<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash password

    // Insert admin into the `admins` table
    $stmt = $conn->prepare("INSERT INTO admins (name, email, phone, password, role) VALUES (?, ?, ?, ?, 'admin')");
    $stmt->bind_param('ssss', $name, $email, $phone, $password);

    if ($stmt->execute()) {
        echo "Admin registered successfully!";
        header('Location: login.php');
    } else {
        echo "Error: Could not register admin. " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Sign Up</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="signup-container">
    <form action="signup_admin.php" method="POST">
      <h2>Admin Sign Up</h2>
      <label for="name">Name:</label>
      <input type="text" name="name" required>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="phone">Phone:</label>
      <input type="text" name="phone" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <button type="submit">Sign Up</button>
    </form>
  </div>
</body>
</html>
