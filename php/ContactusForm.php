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

$errors = [
    'fullNameError' => '',
    'emailError' => '',
    'subjectError' => '',
    'messageError' => '',
];

if (isset($_POST['submit'])) {
    if (empty($fullName)) {
        $errors['fullNameError'] = 'Please Enter your Name';
    }

    if (empty($email)) {
        $errors['emailError'] = 'Please Enter your Email';
    }
     elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['emailError'] = 'Please enter a correct email address';
    }

    if (empty($subject)) {
        $errors['subjectError'] = 'Please Enter message subject';
    }

    if (empty($message)) {
        $errors['messageError'] = 'Please, feel free to express any questions or problem';
    } else {
        $sql = "INSERT INTO contact(fullName, Email, subject) 
        VALUES ('$fullName', '$email', '$subject')";

        if (mysqli_query($conn, $sql)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    $sql_s = 'SELECT * FROM contact';
    $result = mysqli_query($conn, $sql_s);
    mysqli_free_result($result);
    mysqli_close($conn);



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


  $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'contactmagnolia70@gmail.com';   //SMTP write your email
    $mail->Password   = 'clcjmsrgbwckdbjg';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $mail->setFrom($_POST["email"], $_POST["fullName"]);
    }else{
      $errors['emailError'] = 'Please enter a correct email address';
    }
    //Recipients
    $mail->addAddress('contactmagnolia70@gmail.com');     //Add a recipient email  
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $mail->addReplyTo($email, $fullName);
    } else {
        $errors['emailError'] = 'Please enter a correct email address';
    }
  
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings//email message
    try {
      $mail->Body    = $message;
      // Send the email
      $mail->send();
      echo 'Email has been sent';
    } catch (Exception $e) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    // Success sent message alert
   
  }
