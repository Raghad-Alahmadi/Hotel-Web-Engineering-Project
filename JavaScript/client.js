// client.js
function openModal(button) {
        var modal = document.getElementById('bookingModal');
        var room = button.getAttribute('data-room');
        var description = button.getAttribute('data-description');
        var price = button.getAttribute('data-price');

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

    // Function to confirm the booking and proceed to the payment gateway
    function confirmBooking() {

        var room = document.getElementById('modalRoom').textContent;
        var description = document.getElementById('modalDescription').textContent;
        var price = document.getElementById('modalPrice').textContent;
    
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        description: description,
                        amount: {
                            value: price.replace(/\D/g, '') // Remove non-numeric characters
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Send details to your server for verification and further processing
                    handlePaymentConfirmation(details);
                });
            }
        }).render('#paypal-button-container');
    }
    
    function handlePaymentConfirmation(details) {
        // Make an AJAX request to your server with the payment details
             var xhr = new XMLHttpRequest();
            xhr.open('POST', '/your-paypal-endpoint', true);
             xhr.setRequestHeader('Content-Type', 'application/json');
    
             xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                 // Handle the server response (e.g., redirect to a success page)
                 alert('Booking confirmed! Redirecting...');
                    window.location.href = '/success.html';
                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                // Handle errors
                alert('Error confirming booking. Please try again.');
            }
        };
    
        var data = {
            paymentDetails: details,
            room: room,
            description: description,
            price: price
        };
    
        xhr.send(JSON.stringify(data));
    }