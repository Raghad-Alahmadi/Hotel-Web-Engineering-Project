<?php
// Replace these values with your actual database credentials
$servername = "your_database_server";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve booking details from the POST data
    $room = $conn->real_escape_string($_POST["room"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $price = $conn->real_escape_string($_POST["price"]);
    $checkInDate = $conn->real_escape_string($_POST["checkInDate"]);
    $checkOutDate = $conn->real_escape_string($_POST["checkOutDate"]);
    $quantity = $conn->real_escape_string($_POST["quantity"]);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO bookings (room, description, price, check_in_date, check_out_date, quantity) 
            VALUES ('$room', '$description', '$price', '$checkInDate', '$checkOutDate', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Redirect to the home page if accessed directly without POST data
    header("Location: /html/home.html");
    exit();
}

// Close the database connection
$conn->close();
?>
