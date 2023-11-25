<?php
    // Connect to the database
    $servername = "localhost";
    $username = "your_db_username";
    $password = "your_db_password";
    $dbname = "your_db_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $result = $conn->query("SELECT user, date_report, status FROM skin_reports");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>";
            echo "<img src='user.png' alt='User Photo'>";
            echo "<p>" . $row["user"] . "</p>";
            echo "</td>";
            echo "<td>" . $row["date_report"] . "</td>";
            echo "<td><span class='status'>" . $row["status"] . "</span></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
    }

    // Close the database connection
    $conn->close();
?>
