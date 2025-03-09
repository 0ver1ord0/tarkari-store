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

    // Fetch current vegetable data
    $query = "SELECT * FROM Vegetables WHERE vegetable_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $vegetable_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vegetable = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "UPDATE Vegetables SET name = ?, price = ? WHERE vegetable_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sdi", $name, $price, $vegetable_id);
    $stmt->execute();
    echo "Vegetable updated successfully!";
    $stmt->close();
}

$mysqli->close();
?>

<form method="post" action="">
    <input type="text" name="name" value="<?= $vegetable['name'] ?>" required>
    <input type="text" name="price" value="<?= $vegetable['price'] ?>" required>
    <button type="submit">Update Vegetable</button>
</form>
