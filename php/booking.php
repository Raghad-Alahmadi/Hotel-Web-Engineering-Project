<?php
// Retrieve data from the Rooms page
$roomType = $_POST['roomType'];
$quantity = $_POST['quantity'];
$totalAmount = $_POST['totalAmount'];

// Retrieve customer name from the payment page
$customerName = $_POST['customerName'];

// Database connection details (replace with your actual database information)
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve available room IDs based on room type
$sqlAvailableRooms = "SELECT room_id FROM rooms WHERE room_type = '$roomType' AND availability = 1 ORDER BY RAND() LIMIT $quantity";
$resultAvailableRooms = $conn->query($sqlAvailableRooms);

if ($resultAvailableRooms->num_rows >= $quantity) {
    // Array to store the selected room IDs
    $selectedRoomIds = array();

    // Fetch room IDs and store in the array
    while ($rowAvailableRoom = $resultAvailableRooms->fetch_assoc()) {
        $selectedRoomIds[] = $rowAvailableRoom['room_id'];
    }

    // Insert reservation records with the selected room IDs
    foreach ($selectedRoomIds as $roomId) {
        $sqlReservation = "INSERT INTO reservations (room_id, room_type, quantity) VALUES ($roomId, '$roomType', 1)";
        if ($conn->query($sqlReservation) !== TRUE) {
            echo "Error creating reservation record: " . $conn->error . "<br>";
        }
    }

    echo "Reservation records created successfully<br>";

    // Insert payment details
    $sqlPayment = "INSERT INTO payments (customer_name, total_amount) VALUES ('$customerName', $totalAmount)";
    if ($conn->query($sqlPayment) === TRUE) {
        echo "Payment record created successfully<br>";
    } else {
        echo "Error creating payment record: " . $conn->error . "<br>";
    }
} else {
    echo "Not enough available rooms of type $roomType found.<br>";
}

// Close the database connection
$conn->close();
?>
