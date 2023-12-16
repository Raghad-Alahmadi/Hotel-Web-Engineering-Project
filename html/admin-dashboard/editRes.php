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

    // Fetch the price of the new room from the database
    $priceSql = "SELECT Price FROM rooms WHERE Room_type=?";
    $priceStmt = $conn->prepare($priceSql);
    $priceStmt->bind_param("s", $changeRoom);
    $priceStmt->execute();
    $priceResult = $priceStmt->get_result();
    $roomPrice = $priceResult->fetch_assoc()['Price'];
    $priceStmt->close();

    // Update the reservation with the new room and room price
    $sql = "UPDATE reservations SET Quantity=?, Room_type=?, CheckInDate=?, CheckOutDate=?, Total=? WHERE ReservationID=?";
    $stmt = $conn->prepare($sql);
    $totalPrice = $roomPrice;  // Update total price directly with room price
    $stmt->bind_param("isssii", $editedQuantity, $changeRoom, $checkInDate, $checkOutDate, $totalPrice, $reservationId);
    
    if ($stmt->execute()) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <title>Success Modal Example</title>
        </head>
        
        <body>
        
            <!-- Your page content goes here -->
        
            <div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true" style="display: block;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Record Edited successfully!</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Go back</button>
                    </div>
                    </div>
                </div>
            </div>
        
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        </body>
        
        </html>';
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    $stmt->close();
} 

$conn->close();
?>
