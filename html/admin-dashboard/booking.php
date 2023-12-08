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
    // Get data from the form
    $username = $_POST['username'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $quantity = $_POST['quantity'];
    $roomId = $_POST['roomId'];
    $roomType = $_POST['roomType'];
    $price = $_POST['price'];


    // Calculate total price
    $totalPrice = $quantity * $price;

    // SQL query to insert into the reservations table
    $sql = "INSERT INTO reservations (CustomerName, RoomID, Room_Type, CheckInDate, CheckOutDate, Quantity, Total)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssii", $username, $roomId, $roomType, $checkInDate, $checkOutDate, $quantity, $totalPrice);

    if ($stmt->execute()) {
        echo "Reservation successful!";
         // Set room availability to 0 after successful reservation
         $sqlUpdateAvailability = "UPDATE rooms SET Availability = 0 WHERE RoomID = ?";
         $stmtUpdateAvailability = $conn->prepare($sqlUpdateAvailability);
         $stmtUpdateAvailability->bind_param("i", $roomId);

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

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
        <h1>Reservation Details</h1>
    <div class="table-data">
        <div class="order">
            <div class="head">

                <form method="post" action="booking.php">

                <input type="hidden" name="roomId" value="<?php echo $_GET['roomId']; ?>">
    <input type="hidden" name="roomType" value="<?php echo $_GET['roomType']; ?>">
    <input type="hidden" name="price" value="<?php echo $_GET['price']; ?>">

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
            </div>
        </div>
    </div>
</main>
        
        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
    </section>

    <style>

    label {
        display: flex;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        align-items: center;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</body>

</html>

