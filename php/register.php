<?php
// register.php

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
    // Collect and sanitize user inputs
    $firstName = $conn->real_escape_string($_POST["firstName"]);
    $lastName = $conn->real_escape_string($_POST["lastName"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Check for empty values
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all the fields.";
    } else {
        // Perform validation and registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fname, lname, username, email, password) 
                  VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";

        if ($conn->query($query) === TRUE) {
            // Registration successful
            // Set a welcome message in a session variable
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /html/home.html"); // Redirect to home page
            exit();
        } else {
            // Registration failed
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the registration page if accessed directly without submitting the form
    header("Location: /html/Login/Register.php");
    exit();
}
?>
<?php
// register.php

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
    // Collect and sanitize user inputs
    $firstName = $conn->real_escape_string($_POST["firstName"]);
    $lastName = $conn->real_escape_string($_POST["lastName"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Check for empty values
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password)) {
        // Display an error message and redirect back to the registration page
        header("Location: /html/Login/Register.php?error=empty_fields");
        exit();
    } else {
        // Perform validation and registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "INSERT INTO users (fname, lname, username, email, password) 
                  VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";
    
        if ($conn->query($query) === TRUE) {
            // Registration successful
            // Set a welcome message in a session variable
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /html/home.html"); // Redirect to home page
            exit();
        } else {
            // Registration failed
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the registration page if accessed directly without submitting the form
    header("Location: /html/Login/Register.php");
    exit();
}
?>
