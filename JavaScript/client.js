var currentBooking = {}; // Variable to store current booking details
var prevModalContent = ''; // Variable to store previous modal content


window.onload = function() {
    checkLoggedInUser();
};
// Initialize Swiper

function confirmBooking() {
    // Retrieve booking details
    var room = document.getElementById('modalRoom').textContent;
    var description = document.getElementById('modalDescription').textContent;
    var price = document.getElementById('modalPrice').textContent.replace('Price: ', '');
    var checkInDate = document.getElementById('checkInDate').value;
    var checkOutDate = document.getElementById('checkOutDate').value;
    var quantity = document.getElementById('quantity').value;

        // Retrieve username from input
        var userNameInput = document.getElementById('userName');
        var userName = userNameInput.value;
        document.getElementById("invoiceRoom").innerText = selectedRoomText;
    // Create invoice content
    var invoiceContent = document.createElement('div');
    invoiceContent.innerHTML = `
        <h2>Booking Invoice</h2>
        <p><strong>User:</strong> ${userName}</p>
        <p><strong>Room:</strong> ${room}</p>
        <p><strong>Description:</strong> ${description}</p>
        <p><strong>Price:</strong> ${price}</p>
        <p><strong>Check-in Date:</strong> ${checkInDate}</p>
        <p><strong>Check-out Date:</strong> ${checkOutDate}</p>
        <p><strong>Quantity:</strong> ${quantity}</p>
        <hr>
        <p><strong>Total:</strong> ${calculateTotalPrice(price, quantity)}</p>
        <button onclick="checkout()">Checkout</button>
        <button onclick="goBack()">Go Back</button>
    `;
    currentBooking = {
        room: room,
        description: description,
        price: price,
        checkInDate: checkInDate,
        checkOutDate: checkOutDate,
        quantity: quantity
    };
    // Append the invoice content to the existing modal content
    var modal = document.getElementById('bookingModal');
    modal.innerHTML = ''; // Clear existing content
    modal.appendChild(invoiceContent);
    showInvoice();

    var formData = new FormData();
    formData.append("room", room);
    formData.append("description", description);
    formData.append("price", price);
    formData.append("checkInDate", checkInDate);
    formData.append("checkOutDate", checkOutDate);
    formData.append("quantity", quantity);
    formData.append("userName", userName); // Add userName to the FormData
    
    // Send a POST request to the PHP script
    fetch('/html/book.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Assuming the PHP script echoes the received data for demonstration
        console.log(data);
        // Handle the response as needed
    })
    .catch(error => console.error('Error:', error));

    var totalAmount = calculateTotalPrice(price, quantity);
    
    // Redirect to the PHP page with the total amount as a query parameter
    window.location.href = '/php/index.php?totalAmount=' + totalAmount;


    // Send the data to the server
    xhr.send(
        "roomType=" + encodeURIComponent(roomType) +
        "&checkInDate=" + encodeURIComponent(checkInDate) +
        "&checkOutDate=" + encodeURIComponent(checkOutDate) +
        "&quantity=" + encodeURIComponent(quantity) +
        "&description=" + encodeURIComponent(description) +
        "&price=" + encodeURIComponent(price) +
        "&totalPrice=" + encodeURIComponent(totalPrice) +
        "&username=" + encodeURIComponent(username)
    );

}

function showInvoice() {
    var invoiceContent = document.getElementById('invoiceContent');
    var userName = document.getElementById('userName').value; // Get the userName input value
    document.getElementById('invoiceUser').innerText = userName; // Set the userName in the invoice
    invoiceContent.style.display = 'block';
}
function checkout() {
    // Redirect to the payment page or handle payment logic
    alert('Redirecting to the payment page.');
    window.location.href = '/php/index.php';
}

function calculateTotalPrice(price, quantity) {
    // Extract numerical value from the price string
    var unitPrice = parseFloat(price.replace(/[^\d.]/g, ''));

    // Check if the extracted value is a valid number
    if (isNaN(unitPrice)) {
        console.error('Invalid price format:', price);
        return 'Invalid Price';
    }

    // Calculate total price
    var total = unitPrice * quantity;
    return total.toFixed(2) + ' SAR'; // Format total with two decimal places
}

