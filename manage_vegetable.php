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

// Fetch all vegetables from the database
$query = "SELECT * FROM Vegetables";
$result = $mysqli->query($query);

// Handle vegetable deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete vegetable from the database
    $delete_query = "DELETE FROM Vegetables WHERE vegetable_id = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "Vegetable deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle vegetable update
if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $updated_name = $_POST['name'];
    $updated_price = $_POST['price'];

    // Prepare and execute query to update vegetable
    $update_query = "UPDATE Vegetables SET name = ?, price = ? WHERE vegetable_id = ?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param("sdi", $updated_name, $updated_price, $update_id);

    if ($stmt->execute()) {
        echo "Vegetable updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vegetables</title>
</head>
<body>
    <h1>Manage Vegetables</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Vegetable Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($vegetable = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $vegetable['name']; ?></td>
                    <td><?php echo $vegetable['price']; ?></td>
                    <td>
                        <!-- Edit form -->
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="update_id" value="<?php echo $vegetable['vegetable_id']; ?>">
                            <input type="text" name="name" value="<?php echo $vegetable['name']; ?>" required>
                            <input type="text" name="price" value="<?php echo $vegetable['price']; ?>" required>
                            <button type="submit">Update</button>
                        </form>

                        <!-- Delete link -->
                        <a href="?delete_id=<?php echo $vegetable['vegetable_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dashboard.php">Go back to Admin Dashboard</a>
</body>
</html>
