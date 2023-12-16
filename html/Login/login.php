
<?php
// login.php


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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user inputs
    $loginUsername = $conn->real_escape_string($_POST["username"]);
    $loginPassword = $conn->real_escape_string($_POST["password"]);

    // Perform login validation
    $loginQuery = "SELECT * FROM users WHERE username='$loginUsername'";
    $result = $conn->query($loginQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($loginPassword, $row["password"])) {

                        // Check if the "Remember Me" checkbox is checked
                        $rememberMe = isset($_POST['rememberMe']) ? true : false;

                        // Set a cookie with the username if "Remember Me" is checked
                        if ($rememberMe) {
                            setcookie('rememberedUsername', $loginUsername, time() + (30 * 24 * 60 * 60)); // Cookie expires in 30 days
                        }
            // Check if the user is an admin
            if ($row["is_admin"]) {
                // Admin login successful
                session_start();
                $_SESSION["username"] = $loginUsername;
                $_SESSION["is_admin"] = true;
                header("Location: /html/admin-dashboard/"); // Redirect to admin dashboard
                exit();
            } else {
                // Regular user login successful
                session_start();
                $_SESSION["username"] = $loginUsername;
                $redirectUrl = isset($_SESSION['prev_page']) ? $_SESSION['prev_page'] : '/html/home.html';
                header("Location: " . $redirectUrl);
                exit();
            }
        } else {
            // Incorrect password
            $loginError = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $loginError = "User not found. Please check your username.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap">
    <link rel="stylesheet" href="css/presentation.css">
    <link rel="stylesheet" href="/css/stylesLogin.css">
</head>

<body style="background-color: #f8f9fa;">

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
        if (isset($loginError)) {
            echo "<p style='color: red;'>$loginError</p>";
        }
        ?>
        <form action="" method="post">
            <h1>Login</h1>

            <div class="box">
                <label for=""></label><input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="box">
                <label for=""></label>
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' id="passwordToggle"></i>
            </div>

            <div class="forget-remember">
            <input type="checkbox" name="rememberMe">Remember me
                <a href="/html/Login/forgetPass.php">Forget Password ?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register">
                <p>Don't have an account ? <a href="/html/Login/Register.php">Register</a></p>
            </div>
        </form>
    </div>
</div>


</body>
</html>
