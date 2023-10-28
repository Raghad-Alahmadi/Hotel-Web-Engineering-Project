<?php
// login.php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "users";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user inputs
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Perform validation and authentication against the database
    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password using password_verify
        if (password_verify($password, $row["password"])) {
            // Authentication successful
            echo "Login successful. Welcome, $username!";
            // Redirect to a protected page or perform additional actions
        } else {
            // Authentication failed
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // User not found
        echo "Invalid username or password. Please try again.";
    }
} else {
    // Redirect to the login page if accessed directly without submitting the form
    header("Location: /html/Login/login.html");
    exit();
}

// Close the database connection
$conn->close();
?>