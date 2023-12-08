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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_POST['reservationId'];

    // SQL query to delete reservation
    $sql = "DELETE FROM reservations WHERE ReservationID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reservationId);

    if ($stmt->execute()) {
        // Trigger JavaScript to display success modal
        echo '<script>
                $(document).ready(function() {
                    $("#successModal").modal("show");
                });
              </script>';
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<div class="modal" id="successModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Record deleted successfully!</p>
            </div>
            <div class="modal-footer">
                <!-- Add a button to close the modal and go back to the previous page -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.history.back();">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    #successModal {
        text-align: center;
    }

    #successModal .modal-dialog {
        max-width: 400px;
        margin: 1.75rem auto;
    }

    #successModal .modal-content {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    #successModal .modal-header {
        background-color: #28a745;
        color: white;
        border-bottom: none;
    }

    #successModal .modal-title {
        font-size: 1.5rem;
    }

    #successModal .modal-body {
        padding: 1.25rem;
    }

    #successModal .modal-footer {
        border-top: none;
        padding: 1rem;
    }

    #successModal .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    #successModal .btn-secondary:hover {
        background-color: #545b62;
    }
</style>
