<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash password
    $account_type = $_POST['account_type'];

    // Insert user into the `users` table
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, account_type, role) VALUES (?, ?, ?, ?, ?, 'user')");
    $stmt->bind_param('sssss', $name, $email, $phone, $password, $account_type);

    if ($stmt->execute()) {
        echo "User registered successfully!";
        header('Location: login.php');
    } else {
        echo "Error: Could not register user. " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Sign Up</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="signup-container">
    <form action="signup_user.php" method="POST">
      <h2>User Sign Up</h2>
      <label for="name">Name:</label>
      <input type="text" name="name" required>
      <label for="email">Email:</label>
      <input type="email" name="email" required>
      <label for="phone">Phone:</label>
      <input type="text" name="phone" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <label for="account_type">Account Type:</label>
      <select name="account_type" required>
        <option value="Business">Business</option>
        <option value="Personal">Personal</option>
      </select>
      <button type="submit">Sign Up</button>
    </form>
  </div>
</body>
</html>
