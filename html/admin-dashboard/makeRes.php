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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--CSS-->
    <link rel="stylesheet" href="style.css">

    <title>Available Rooms - Magnolia Dashboard</title>
</head>

<body>
<section id="sidebar">
        <a href="" class="brand">
            <i class='bx bx-home'></i>
            <span class="text">Magnolia Dashboard</span>
        </a>

        <ul class="side-menu">
            <li>
                <a href="/html/admin-dashboard/index.html">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/html/admin-dashboard/makeRes.php">
                    <i class='bx bx-bed'></i>
                    <span class="text">Available Rooms</span>
                </a>
            </li>
            <li>
                <a href="/html/admin-dashboard/reserved.php">
                    <i class='bx bx-calendar-check'></i>
                    <span class="text">View Reservations</span>
                </a>
            </li>
            <li>
                <a href="/html/admin-dashboard/logout.php">
                    <i class='bx bx-log-in-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <a href="#" class="profile"style="margin-left: auto;">
                <img src="user.png" >
            </a>
        </nav>
        <!-- MAIN -->
        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Available Rooms</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
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
                                echo '<tr>';
                                echo '<td>' . $row['RoomID'] . '</td>';
                                echo '<td>' . $row['Room_type'] . '</td>';
                                echo '<td>' . $row['Price'] . '</td>';
                                echo '<td><button class="btn-book-now" data-room-id="' . $row['RoomID'] . '">Book Now</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
    $(document).ready(function () {
        // Existing JavaScript code

        // Add the following click event handler for the "Book Now" button
        $('.btn-book-now').click(function () {
            var roomId = $(this).data('room-id');
            var roomType = $(this).closest('tr').find('td:nth-child(2)').text(); // Assuming room type is in the second column
            var price = $(this).closest('tr').find('td:nth-child(3)').text(); // Assuming price is in the third column

           
            var bookingPage = "/html/admin-dashboard/booking.php";

            // Redirect to the booking page with the details
            window.location.href = bookingPage + "?roomId=" + roomId + "&roomType=" + roomType + "&price=" + price;
        });
    });
</script>
    </section>

</body>

</html>

<?php
$conn->close();
?>
