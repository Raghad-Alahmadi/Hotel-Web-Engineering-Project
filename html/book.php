<?php
session_start();
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


// SQL query to fetch available rooms
$sql = "SELECT RoomID, Room_type, Price FROM rooms WHERE availability = 1";

$result = $conn->query($sql);

// Get data from the AJAX request
$username = $_POST['CustomerName'];
$roomId = $_POST['RoomID'];
$roomType = $_POST['Room_Type'];
$checkInDate = $_POST['checkInDate'];
$checkOutDate = $_POST['checkOutDate'];
$quantity = $_POST['Quantity'];
$price = $_POST['price'];
$totalPrice = $_POST['Total'];


// SQL query to update the reserved table
$sql = "INSERT INTO reservations (CustomerName, RoomID, Room_Type, CheckInDate, CheckOutDate, Quantity, Total)
        VALUES ('$username', '$roomId', '$roomType', '$checkInDate', '$checkOutDate', $quantity, $totalPrice)";

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Close the database connection
$conn->close();
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
        margin-top: 50px; /* Added margin-top for spacing */
    }

    .order{
        margin: 100px 200px;
        padding: 20px; 
        background-color: rgba(172, 59, 97, 0.9) !important;
    }

.btn {
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-book-now,
    .btn-room-type,
    .btn-room-type-single,
    .btn-room-type-double,
    .btn-room-type-suite,
    .btn-room-type-family,
    .btn-view-reservations {

        padding: 10px 15px;
        margin: 5px; 
        color: white;
        background-color:#6c757d;
    }
    .btn-view-reservations {
        float: right;
    }

    .btn-book-now {
        background-color: #007bff;
    }

    .btn-book-now:hover {
        background-color: #0056b3;
    }

    .btn-room-type {
        background-color:#AC3B61;

    }

    .btn-room-type:hover {
        background-color: #6c757d;
    }

    .order h2 {
        margin-bottom: 30px;
    }
    .footer {

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
                margin: 10px;
                margin-top: 10px;
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
                    <li><a href="/html/Rooms.html">ROOMS</a></li>
                    <li><a href="/html/Login/login.php">LOGIN</a></li>
                </ul>
            </div>
        </nav>

        

                <div class="table-data">
                    <div class="order">
                        <!-- Bootstrap table -->
                        <h2>Available Rooms</h2>

                        <!-- Room Type Buttons -->
                        <div class="room-type-buttons">
    <button class="btn btn-room-type" data-room-type="All">All</button>
    <button class="btn btn-room-type-single" data-room-type="Single Room">Single Room</button>
    <button class="btn btn-room-type-double" data-room-type="Double Room">Double Room</button>
    <button class="btn btn-room-type-suite" data-room-type="Suite Room">Suite Room</button>
    <button class="btn btn-room-type-family" data-room-type="Presidential Suite">Presidential Suite</button>
    <button class="btn btn-view-reservations">View Recent Reservations</button>

</div>

                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Type</th>
                                    <th>Price</th>
                                    <th>Book Now</th>
                                </tr>
                            </thead>
                            <tbody id="availableRoomsTableBody">
                                <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr data-room-type="' . $row['Room_type'] . '">';
                                        echo '<td>' . $row['RoomID'] . '</td>';
                                        echo '<td>' . $row['Room_type'] . '</td>';
                                        echo '<td>' . $row['Price'] . ' SAR</td>';
                                        echo '<td><button class="btn btn-primary btn-book-now" data-room-id="' . $row['RoomID'] . '">Book Now</button></td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                           
            
        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Room Type Filtering
        $('.btn-room-type').click(function () {
            var selectedType = $(this).data('room-type');

            // Show only rows with the selected room type and hide others
            $('#availableRoomsTableBody tr').each(function () {
                if ($(this).data('room-type') === selectedType || selectedType === 'All') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Individual Room Type Filtering
        $('.btn-room-type-single').click(function () {
            filterRoomType('Single Room');
        });

        $('.btn-room-type-double').click(function () {
            filterRoomType('Double Room');
        });

        $('.btn-room-type-suite').click(function () {
            filterRoomType('Suite Room');
        });

        $('.btn-room-type-family').click(function () {
            filterRoomType('Presidential Suite');
        });

        function filterRoomType(type) {
            // Show only rows with the selected room type and hide others
            $('#availableRoomsTableBody tr').each(function () {
                if ($(this).data('room-type') === type || type === 'All') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Add the following click event handler for the "Book Now" button
        $('.btn-book-now').click(function () {
            var roomId = $(this).data('room-id');
            var roomType = $(this).closest('tr').find('td:nth-child(2)').text();
            var price = $(this).closest('tr').find('td:nth-child(3)').text();

            var bookingPage = "/html/reserveAction.php";
            var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                window.location.href = bookingPage + "?roomId=" + roomId + "&roomType=" + roomType + "&price=" + price;
            } else {
                alert("Please log in to make a reservation.");
                window.location.href = "/html/Login/login.php";
            }
        });
    });
    // View Reservations Button
$('.btn-view-reservations').click(function () {
    var viewReservationsPage = "/html/viewRes.php";
    window.location.href = viewReservationsPage;
});
</script>
    

</body>
<section class="footer">
        <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
    </section>

</html>

<?php
$conn->close();
?>




  



