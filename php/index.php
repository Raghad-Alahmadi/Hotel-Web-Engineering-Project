<?php
session_start();
include('html/Rooms.php');

$conn = mysqli_connect('localhost', 'root', 'root', 'hotel');
if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

// Retrieve reservation details from URL parameters
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$roomId = isset($_GET['roomId']) ? $_GET['roomId'] : '';
$roomType = isset($_GET['roomType']) ? $_GET['roomType'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$checkInDate = isset($_GET['checkInDate']) ? $_GET['checkInDate'] : '';
$checkOutDate = isset($_GET['checkOutDate']) ? $_GET['checkOutDate'] : '';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : '';

if (isset($_POST['submit'])) {
  // ... (your existing form validation code)

  // If form validation is successful, proceed with reservation and payment



    // Payment
    $sqlPayment = "INSERT INTO payment (CustomerName, Cardnumber, Exmonth, Exyear, CVV)
                   VALUES (?, ?, ?, ?, ?)";
    $stmtPayment = $conn->prepare($sqlPayment);
    $stmtPayment->bind_param("sssss", $cardname, $cardnumber, $expmonth, $expyear, $cvv);
    $stmtPayment->execute();

      // Redirect or perform additional actions as needed
      header("Location: /html/home.html");  // Adjust the redirect URL as needed
      exit();
  
}




//Name on Card
if (isset($_POST['cardname'])) {
    $cardname = mysqli_real_escape_string($conn, $_POST['cardname']);
} else {
    $cardname = ''; // Set a default value or handle the absence of data.
}
//Number of Card
if (isset($_POST['cardnumber'])) {
    $cardnumber = mysqli_real_escape_string($conn, $_POST['cardnumber']);
} else {
    $cardnumber = ''; // Set a default value or handle the absence of data.
}
//Card expiry Month
if (isset($_POST['expmonth'])) {
    $expmonth = mysqli_real_escape_string($conn, $_POST['expmonth']);
} else {
    $expmonth = ''; // Set a default value or handle the absence of data.
}
//Card expiry Year
if (isset($_POST['expyear'])) {
    $expyear = mysqli_real_escape_string($conn, $_POST['expyear']);
} else {
    $expyear = ''; // Set a default value or handle the absence of data.
}
//Card CVV
if (isset($_POST['cvv'])) {
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
} else {
    $cvv = ''; // Set a default value or handle the absence of data.
}

$errors = [
    'CardNameError' => '',
    'CardNumberError' => '',
    'ExpMonthError' => '',
    'ExpYearError' => '',
    'CVVError' => '',
];

if (isset($_POST['submit'])) {
    if (empty($cardname)) {
        $errors['CardNameError'] = 'Please Enter the Name on the Card';
    }

    if (empty($cardnumber)) {
        $errors['CardNumberError'] = 'Please Enter Card Number';
    }
    
    if (empty($expmonth)) {
        $errors['ExpMonthError'] = 'Please choose Card expiry Month';
    }

    if (empty($expyear)) {
        $errors['ExpYearError'] = 'Please Enter Card expiry Year';
    } 

    if (empty($cvv)) {
        $errors['CVVError'] = 'Please Enter CVV Number';
    } else {
        $sql = "INSERT INTO payment(Name, Cardnumber, Exmonth, Exyear, CVV) 
        VALUES ('$cardname', '$cardnumber', '$expmonth', '$expyear', '$cvv')";
        $reservationSql = "INSERT INTO reservations (total_amount, other_columns) 
        VALUES ('$total', 'other_values')";

        if (mysqli_query($conn, $reservationSql)) {
        // Reservation details inserted successfully
        // You may want to redirect the user or perform additional actions here
        } else {
        echo 'Error: Unable to insert reservation details. Please try again later.';
        error_log('MySQL Error: ' . mysqli_error($conn));
        }
        if (mysqli_query($conn, $sql)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();

        } else {
          echo 'Error: Unable to process payment. Please try again later.';
          error_log('MySQL Error: ' . mysqli_error($conn));
        }
    }

    $sql_s = 'SELECT * FROM payment';
    $result = mysqli_query($conn, $sql_s);
    mysqli_free_result($result);
    mysqli_close($conn);

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
            <h1>Payment</h1>
            <hr>
                <label class="acccard" for="acccard">Accepted Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-paypal" style="color:blue"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                </div>

                <label for="cname">Name on Card</label><br>
                <div class = "inputbox">
                  <input class="box1" type="text" id="cname" name="cardname" placeholder="Name" required><br>
                </div>

                <label for="cname">Credit card number</label><br>
                <div class = "inputbox">
                 <input class="box1" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required><br>
                </div>

                <label for="expmonth">Exp Month</label><br>
                <div class = "inputbox">
                  <select class="box1" id="expmonth" name="expmonth" placeholder="MM" required>
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                  </select><br>
                </div>
                <div class="div1">
                    <label for = "cardye">Exp Year</label><br>
                    <div class = "inputbox">
                      <input class = "box2" type = "year" name = "expyear" id = "expyear" placeholder = "YYYY" required><br>
                    </div>
                </div>

                <div class="div1">
                    <label for="cardCVC">CVV</label><br>
                    <div class = "inputbox">
                      <input class = "box2" type="cvv" name="cvv" id="cvv" placeholder = "CVV" required><br>
                    </div>
                </div>

                <label>
                <br><input type="checkbox" checked="checked" name="savecard">Save card details for next time
                </label>
                <hr>
                <p>Total <span class="price" style="color:black"><b> <?php echo $price; ?></b></span></p>
                <p class="VAT">The total cost includes a 15% VAT</p>
                <input type="submit" name="submit" value="Continue to checkout" class="btn">
        </form>
    <!--Session time out-->
    </div>
    <div id="sessionTimeoutWarning">Your session is about to expire. Do you want to continue?
    <button id="acceptButton">Yes, please</button>
    <button onclick="rejectAndGoBack()" id="RejectButton">No, Back to Booking Page</button>
    </div>
</body>
</html>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

body{
  margin:0 ;
  padding: 0;
  background-color: #bbb;
  font-family: "Poppins", sans-serif;
}

.container{
  width: 600px;
  height: 730px;
  margin: 50px auto 0 260px;
  padding: 25px;
  background-color:whitesmoke;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1{
  text-align: center;
}
.acccard{
 padding: 7px 0 0  440px;
}
.icon-container{
  margin-bottom: 20px;
  padding: 7px 0 0  455px;
  font-size: 24px
}

form{
  width: 600px;
  margin: 10px auto 0 auto;
  padding: 10px;
}

select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-bottom: 15px;
  font-size: 16px;
  color: #555;
}

select option {
  background-color: #fff;
  color: #555;
}

select:focus {
  outline: none;
  border-color: #66afe9;
  box-shadow: 0 0 5px #66afe9;
}

.box1{
  width: 100%;
  padding: 10px;
  border: none;
  box-sizing: border-box;
  margin: 15px 0 15px 0;

}

.div1{
  display: inline-block;

}

.box2{
  padding: 10px;
  border: none;
  margin: 10px 5px 15px 0;
}

span.price {
  float: right;
  color: grey;
}

.VAT{
 font-size: 12px;
 color: #bbb;
}

.btn {
  background-color: #AC3B61;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: rgb(61, 69, 75);
}

#sessionTimeoutWarning {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #ffeb3b;
      color: #333;
      padding: 10px;
      text-align: center;
      font-weight: bold;
}
#acceptButton {
      background-color: #f8faf8;
      color: black;
      margin-left: 20px;
      padding: 10px 30px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-weight: bold;
}
#RejectButton {
      background-color: #f8faf8;
      color: black;
      margin-left: 20px;
      padding: 10px 30px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-weight: bold;
}
</style>

