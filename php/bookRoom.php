<?php
// bookRoom.php

// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user inputs
    $room = htmlspecialchars($_POST["room"]);
    $description = htmlspecialchars($_POST["description"]);
    $price = htmlspecialchars($_POST["price"]);

    // Perform room availability check
    $query = "SELECT * FROM bookings WHERE room = '$room'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        // Room is available, proceed with the booking
        // You can perform additional booking logic here
        // For now, let's just insert the booking into the database
        $insertQuery = "INSERT INTO bookings (room, description, price) VALUES ('$room', '$description', $price)";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Booking successful! Thank you for choosing our hotel.";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        // Room is not available
        echo "Sorry, the selected room is not available. Please choose another room.";
    }
} else {
    // Redirect to the rooms page if accessed directly without submitting the form
    header("Location: /html/Rooms.html");
    exit();
}

// Close the database connection
$conn->close();
?>
