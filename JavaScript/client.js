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
    var price = document.getElementById('modalPrice').textContent;
    var date = document.getElementById('bookingDate').value;
    var quantity = document.getElementById('quantity').value;

    // Create invoice content
    var invoiceContent = document.createElement('div');
    invoiceContent.innerHTML = `
        <h2>Booking Invoice</h2>
        <p><strong>Room:</strong> ${room}</p>
        <p><strong>Description:</strong> ${description}</p>
        <p><strong>Price:</strong> ${price}</p>
        <p><strong>Date:</strong> ${date}</p>
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
        date: date,
        quantity: quantity
    };
    // Append the invoice content to the existing modal content
    var modal = document.getElementById('bookingModal');
    modal.innerHTML = ''; // Clear existing content
    modal.appendChild(invoiceContent);

    openInvoice();
}

function showInvoice() {
    var invoiceContent = document.getElementById('invoiceContent');
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
function openModal(button) {
    var modal = document.getElementById('bookingModal');
    var room = button.getAttribute('data-room');
    var description = button.getAttribute('data-description');
    var price = button.getAttribute('data-price');

    // Store the current modal content before modifying it
    prevModalContent = modal.innerHTML;

    // Set modal content dynamically
    document.getElementById('modalRoom').textContent = room;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalPrice').textContent = 'Price: ' + price + ' SAR';

    modal.style.display = 'block';
    modal.style.animation = 'modalFadeIn 0.5s';
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
        document.getElementById('modalPrice').textContent = currentBooking.price;

        // Set other details like date and quantity if needed
        document.getElementById('bookingDate').value = currentBooking.date;
        document.getElementById('quantity').value = currentBooking.quantity;
        openModal(); // Open the modal 
    }
}


//


function checkLoggedInUser() {
    // Assuming you store the user's login status in localStorage
    var isLoggedIn = localStorage.getItem('isLoggedIn');

    // Get the edit reservation list item
    var editReservationListItem = document.getElementById('editReservationContainer');

    // Display the "Edit Reservation" button if the user is logged in, otherwise hide it
    if (isLoggedIn === 'true') {
        editReservationListItem.style.display = 'block';
    } else {
        editReservationListItem.style.display = 'none';
    }
}

// Function to simulate a login action
function simulateLogin() {
    // Set the user as logged in in localStorage
    localStorage.setItem('isLoggedIn', 'true');
    
    // Refresh the page to reflect the changes
    location.reload();
}

// Function to simulate a logout action
function simulateLogout() {
    // Remove the user's login status from localStorage
    localStorage.removeItem('isLoggedIn');
    
    // Refresh the page to reflect the changes
    location.reload();
}
