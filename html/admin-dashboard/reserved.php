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
$sql = "SELECT ReservationID, CustomerName, RoomID, CheckInDate, CheckOutDate, Room_type, Quantity, Total FROM reservations ";

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
    <style>
    .btn-edit,
    .btn-delete-row {
        background-color: #28a745; /* Green background color */
        color: white; /* White text color */
        padding: 8px 16px; /* Padding */
        border: none; /* No border */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor */
        margin-right: 5px; /* Margin between buttons */
    }

    .btn-edit:hover,
    .btn-delete-row:hover {
        background-color: #218838; /* Darker green on hover */
    }

    .modal-body form label {
        display: block;
        margin-top: 10px;
    }

    .modal-body form input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    .modal-body form button {
        display: block;
        margin:30px;
        background-color: #007bff;
        
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-body form button:hover {
        background-color: #0056b3;
    }
</style>

<style>
    #deleteModal .modal-body .btn-delete,
    #deleteModal .modal-body .btn-cancel {
        margin: auto;
        margin-top: 10px;
        padding: 10px 20px; /* Adjust the padding values as needed */
        border: none;
        border-radius: 5px;
        justify-content: center;
        cursor: pointer;
    }

    #deleteModal .modal-body .btn-delete {
        background-color: #dc3545;
        color: white;
        justify-content: center;
    }

    #deleteModal .modal-body .btn-delete:hover {
        background-color: #c82333;
        justify-content: center;
    }

    #deleteModal .modal-body .btn-cancel {
        background-color: #6c757d;
        color: white;
        justify-content: center;
    }

    #deleteModal .modal-body .btn-cancel:hover {
        background-color: #5a6268;
        justify-content: center;
    }
</style>

    <title>Reserved Rooms - Magnolia Dashboard</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="profile" style="margin-left: auto;">
                <img src="user.png">
            </a>
        </nav>

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
                            <tr>
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
                                echo '<td><button class="btn-delete-row" data-id="' . $row['ReservationID'] . '">Delete</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="editRes.php">
                    <label for="editedQuantity">Edited Quantity:</label>
                    <input type="number" id="editedQuantity" name="editedQuantity" required>


                    <label for="changeRoom">Change Room:</label>
                    <select id="changeRoom" name="changeRoom" required>
                        <option value="Single Room">Single Room</option>
                        <option value="Suite Room">Suite Room</option>
                        <option value="Presidential Suite">Presidential Suite</option>
                        <option value="Double Room">Double Room</option>
                    </select>

                    
                    <label for="checkInDate">Check-In Date:</label>
                    <input type="date" id="checkInDate" name="checkInDate" required>
                    <label for="checkOutDate">Check-Out Date:</label>
                    <input type="date" id="checkOutDate" name="checkOutDate" required>
                    <input type="hidden" name="reservationId" value="">
                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" method="post" action="deleteRes.php">
                    <p>Are you sure you want to delete this reservation?</p>
                    <input type="hidden" name="reservationId" value="">
                    <button type="submit" class="btn-delete">Delete</button>
                    <button type="button" class="btn-cancel" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>



<style>
    #deleteModal .modal-body form {
        text-align: center;
    }

    #deleteModal .modal-body p {
        margin-bottom: 20px;
    }

    #deleteModal .modal-body button {
        margin: 0 10px;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #deleteModal .modal-body .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    #deleteModal .modal-body .btn-delete:hover {
        background-color: #c82333;
    }

    #deleteModal .modal-body .btn-cancel {
        background-color: #6c757d;
        color: white;
    }

    #deleteModal .modal-body .btn-cancel:hover {
        background-color: #5a6268;
    }
</style>


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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </section>

</body>

</html>

<?php
$conn->close();
?>
