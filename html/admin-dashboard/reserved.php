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
$sql = "SELECT 	ReservationID, CustomerName, RoomID,CheckInDate, CheckOutDate, Room_type, Quantity, Total FROM reservations ";

$result = $conn->query($sql);

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

    <title>Reserved Rooms - Magnolia Dashboard</title>
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
                <a href="/html/admin-dashboard/reserved.html">
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
                        <h3>Reserved Rooms</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                                <th>Reservation ID</th>
                                <th>User</th>
                                <th>Room ID</th>
                                <th>CheckIn Date</th>
                                <th>CheckOut Date</th>
                                <th>Room Type</th>
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
                                echo '<td>' . $row['CheckInDate'] . '</td>';
                                echo '<td>' . $row['CheckOutDate'] . '</td>';
                                echo '<td>' . $row['Room_type'] . '</td>';
                                echo '<td>' . $row['Quantity'] . '</td>';
                                echo '<td>' . $row['Total'] . '</td>';
                                echo '<td><button class="btn-edit" data-id="' . $row['ReservationID'] . '">Edit</button></td>';
                                echo '<td><button class="btn-delete" data-id="' . $row['ReservationID'] . '">Delete</button></td>';
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
            // Your existing JavaScript code remains unchanged
            // ...
        </script>
    </section>

</body>

</html>

<?php
$conn->close();
?>