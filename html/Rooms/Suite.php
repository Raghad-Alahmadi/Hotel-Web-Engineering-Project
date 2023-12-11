<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styleRooms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            overflow-x: hidden; 
        }

        .head {
            position: relative;
        }

        nav {
            background-color: #333;
        }

        nav a {
            color: #fff !important;
        }

        .swiper-container {
            width: 100%;
            height: 70vh;
            margin-top: 20px;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-info {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .room-info h2 {
            color: #AC3B61;
        }

        .room-info p {
            color: #666;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .room-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .room-info li {
            margin-bottom: 10px;
            color: #333;
        }

        .room-info i {
            margin-right: 5px;
            color: #AC3B61;
        }

        .booking-form {
            background-color: #AC3B61;
            color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .booking-form h2 {
            margin-bottom: 15px;
        }

        .booking-form label,
        .booking-form input,
        .booking-form button {
            display: block;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        .booking-form input,
        .booking-form button {
            padding: 10px;
        }

        .booking-form button {
            background-color: #fff;
            color: #AC3B61;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
            font-size: 1.2em;
            padding: 15px;
            font-weight: bold;
        }

        .booking-form button:hover {
            background-color: #8C2B4A;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: flex;
            bottom: 0;
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Suite Room - Magnolia Hotel</title>
</head>
<body>
    <section class="head">
        <nav>
            <a href="/html/home.html" class="logo">Magnolia</a>
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

        <!-- Image Slider -->
        <div class="swiper-container" style="width: 100%; height: 100vh;">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="/images/suite1.jpg" alt="Room Image 1" style="width: 100%; height: 100%; object-fit: cover;"></div>
                <div class="swiper-slide"><img src="/images/suite2.jpg" alt="Room Image 2" style="width: 100%; height: 100%; object-fit: cover;"></div>
                <div class="swiper-slide"><img src="/images/suite3.jpg" alt="Room Image 3" style="width: 100%; height: 100%; object-fit: cover;"></div>
                <div class="swiper-slide"><img src="/images/suite4.jpg" alt="Room Image 4" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Room Information Section -->
        <section class="room-info">
            <h2>Suite Room</h2>
            <p>Indulge in luxury with our spacious suite rooms. Perfect for those who seek an extraordinary stay with top-notch amenities.</p>
            <ul>
                <li><i class="fas fa-bed"></i> King-sized Bed</li>
                <li><i class="fas fa-tv"></i> Smart TV</li>
                <li><i class="fas fa-coffee"></i> Coffee Maker</li>
                <!-- Add more features as needed -->
            </ul>
            <p><strong>Price:</strong> 1350 SAR per night</p>
        </section>

        <!-- Booking Form -->
        <section class="booking-form">
            <h2>Book Your Stay</h2>
            <form action="/html/book.php" method="post">
                <!-- Add form fields for the suite room -->

                <button type="submit">Book Now</button>
            </form>
        </section>
    </section>

    <section class="footer">
        <p>&copy; 2023 Magnolia Hotel. All rights reserved.</p>
    </section>

    <script src="/JavaScript/client.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>
</html>
