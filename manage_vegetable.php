<?php
session_start();

// Check if admin is logged in
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "tarkari_bazar");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM Vegetables";
$result = $mysqli->query($query);

echo "<h1>Manage Vegetables</h1>";

while ($row = $result->fetch_assoc()) {
    echo "Name: " . $row['name'] . "<br>";
    echo "Price: " . $row['price'] . "<br>";
    echo "<a href='edit_vegetable.php?id=" . $row['vegetable_id'] . "'>Edit</a> | ";
    echo "<a href='delete_vegetable.php?id=" . $row['vegetable_id'] . "'>Delete</a><br><br>";
}

$mysqli->close();
?>
