<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

// Fetch the current password from the database (hashed)
$current_password = $user['password'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // If the password field is not empty, update the password
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash new password
    } else {
        $password = $current_password;  // Keep the current password if not changed
    }

    // Update user details based on role (admin or user)
    if ($user['role'] === 'admin') {
        $stmt = $conn->prepare("UPDATE admins SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $name, $email, $phone, $password, $user['id']);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $name, $email, $phone, $password, $user['id']);
    }

    if ($stmt->execute()) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone'] = $phone;
        echo "<p>Profile updated successfully!</p>";
        header('Location: ' . $user['role'] . '_dashboard.php');
    } else {
        echo "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function enablePasswordChange() {
      document.getElementById('password').removeAttribute('readonly');  // Make password field editable
      document.getElementById('password').value = '';  // Clear the field for new input
      document.getElementById('change-password-btn').style.display = 'none';  // Hide change password button
      document.getElementById('password-label').innerText = 'New Password';  // Change label to New Password
    }
  </script>
</head>
<body>
  <h1>Edit Profile</h1>
  <form action="edit_profile.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= $user['name'] ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?= $user['phone'] ?>" required>

    <!-- Password Section -->
    <label for="password" id="password-label">Current Password:</label>
    <input type="password" id="password" name="password" value="********" readonly required>

    <!-- Change Password Button -->
    <button type="button" id="change-password-btn" onclick="enablePasswordChange()">Change Password</button>

    <button type="submit">Update Profile</button>
  </form>
</body>
</html>
