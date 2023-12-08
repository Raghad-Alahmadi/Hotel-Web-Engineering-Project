<?php
session_start();
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

         // Set room availability to 0 after successful reservation
         $sqlUpdateAvailability = "UPDATE rooms SET Availability = 0 WHERE RoomID = ?";
         $stmtUpdateAvailability = $conn->prepare($sqlUpdateAvailability);
         $stmtUpdateAvailability->bind_param("i", $roomId);
         header("Location: /php/index.php?CustomerName=$username&roomID=$roomId&room_type=$roomType&checkInDate=$checkInDate&checkOutDate=$checkOutDate&quantity=$quantity&price=$totalPrice");

    //     header("Location: /php/index.php?roomId=$roomId&roomType=$roomType&price=$totalPrice");


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


    .order{
        margin: 100px 400px;
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
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #AC3B61;
    }


    .btn-book-now {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-book-now:hover {
        background-color: #0056b3;
    }

    /* Updated styles for form labels and inputs */
    form {
    display: flex;
    flex-direction: column;
    align-items:center;
}

form label {
    margin-bottom: 8px;
    text-align: left;
}

form input {
    width: 70%;
    margin-bottom: 16px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
    .modal-content {
            background-color: #f8f9fa;
        }

        .modal-footer {
            justify-content: center;
        }

        @media (max-width: 768px) {
        .content {
            margin: 10px;
        }

        .btn-book-now {
            padding: 8px; /* Adjusted padding for smaller screens */
        }

        input {
            width: 100%; /* Full width for smaller screens */
        }
    }
    </style>
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
                        <h3>Reservation Details</h3>
                <form method="post" action="reserveAction.php">

                <input type="hidden" name="roomId" value="<?php echo $_GET['roomId']; ?>">
                <input type="hidden" name="roomType" value="<?php echo $_GET['roomType']; ?>">
                <input type="hidden" name="price" value="<?php echo $_GET['price']; ?>">

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>

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

  <!-- Bootstrap Modal -->
<!---
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Reservation Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your reservation has been confirmed. Thank you for choosing Magnolia Hotel!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    -->  
        <!-- Your JavaScript and jQuery scripts here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
        // Trigger the modal when the page loads (you can customize this based on your needs)
        $(document).ready(function () {
            $('#reservationModal').modal('show');
        });
    </script>

</body>

</html>

<?php
$conn->close();
?>

    <section class="footer">
        <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
    </section>


    <script src="/JavaScript/client.js"></script>
</body>
</html>


