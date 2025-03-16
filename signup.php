<?php
// Connection to MySQL
$mysqli = new mysqli("localhost", "root", "", "tarkari_bazar");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Password input (unhashed)

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind statement
    $query = "INSERT INTO Users (username, phone_number, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssss", $username, $phone_number, $email, $hashed_password);
    $stmt->execute();
    echo "User registered successfully!";
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p> <!-- Link to login page -->
    </div>
</body>
</html>
