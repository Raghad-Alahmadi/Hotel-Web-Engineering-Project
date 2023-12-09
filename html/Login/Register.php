<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Backend processing for form submission

    // Replace these values with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "hotel";

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize user inputs
    $firstName = $conn->real_escape_string($_POST["firstName"]);
    $lastName = $conn->real_escape_string($_POST["lastName"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Check for empty values
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password)) {
        $error_message = "Please fill in all the fields.";
    } else {
        // Perform validation and registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fname, lname, username, email, password) 
                  VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";

        if ($conn->query($query) === TRUE) {
            // Registration successful
            // Set a welcome message in a session variable
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /html/home.html"); // Redirect to home page
            exit();
        } else {
            // Registration failed
            $error_message = "Error: " . $query . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/presentation.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/stylesLogin.css">
</head>

<body>
    <nav>
        <a href="/html/home.html" class="logo">MAGNOLIA</a>
        <div class="links">
            <ul>
                <li><a href="/html/home.html">HOME</a></li>
                <li><a href="/html/AboutUs.html">ABOUT US</a></li>
                <li><a href="/php/contactus.php">CONTACT US</a></li>
                <li><a href="/html/Rooms.php">ROOMS</a></li>
                <li><a href="/html/Login/login.php">LOGIN</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="log">
            <?php
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <form action="" method="post">

                <h1>Register</h1>

                <div class="box">
                    <label for=""></label><input type="text" name="firstName" placeholder="First Name" required>
                    <i class='bx bxs-user-circle'></i>
                </div>
                <div class="box">
                    <label for=""></label><input type="text" name="lastName" placeholder="Last Name" required>
                    <i class='bx bxs-user-circle'></i>
                </div>

                <div class="box">
                    <label for=""></label><input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="box">
                    <label for=""></label><input type="email" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>

                <div class="box">
                    <label for=""></label><input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="register">
                    <p>Have an account ? <a href="/html/Login/login.php">Login</a></p>
                </div>

                <button type="submit" class="btn">Sign up</button>

            </form>
        </div>
    </div>
</body>

</html>
