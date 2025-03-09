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

if (isset($_GET['id'])) {
    $vegetable_id = $_GET['id'];

    // Delete the vegetable
    $query = "DELETE FROM Vegetables WHERE vegetable_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $vegetable_id);
    $stmt->execute();
    echo "Vegetable deleted successfully!";
    $stmt->close();
}

$mysqli->close();
?>
