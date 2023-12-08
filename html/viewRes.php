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
        background: url('https://cf.bstatic.com/xdata/images/hotel/max1024x768/375847903.jpg?k=3103212f0f694b5fcc4deec9d0025d37621c0e4e305c7b64a387b0d8b4f000ce&o=&hp=1') center/cover no-repeat fixed;

    }

    table {
        margin-top: 60px; /* Added margin-top for spacing */
    }

    .order{
        margin: 100px 200px;
        padding: 20px; 
        background-color: rgba(172, 59, 97, 0.9) !important;
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
.order h2 {
        margin-bottom: 60px;
    }

    .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
}

    @media (max-width: 768px) {
            .content {
                margin: 5px;
                padding: 10px;
            }

            th, td {
                font-size: 14px;
                padding: 10px;
            }

            .btn {
                padding: 8px;
                margin: 3px;
            }
        }
</style>

    <title>Your Reserved Rooms</title>
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



                <div class="table-data">
                    <div class="order">
                        <!-- Bootstrap table -->
                        <h2>Your Reserved Rooms</h2>


                        <?php if ($result->num_rows > 0): ?>
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
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['ReservationID'] ?></td>
                    <td><?= $row['CustomerName'] ?></td>
                    <td><?= $row['RoomID'] ?></td>
                    <td><?= $row['Room_type'] ?></td>
                    <td><?= $row['CheckInDate'] ?></td>
                    <td><?= $row['CheckOutDate'] ?></td>
                    <td><?= $row['Quantity'] ?></td>
                    <td><?= $row['Total'] ?></td>
                    <td><button class="btn-edit" data-id="<?= $row['ReservationID'] ?>">Edit</button></td>
                    <td><button class="btn-delete-row" data-id="<?= $row['ReservationID'] ?>">Delete</button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No reservations found.</p>
<?php endif; ?>
                    </div>
                </div>
                         
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
