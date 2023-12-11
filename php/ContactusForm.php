<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
//connection
$conn = mysqli_connect('localhost', 'root', '', 'contactus');
if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

if (isset($_POST['fullName'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
} else {
    $fullName = ''; // Set a default value or handle the absence of data.
}

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
} else {
    $email = ''; // Set a default value or handle the absence of data.
}

if (isset($_POST['subject'])) {
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
} else {
    $subject = '';
}

if (isset($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
} else {
    $message = '';
}

    $sql_s = 'SELECT * FROM contact';
    $result = mysqli_query($conn, $sql_s);
    mysqli_free_result($result);


if(isset($_POST["submit"])){
    $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'contactmagnolia70@gmail.com';   //SMTP write your email
    $mail->Password   = 'pfeoosbpgiqoghtt';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465; 
    
    $mail->Timeout = 30; // Set the timeout value in seconds

    //Recipients
    $mail->addAddress('contactmagnolia70@gmail.com');      
   
  
 
    //Content
    $mail->isHTML(true);              
    $mail->Subject = $_POST["subject"];   
    $mail->Body    = $_POST["message"]; 

    try {
        // Send the email
        $mail->send();

        $sql = "INSERT INTO contact (fullName, email, subject) 
                VALUES ('$fullName', '$email', '$subject')";

        if (mysqli_query($conn, $sql)) {
            
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    mysqli_close($conn);
}

  