<script>
const sessionTimeoutDuration = 60000 ;

let sessionTimeout;


function showSessionTimeoutWarning() {
  document.getElementById('sessionTimeoutWarning').style.display = 'block';
}


function hideSessionTimeoutWarning() {
  document.getElementById('sessionTimeoutWarning').style.display = 'none';
}

function resetSessionTimeout() {

  clearTimeout(sessionTimeout);

  sessionTimeout = setTimeout(showSessionTimeoutWarning, sessionTimeoutDuration);
}

document.addEventListener('mousemove', resetSessionTimeout);
document.addEventListener('keydown', resetSessionTimeout);

// Event listener for the "Accept" button
document.getElementById('acceptButton').addEventListener('click', function() {
  hideSessionTimeoutWarning();
  resetSessionTimeout();
});

resetSessionTimeout()

//return to booking page
function rejectAndGoBack() {

    window.history.back();
}

// set space between card numbers
function cardspace() {
    var cardInput = document.getElementById('ccnum');
    var cardDigits = cardInput.value.replace(/\D/g, ''); // Remove non-numeric characters

    if (cardDigits.length > 0) {
        // Insert a space every 4 characters
        var formattedCard = cardDigits.replace(/(\d{4})/g, '$1 ').trim();
        
        // Update the input value
        cardInput.value = formattedCard;
    }
}
// Set up event listeners
document.getElementById('ccnum').addEventListener('input', cardspace);
document.getElementById('ccnum').addEventListener('paste', cardspace);


  </script>
