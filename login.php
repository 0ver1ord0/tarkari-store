<?php
session_start();

// Connection to MySQL
$mysqli = new mysqli("localhost", "root", "", "tarkari_bazar");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute query to get user by username
    $query = "SELECT * FROM Users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check password
        if (password_verify($password, $user['password'])) {
            // Start the session and store user information
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];  // Store user role (e.g., admin or user)
            
            // Redirect based on role
            if ($_SESSION['role'] == 'admin') {
                // If the user is an admin, redirect to admin dashboard
                header("Location: admin_dashboard.php"); // Or any admin page
            } else {
                // If the user is a regular user, redirect to the user dashboard
                header("Location: user_dashboard.php"); // Or any user page
            }
            exit(); // Don't forget to exit to prevent further script execution
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
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
    <title>Login</title>
    <link rel="stylesheet" href="login.css?v=1.1"> <!-- Add version number --> <!-- Link to your CSS file in the same directory -->
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="post" action="" autocomplete="off">
    <input type="text" name="username" placeholder="Username" required autocomplete="off">
    <input type="password" name="password" placeholder="Password" required autocomplete="off">
    <button type="submit">Login</button>
</form>

        <p>Don't have an account? <a href="signup.php">Signup</a></p>
        <p><a href="forgot_password.php">Forgot Password?</a></p> <!-- Forgot Password link -->
    </div>
</body>
</html>
