<?php
// Assume you have a database connection
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

// Get the username from the session (you need to start the session first)
session_start();
$user = $_SESSION['username'];

// SQL query to fetch reservations for a specific user
$sql = "SELECT ReservationID, CustomerName, RoomID, CheckInDate, CheckOutDate, Room_type, Quantity, Total FROM reservations WHERE CustomerName = '$user'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styleRooms.css">
    <!-- Bootstrap CSS -->
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f8f9fa;
    }

    

    .content {
        margin: 200px;
        background-color: whitesmoke; /* Updated background color */
    }

    .btn-book-now {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px; /* Adjust padding for a larger button */
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Add a smooth transition effect */
    }

    .btn-book-now:hover {
        background-color: #0056b3;
    }
    .btn-room-type {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 12px; /* Adjust padding as needed */
    margin: 5px; /* Add margin for spacing */
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-room-type:hover {
    background-color: #218838;
}
</style>

    <title>Rooms</title>
</head>
<body>
    <section class="head">
        <nav>
            <a href="/html/home.html" class="logo">Magnolia</a>
            <div class="links">
                <ul>
                    <li><a href="/html/home.html">HOME</a></li>
                    <li><a href="/html/AboutUs.html">ABOUT US</a></li>
                    <li><a href="/html/ContactUs.html">CONTACT US</a></li>
                    <li><a href="/html/Rooms.php">ROOMS</a></li>
                    <li><a href="/html/Login/login.php">LOGIN</a></li>
                </ul>
            </div>
        </nav>

        <section class="content">

                <div class="table-data">
                    <div class="order">
                        <!-- Bootstrap table -->
                        <h2>Reserved Rooms</h2>



                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Room ID</th>
                                    <th>Username</th>
                                    <th>Room ID</th>
                                    <th>Room Type</th>
                                    <th>Check-In Date</th>
                                    <th>Check-out Date</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody id="availableRoomsTableBody">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['ReservationID'] . '</td>';
                                echo '<td>' . $row['CustomerName'] . '</td>';
                                echo '<td>' . $row['RoomID'] . '</td>';
                                echo '<td>' . $row['Room_type'] . '</td>';
                                echo '<td>' . $row['CheckInDate'] . '</td>';
                                echo '<td>' . $row['CheckOutDate'] . '</td>';
                                echo '<td>' . $row['Quantity'] . '</td>';
                                echo '<td>' . $row['Total'] . '</td>';
                                echo '<td><button class="btn-edit" data-id="' . $row['ReservationID'] . '">Edit</button></td>';
                                echo '<td><button class="btn-delete-row" data-id="' . $row['ReservationID'] . '">Delete</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>

                            
                        </table>
                    </div>
                </div>
                            </section>
            
        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    
<script>
            $(document).ready(function () {
                $('.btn-edit').click(function () {
                    var reservationId = $(this).data('id');
                    $('#editForm').attr('action', 'editRes.php?reservationId=' + reservationId);
                    $('#editForm [name="reservationId"]').val(reservationId);
                    $('#editModal').modal('show');
                });
            });
        </script>

<script>
    $(document).ready(function () {
        // Open delete modal when delete button is clicked
        $('.btn-delete-row').click(function () {
            var reservationId = $(this).data('id');
            $('#deleteForm').attr('action', 'deleteRes.php?reservationId=' + reservationId);
            $('#deleteForm [name="reservationId"]').val(reservationId);
            $('#deleteModal').modal('show');
        });
    });
</script>
</body>

</html>






    <section class="footer">
        <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
    </section>






    <script src="/JavaScript/client.js"></script>
</body>
</html>
<?php
$conn->close();
?>
