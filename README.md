# User Management System

This is a simple **User Management System** built using **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript**. The system supports two roles: **Admin** and **User**, each with different levels of access and functionality.

Admins can view, edit, and reset user passwords, as well as manage other admins. Users can view and update their profile information.

## Table of Contents

- [Features](#features)
- [Project Stucture](#project-structure)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Database Setup](#database-setup)
- [Project Setup](#project-setup)
- [Run the project](#run-the-project)


## Features

### Admin Features:
- View all users and admins
- Edit user/admin profiles
- Reset user passwords
- Add new admins
- Logout

### User Features:
- View and update profile
- Change password
- Logout

### Security Features:
- Passwords are hashed for security
- Users cannot view or edit other users’ data
- Only admins have access to user management

## Project Structure

![image](https://github.com/user-attachments/assets/76af4b9b-d331-447f-993c-fdaa3fc7a445)

## Prerequisites

Before setting up the project, ensure that your device meets the following requirements:

- **Operating System:** Windows, macOS, or Linux.
- **Web Server:** Apache (recommended with XAMPP, WAMP, or MAMP).
- **PHP Version:** PHP 7.0 or higher.
- **Database Server:** MySQL 5.6 or higher.
- **Web Browser:** Latest version of Chrome, Firefox, or Edge.

## Installation

Follow these steps to set up the project:

### 1. Install a Web Server with PHP and MySQL

- **Windows:** Download and install [XAMPP](https://www.apachefriends.org/index.html).
- **macOS:** Download and install [MAMP](https://www.mamp.info/en/).
- **Linux:** Install Apache, PHP, and MySQL using your distribution's package manager.

### 2. Start Apache and MySQL Services

- Open the control panel of your web server package (e.g., XAMPP Control Panel).
- Start the **Apache** and **MySQL** services.

## Database Setup

### 1. Access phpMyAdmin

- Open your web browser and navigate to `(http://localhost/phpmyadmin/)`.

### 2. Create a New Database

- Click on **New** in the left sidebar.
- Enter the database name as `user_management`.
- Choose **utf8_general_ci** as the collation.
- Click **Create**.

### 3. Create Required Tables

Run the following SQL queries in phpMyAdmin to create the necessary tables:

#### a. `admins` Table

```sql
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') DEFAULT 'admin',
  PRIMARY KEY (`id`)
);
```

### b. `users` Table

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('Business', 'Personal') NOT NULL,
  `role` enum('user') DEFAULT 'user',
  PRIMARY KEY (`id`)
);
```

## Project setup

### 1. Clone the Repository

To clone this repository to your local machine, open your terminal from `htdocs` folder of your `XAMPP` or `WAMP` server and run:

```bash
git clone https://github.com/Dhanithya-Beligolla/user-management-system.git
```
### 2. Configure the `db.php` file.

```php
<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";     // Change this if you have set a password for MySQL
$dbname = "user_management";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

## Run the project

- Open your browser and go to `http://localhost/user-management-system/login.php`.

## Usage

### 1. Admin Dashboard:
- After logging in as an admin, you will be redirected to the Admin Dashboard.
- From here, you can view all users and admins, edit profiles, and reset user passwords.

### 2. User Dashboard:
- Users can view and update their profiles and change their password.
  
### 3. Editing Profiles:
- Users can edit their name, email, and phone number. They can also change their password by clicking the "Change Password" button.

### 4. Resetting Passwords (Admin Only):
- Admins can reset any user's password from the View All Users page.




