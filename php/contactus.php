<?php 
include('contactform.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact us</title>
</head>
<body>
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
            <p>we enjoy to listening you problems and inquiries, so that e can reach your aspirations,
                Let's talk.</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-map" aria_hidden="true"></i>
                    </div>
                    <div class="text">
                        <h2>Address</h2>
                        <p>Madinag 42311, <br>King fasial road<br></p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h2>Phone</h2>
                        <p>+966 50 399 4436</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <h2>Email</h2>
                        <p>contactmagnolia70@gmail.com</p>
                    </div>
                </div>
            </div>
            <!--CONTACT FORM-->
            <div class="contactform">
                <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <h2>Send Message</h2>
                    <div class="inputbox">
                      <input type="text" name="fullName" id="fullName" value= "<?php echo $fullName?>" placeholder="Full Name">
                      <div><?php echo $errors['fullNameError'] ?></div>
                    </div>

                    <div class="inputbox">
                      <input type="text" name="email" id="email" value = "<?php echo $email?>" placeholder="Email">
                      <div><?php echo $errors['emailError'] ?></div>
                    </div>

                    <div class="inputbox">
                      <input type="text" name="subject" id="subject" value = "<?php echo $subject?>" placeholder="Subject">
                      <div><?php echo $errors['subjectError'] ?></div>
                    </div>

                    <div class="inputbox">
                      <textarea name="message" placeholder="Type your problem" value = <?php echo $message ?>></textarea>
                      <div><?php echo $errors['messageError'] ?></div>
                    </div>

                    <div class="inputbox">
                        <input class= "submit" type="submit" name="submit" onclick="openPopup()" value="Send">
                    </div>
                </form>
            </div>
            <div class="popup" id="popup">
              <i class="fa-solid fa-paper-plane"></i>
              <h2>Thank You for reaching out!</h2>
              <h3>we'll get back to you as soon as possible, your patience is truly appreciated.</h3>
              <button type="btn" onclick="closePopup()">Ok</button>
            </div>
        </div>
    </section>
</body>
</html>
<script>
    let popup = document.getElementById('popup')
    function openPopup(){
        popup.classList.add('open-popup')
    }

    function closePopup(){
        popup.classList.remove('open-popup')
    }

    window.onload = function() {
        const form = document.querySelector('.contact-form');

        form.addEventListener('submit', function(event) {
            
            event.preventDefault();

            openPopup();
        });
    };
    
</script>
<style>
    @import url("https://fonts.googleapis.com/css?family=Poppins");
*{
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    box-sizing: border-box;
    
}
html,body{
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    }
.navbar{
    top: 0;
    left: 0;
    right: 0;
    width: 90%;
    height: 100%;
    align-items: right;
    margin-left: 120px;
    padding-top: 0px;
}
nav{
    flex: 1;
    text-align: right;
}
nav ul li{
    list-style: none;
    display: inline-block;
    margin-top: 0;
    margin-left: 30px;
}
nav ul li a{
    text-decoration: none;
    color: #fff;
    font-size: 13px
}
.contact{
    position: relative;
    min-height: 100vh;
    padding: 80px 100px;
    display: flex;
    flex-direction: column;
    background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url(cc574782-f989-4ee5-b79d-689f5453d3eb.jpg);
    background-size: cover ;
}
.content{
    max-width: 800px;
    text-align: center;
    margin-left: 100px;
    margin-top: 50px;
}
.content h2{
    font-size: 36px;
    font-weight: 500;
    color: whitesmoke;
}
.content p{
    font-weight: 300;
    color: whitesmoke;
}
.container{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}
.container .contactInfo{
    width: 50%;
    display: flex;
    flex-direction: column;
}
.container .contactInfo .box{
    position: relative;
    padding: 20px 0;
    display: flex;

}
.container .contactInfo .box .icon{
    min-width: 40px;
    height: 40px;
    background: whitesmoke;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 15px;
}
.container .contactInfo .box .text {
    display: flex;
    margin-left: 20px;
    font-size: 13px;
    color: whitesmoke;
    flex-direction: column;
    font-weight: 300;
}
.container .contactInfo .box .text h3 {
    font-weight: 500;
    color: whitesmoke;
}
.contactform{
    width: 40%;
    padding: 40px;
    background: whitesmoke;
}
.contactform h2{
    font-size: 30px;
    color: #333;
    font-weight: 500;
}
.contactform .inputbox{
    position: relative;
    width: 100%;
    margin-top: 10px;
}
.contactform .inputbox input,
 .contactform .inputbox textarea {
    width: 100%;
    padding: 5px 0;
    font-size: 16px;
    margin: 10px 0;
    border: none;
    border-bottom: 2px solid #333;
    outline: none;
    resize: none;
}
.contactform .inputbox span{
    position: absolute;
    left: 0;
    padding: 5px 0;
    font-size: 16px;
    margin: 10px 0;
    pointer-events: none;
    transition: 0.5s;
    color: #666;
}
.contactform .inputbox input:focus ~ span,
.contactform .inputbox input:valid ~ span,
.contactform .inputbox textarea:focus ~ span,
.contactform .inputbox textarea:valid ~ span {
    color: #a27777;
    font-size: 12px;
    transform: translateY(-20px);
}
.contactform .inputbox input[type = "submit"]{
    width: 100px;
    background: #917763;
    color: whitesmoke;
    border:none;
    cursor: pointer;
    padding: 10px;
    font-size: 18px;
    transition : transform 0.2s;
}
.contactform .inputbox input[type = "submit"]:active{
    transform: scale(0.95);
}
.popup{
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    transform: translate(-50%, -50%) scale(0.1);
    text-align: center;
    padding: 0 30px 60px;
    visibility: hidden;
    max-width:380px;
    width:100%;
    border-radius: 24px;
    background-color: whitesmoke;
    transform: translate(-50%, -50%) scale(0.1);
    position: absolute;
    top: 0;
    left: 50%;
    padding: 30px 20px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.open-popup{
    visibility: visible;
    top: 50%;
    transform: translate(-50%, -50%) scale(1);
}
.popup i{
   font-size: 70px;
   color: #917763;
}
.popup h2{
   margin-top: 20px;
   font-style: 25px;
   font-weight: 500;
}
.popup h3{
   margin-top: 16px;
   font-weight: 400;
   text-align: center;
}
.popup button{
    background: #917763;
    color: whitesmoke;
    border:none;
    cursor: pointer;
    width: 80px;
    padding: 10px 19px;
    font-size: 18px;
    margin-top: 25px;
    margin: 18px;
    transition : transform 0.2s;
}
@media (max-width: 991px){
    .contact
    {
        padding: 50px;
    }
    .container{
        flex-direction: column;
    }
    .container .contactInfo{
        margin-bottom: 40px;
    }
    .container .contactInfo,
    .contactform
    {
        width: 100%;

    }
}
</style>
