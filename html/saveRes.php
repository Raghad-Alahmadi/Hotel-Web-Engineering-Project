<?php
session_start();

// Get reservation details from the AJAX request
$roomId = $_POST['roomId'];
$roomType = $_POST['roomType'];
$price = $_POST['price'];

// Store reservation details in session
$_SESSION['reservationDetails'] = [
    'roomId' => $roomId,
    'roomType' => $roomType,
    'price' => $price
];

// Return a response if needed
echo 'success';
?>
