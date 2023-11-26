<?php
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styleRooms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://www.paypal.com/sdk/js?client-id=AU2LA8qg5HOY2EJE4dtjXIGkdiMr2LmEll2zgArKmE56GYZq_n5kl0fR1le-sl9xmj3DYCJc9iVCoOHq"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>Rooms</title>
</head>
<body>
    <section class="head">
        <nav>
            <a href="/html/home.html" class="logo">Magnolia</a>
    
            <div class="links">
                <ul>
                    <li><a href="/html/home.html">HOME</a></li>
                    <li><a href="/html/AboutUs.html">ABOUT US</a></li>
                    <li><a href="/html/ContactUs.html">CONTACT US</a></li>
                    <li><a href="/html/Rooms.html">ROOMS</a></li>
                    <li><a href="/html/Login/login.php">LOGIN</a></li>

                </ul>
            </div>
        </nav>
        

        <div class="menu" id="Menu">
            <h1>The <span> Rooms</span> </h1>


            <div id="editReservationContainer" style="display: none;">
                <a href="/html/editReservation.html" class="menu-btn">Edit Reservation</a>
            </div>


            <div class="menu-box">
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="/images/room1.jpg" alt="">
                    </div>

                    <div class="menu-info">
                        <h2>Single Room</h2>
                        <p>Step into simplicity and comfort in our Single Room, where a cozy bed and modern amenities await the solo traveler. Unwind in a tranquil space designed for ultimate relaxation, offering a perfect retreat within the heart of our hotel.</p>
                        <h3>600 <strong>SAR</strong></h3>
                        <div class="menu-icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <a href="javascript:void(0);" class="menu-btn" onclick="openModal(this)" data-room="Single Room" data-description="Step into simplicity and comfort..." data-price="600">Book Now</a>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-image">
                        <img src="/images/room2.jpg" alt="">
                    </div>
                    <div class="menu-info">
                        <h2>Suite Room</h2>
                        <p>Indulge in luxury and sophistication in our Suite Room, where opulent furnishings and spacious comfort harmonize to create an exquisite retreat for an elevated stay experience. Unwind in style and embrace a heightened level of hospitality, as our Suite Room beckons with a blend of refined elegance and modern amenities.</p>
                        <h3>1,315 <strong>SAR</strong></h3>
                        <div class="menu-icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        
                        <a href="javascript:void(0);" class="menu-btn" onclick="openModal(this)" data-room="Suite Room" data-description="Indulge in luxury and sophistication..." data-price="1315">Book Now</a>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-image">
                        <img src="/images/room3.jpg" alt="">
                    </div>

                    <div class="menu-info">
                        <h2>Presidential Suite</h2>
                        <p>Experience the epitome of luxury in our Presidential Suite, where extravagance knows no bounds. This exclusive haven combines opulent design, unmatched comfort, and unparalleled service to redefine the art of indulgence, ensuring an extraordinary stay for those seeking the pinnacle of refinement.</p>
                        <h3>5,000 <strong>SAR</strong></h3>
                        <div class="menu-icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <a href="javascript:void(0);" class="menu-btn" onclick="openModal(this)" data-room="Presidential Suite" data-description="Experience the epitome of luxury..." data-price="5000">Book Now</a>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-image">
                        <img src="/images/room4.jpg" alt="">
                    </div>
                    <div class="menu-info">
                        <h2>Double Room</h2>
                        <p>Elevate your stay in our Double Room, a harmonious blend of comfort and style designed for pairs. Immerse yourself in a relaxing ambiance, where modern amenities and thoughtful details ensure a delightful retreat for two.</p>
                        <h3>900 <strong>SAR</strong></h3>
                        <div class="menu-icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        
                        </div>
                        <a href="javascript:void(0);" class="menu-btn" onclick="openModal(this)" data-room="Double Room" data-description="Elevate your stay in our Double Room..." data-price="900">Book Now</a>
                    </div>
                </div>
            </div>
        </div>



        <div id="bookingModal" class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
    
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <img src="/images/room1.jpg" alt="Room 1" style="max-width: 60%; height: auto;">
                        
                    </div>

                </div>
                <!-- Add Pagination -->

            </div>
    
            <h2 id="modalRoom">Booking Details</h2>
            <p id="modalDescription">Description goes here.</p>
            <p id="modalPrice">Price: 0 SAR</p>

            <!--  check-in and check-out date inputs -->
            <div class="date-inputs">
                <label for="checkInDate">Check-in Date:</label>
                <input type="date" id="checkInDate" name="checkInDate" required>

                <label for="checkOutDate">Check-out Date:</label>
                <input type="date" id="checkOutDate" name="checkOutDate" required>
            </div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1">
            <button id="confirmBookingBtn" onclick="confirmBooking(); showInvoice();">Confirm Booking</button>


    
            <!-- Invoice Content Div -->
            <div id="invoiceContent" style="display: none;">
                <h2>Booking Invoice</h2>
                <p><strong>Room Type:</strong> <span id="invoiceRoom"></span></p>
                <p><strong>Description:</strong> <span id="invoiceDescription"></span></p>
                <p><strong>Price per Unit:</strong> <span id="invoicePrice"></span></p>
                <p><strong>Date:</strong> <span id="invoiceDate"></span></p>
                <p><strong>Quantity:</strong> <span id="invoiceQuantity"></span></p>
                <hr>
                <p><strong>Total:</strong> <span id="invoiceTotal"></span></p>
                <button onclick="checkout()">Checkout</button>
                <button onclick="goBack()">Go Back</button>
            </div>
        </div>


        <section class="footer">
            <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
        </section>
       
        <script src="/JavaScript/client.js"></script>


    </body>
</html>