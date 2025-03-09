<?php
session_start();

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Admin can now add, edit, delete vegetables
?>

<h1>Welcome, Admin!</h1>
<a href="add_vegetable.php">Add Vegetable</a>
<a href="manage_vegetables.php">Manage Vegetables</a>
