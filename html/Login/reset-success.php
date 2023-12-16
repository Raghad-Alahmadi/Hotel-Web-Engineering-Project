<?php
// reset-password.php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hotel";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $resetEmail = $conn->real_escape_string($_POST["email"]);
    $newPassword = $conn->real_escape_string($_POST["new_password"]);

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email='$resetEmail'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email exists, update the password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE users SET password='$hashedPassword' WHERE email='$resetEmail'";
        
        if ($conn->query($updatePasswordQuery) === TRUE) {
            // Password updated successfully
            header("Location: /html/Login/login.php");
            exit();
        } else {
            $resetError = "Error updating password: " . $conn->error;
        }

    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/css/stylesLogin.css">
</head>

<body>

<nav>
    <a href="/html/home.html" class="logo">MAGNOLIA</a>
    <div class="links">
        <ul>
            <li><a href="/html/home.html">HOME</a></li>
            <li><a href="/html/AboutUs.html">ABOUT US</a></li>
            <li><a href="/php/contactus.php">CONTACT US</a></li>
            <li><a href="/html/Rooms.php">ROOMS</a></li>
            <li><a href="/html/Login/login.php">LOGIN</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="log">
        <?php
        if (isset($resetError)) {
            echo "<p style='color: red;'>$resetError</p>";
        }
        ?>
        <form action="" method="post">
    <h1>Reset Password</h1>

    <div class="box">
        <label>Your new password</label>
        <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" required>
    </div>

    <button type="submit" class="btn">Reset password</button>

    <div class="login-link">
        <p>Remember your password? <a href="/html/Login/login.php">Login</a></p>
    </div>
</form>
    </div>
</div>

<section class="footer">
    <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
</section>

</body>
</html>