// Function to get room images based on room type
function getRoomImages(roomType) {
    // Define a mapping of room types to image sources
    var roomImagesMap = {
        'Single Room': ['/images/room1.jpg', '/images/room1(2).jpg'],
        'Suite Room': ['/images/room2.jpg', '/images/room2(2).jpg'],
        'Presidential Suite': ['/images/room3.jpg', '/images/room3(2).webp'],
        'Double Room': ['/images/room4.jpg', '/images/room4(2).jpg'],
    };

    // Return the images based on the room type
    return roomImagesMap[roomType] || [];
}

function openModal(button) {
    var modal = document.getElementById('bookingModal');
    var room = button.getAttribute('data-room');
    var description = button.getAttribute('data-description');
    var price = button.getAttribute('data-price');



        // Get the check-in and check-out date inputs
        var checkInDate = new Date(document.getElementById('checkInDate').value);
        var checkOutDate = new Date(document.getElementById('checkOutDate').value);
    
        // Check if the check-out date is before the check-in date
        if (checkOutDate < checkInDate) {
            alert('Check-out date cannot be before the check-in date.');
            return; // Stop further execution
        }


    // Store the current modal content before modifying it
    prevModalContent = modal.innerHTML;

    // Get the container for Swiper slides
    var swiperWrapper = document.querySelector('.swiper-wrapper');

    // Clear existing slides
    swiperWrapper.innerHTML = '';

    // Get the room images based on the room type
    var roomImages = getRoomImages(room);

    // Create new Swiper slides based on room images
    roomImages.forEach(function (imageSrc) {
        var swiperSlide = document.createElement('div');
        swiperSlide.className = 'swiper-slide';
        var image = document.createElement('img');
        image.src = imageSrc;
        image.alt = room;
        swiperSlide.appendChild(image);
        swiperWrapper.appendChild(swiperSlide);
    });

    // Set modal content dynamically
    document.getElementById('modalRoom').textContent = room;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalPrice').textContent = 'Price: ' + price + ' SAR';

    modal.style.display = 'block';
    modal.style.animation = 'modalFadeIn 0.5s';

    // Initialize Swiper after updating the slides
    var mySwiper = new Swiper('.swiper-container', {
        // Add Swiper options if needed
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
}

function closeModal() {
    var modal = document.getElementById('bookingModal');
    modal.style.display = 'none';
}

function goBack() {
    var modal = document.getElementById('bookingModal');

    // Check if previous content is defined before using it
    if (prevModalContent !== undefined) {
        modal.innerHTML = prevModalContent;

        // Set the modal content to the original booking details
        document.getElementById('modalRoom').textContent = currentBooking.room;
        document.getElementById('modalDescription').textContent = currentBooking.description;
        document.getElementById('modalPrice').textContent = 'Price: ' + currentBooking.price ;

        // Set other details like date and quantity if needed
        document.getElementById('checkInDate').value = currentBooking.checkInDate;
        document.getElementById('checkOutDate').value = currentBooking.checkOutDate;
        document.getElementById('quantity').value = currentBooking.quantity;

        // Clear existing slides before repopulating
        var swiperWrapper = document.querySelector('.swiper-wrapper');
        swiperWrapper.innerHTML = ''; // Clear existing slides

        // Repopulate the slider with images for the current room type
        var roomImages = getRoomImages(currentBooking.room);

        roomImages.forEach(function (imageSrc) {
            var swiperSlide = document.createElement('div');
            swiperSlide.className = 'swiper-slide';
            var image = document.createElement('img');
            image.src = imageSrc;
            image.alt = currentBooking.room;
            swiperSlide.appendChild(image);
            swiperWrapper.appendChild(swiperSlide);
        });

        // Initialize Swiper after updating the slides
        var mySwiper = new Swiper('.swiper-container', {
            // Add Swiper options if needed
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        openModal(); // Open the modal 
    }
}


$(document).ready(function () {
    // Existing JavaScript code

    // Add the following click event handler for the "Book Now" button
    $('.btn-book-now').click(function () {
        var roomId = $(this).data('room-id');
        var roomType = $(this).closest('tr').find('td:nth-child(2)').text(); // Assuming room type is in the second column
        var price = $(this).closest('tr').find('td:nth-child(3)').text(); // Assuming price is in the third column

       
        var bookingPage = "/html/admin-dashboard/booking.php";

        // Redirect to the booking page with the details
        window.location.href = bookingPage + "?roomId=" + roomId + "&roomType=" + roomType + "&price=" + price;
    });
});