<?php

// Assume you have a database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "your_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch available rooms
$sql = "SELECT id, room_number, room_type, price FROM rooms WHERE is_booked = 0";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    // Return an empty array if no available rooms found
    echo json_encode(array());
}

$conn->close();
?>
