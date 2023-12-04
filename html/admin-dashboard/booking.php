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

// Initialize variables
$roomId = isset($_GET['roomId']) ? $_GET['roomId'] : '';
$roomType = isset($_GET['roomType']) ? $_GET['roomType'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['username'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $quantity = $_POST['quantity'];

    // Calculate total price
    $totalPrice = $quantity * $price;

    // SQL query to update the reservations table
    $sql = "INSERT INTO reservations (CustomerName, RoomID, Room_Type, CheckInDate, CheckOutDate, Quantity, Total)
            VALUES ('$username', '$roomId', '$roomType', '$checkInDate', '$checkOutDate', $quantity, $totalPrice)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
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
                    <h3>Reservation Details</h3>
                <form method="post" action="booking.php?roomId=<?php echo $roomId; ?>&roomType=<?php echo $roomType; ?>&price=<?php echo $price; ?>">

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="checkInDate">Check-In Date:</label>
                    <input type="date" id="checkInDate" name="checkInDate" required>

                    <label for="checkOutDate">Check-Out Date:</label>
                    <input type="date" id="checkOutDate" name="checkOutDate" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" required>



                    <input type="submit" value="Book Now">
                </form>
                    </table>
                </div>
            </div>
        </main>
        
        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
    </section>

</body>

</html>

<?php
$conn->close();
?>