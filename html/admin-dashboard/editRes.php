<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_POST['reservationId'];
    $editedQuantity = $_POST['editedQuantity'];
    $changeRoom = $_POST['changeRoom'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $sql = "UPDATE reservations SET Quantity=?, Room_type=?, CheckInDate=?, CheckOutDate=? WHERE ReservationID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $editedQuantity, $changeRoom, $checkInDate, $checkOutDate, $reservationId);
    
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    $stmt->close();
} // Add this closing parenthesis

$conn->close();
?>
