<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected room type from the AJAX request
$selectedRoomType = isset($_GET['roomType']) ? $_GET['roomType'] : '';

// Validate the room type (add more types if needed)
$allowedRoomTypes = array('Single Room', 'Suite Room', 'Presidential Suite', 'Double Room');

if (!in_array($selectedRoomType, $allowedRoomTypes)) {
    die("Invalid room type");
}

// Fetch room data from the database based on the selected room type
$sql = "SELECT RoomID FROM rooms WHERE Room_Type = '$selectedRoomType'";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Initialize an empty array to store options
$options = array();

// Generate options based on room data
while ($row = $result->fetch_assoc()) {
    $options[] = $row['RoomID'];
}

// Return JSON response with options
echo json_encode($options);

// Close the database connection
$conn->close();
?>
