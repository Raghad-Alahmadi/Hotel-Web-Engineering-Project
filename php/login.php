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

    // Perform validation and authentication against the database using prepared statements
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password using password_verify
        if (password_verify($password, $row["password"])) {
            // Authentication successful
            session_start();

            // Set user role in the session
            $_SESSION['user_role'] = $row['role'];

            echo "Login successful. Welcome, $username!";

            // Redirect based on user role
            if ($row['role'] === 'admin') {
                header("Location: admin-dashboard.php");
            } else {
                header("Location: user-home.php");
            }

            // Always exit after a header redirect
            exit();
        } else {
            // Authentication failed
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // User not found
        echo "Invalid username or password. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Redirect to the login page if accessed directly without submitting the form
    header("Location: /html/Login/login.html");
    exit();
}

// Close the database connection
$conn->close();
?>
