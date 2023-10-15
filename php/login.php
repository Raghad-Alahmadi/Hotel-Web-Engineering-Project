<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submission
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection
    $serverName = "your_sql_server_name";
    $connectionOptions = array(
        "Database" => "Hotel_Users",
        "Uid" => "your_sql_username",
        "PWD" => "your_sql_password"
    );

    // Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    // Check connection
    if (!$conn) {
        if ($errors != null) {
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
                echo "Code: " . $error['code'] . "<br />";
                echo "Message: " . $error['message'] . "<br />";
            }
            die();
        }
    }

    // SQL query to check login validity
    $sql = "SELECT * FROM HotelUsers WHERE Username = ? AND Password = ?";
    $params = array($username, $password);
    
    // Use prepared statement to prevent SQL injection
    $query = sqlsrv_query($conn, $sql, $params);

    if ($query === false) {
        if ($errors != null) {
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
                echo "Code: " . $error['code'] . "<br />";
                echo "Message: " . $error['message'] . "<br />";
            }
            die();
        }
    }

    // Check if a matching user was found
    if (sqlsrv_has_rows($query)) {
        echo "Login successful!";
        // Additional logic, such as redirecting to a dashboard, setting session variables, etc.
    } else {
        echo "Invalid login credentials!";
    }

    sqlsrv_close($conn);
}
?>
