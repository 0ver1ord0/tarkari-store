<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not an admin, redirect to the login page
    header("Location: login.php");
    exit();
}

// Admin can now add, edit, delete vegetables
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css"> <!-- Optional: link to a CSS file for styling -->
</head>
<body>
    <div class="admin-container">
        <h1>Welcome, Admin!</h1>
        <p>As an admin, you can manage vegetables and other data.</p>
        
        <!-- Links to add and manage vegetables -->
        <a href="add_vegetable.php">Add Vegetable</a>
        <a href="manage_vegetable.php">Manage Vegetables</a>
        <a href="delete_vegetable.php">Delete Vegetables</a>
        
        <br><br>
        
        <!-- Link to logout -->
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
