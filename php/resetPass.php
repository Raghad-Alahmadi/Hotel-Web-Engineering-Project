<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection
    // Replace these with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "dbname";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the email address from the form
    $email = $_POST['email'];

    // Check if the email exists in your database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a unique token (you can use a library or a function for this)
        $token = uniqid();

        // Store the token in the database for this user
        $updateSql = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        $conn->query($updateSql);

        // Send an email to the user with a link to reset their password
        $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
        $to = $email;
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: webmaster@example.com";

        mail($to, $subject, $message, $headers);

        echo "Password reset instructions have been sent to your email.";
    } else {
        echo "Email not found in our records.";
    }

    $conn->close();
}
?>
