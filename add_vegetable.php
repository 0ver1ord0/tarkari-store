<?php
session_start();

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Connection to MySQL
$mysqli = new mysqli("localhost", "root", "", "tarkari_bazar");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission for adding a vegetable
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Validate inputs
    if (empty($name) || empty($price) || !is_numeric($price)) {
        echo "Please fill all fields correctly.";
    } else {
        // Prepare and execute query to insert a new vegetable
        $query = "INSERT INTO Vegetables (name, price) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sd", $name, $price); // 's' for string, 'd' for decimal (float)
        
        if ($stmt->execute()) {
            echo "Vegetable added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vegetable</title>
</head>
<body>
    <h1>Add a New Vegetable</h1>
    <form method="post" action="">
        <label for="name">Vegetable Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br><br>

        <button type="submit">Add Vegetable</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Go back to Admin Dashboard</a>
</body>
</html>
