<?php
// register.php

// Replace these values with your actual database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";


// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user inputs
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Perform validation and registration
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (first_name, last_name, username, email, password) 
              VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";

    if ($conn->query($query) === TRUE) {
        // Registration successful
        echo "Registration successful. Welcome, $username!";
        // Redirect to a welcome page or perform additional actions
    } else {
        // Registration failed
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    // Redirect to the registration page if accessed directly without submitting the form
    header("Location: /html/Login/Register.html");
    exit();
}
echo "SQL Query: $query <br>";
echo "Error: " . $conn->error;
// Close the database connection
$conn->close();
?>
