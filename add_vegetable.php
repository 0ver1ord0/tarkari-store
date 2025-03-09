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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO Vegetables (name, price) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sd", $name, $price);
    $stmt->execute();
    echo "Vegetable added successfully!";
    $stmt->close();
}

$mysqli->close();
?>

<form method="post" action="">
    <input type="text" name="name" placeholder="Vegetable Name" required>
    <input type="text" name="price" placeholder="Price" required>
    <button type="submit">Add Vegetable</button>
</form>
