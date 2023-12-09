<?php
// reset-password.php

// Replace these values with your actual database credentials
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

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email='$resetEmail'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email exists, generate a reset token and send the reset link (not implemented in this example)
        $resetToken = generateResetToken(); // Implement your own function to generate a unique reset token
        // Send the reset link to the user's email (not implemented in this example)

        // Redirect to a success message or confirmation page
        header("Location: /html/Login/reset-success.php");
        exit();
    } else {
        // Email not found
        $resetError = "Email not found. Please check your email address.";
    }
}

// Close the database connection
$conn->close();

// Implement your own function to generate a unique reset token
function generateResetToken()
{
    // Your code to generate a unique reset token
}
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
            <h1>Forgot Password</h1>

            <p>Enter the email address associated with your account, and we'll send you a link to reset your password.</p>

            <div class="box">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <button type="submit" class="btn">Send Reset Link</button>

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