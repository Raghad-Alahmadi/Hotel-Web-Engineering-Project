const express = require('express');
const bodyParser = require('body-parser');
const paypal = require('@paypal/checkout-server-sdk');
const path = require('path'); // Add this line for path module

const app = express();
const port = 3001;

app.use(bodyParser.json());

const clientId = 'AU2LA8qg5HOY2EJE4dtjXIGkdiMr2LmEll2zgArKmE56GYZq_n5kl0fR1le-sl9xmj3DYCJc9iVCoOHq';
const clientSecret = 'EP0UlQINbfhYS1Mf0W6eQVr0LYEecrjTzY_YzspcIMQsMz7f_p3sR0RH6ED3wTw_m3dQ6CWl3-EfOB38';

const environment = new paypal.core.SandboxEnvironment(clientId, clientSecret);
const client = new paypal.core.PayPalHttpClient(environment);

// Serve static files from the 'html' directory
app.use(express.static(path.join(__dirname, 'Desktop', 'Web Engineering Project', 'html')));

app.post('/your-paypal-endpoint', async (req, res) => {
    const orderID = req.body.paymentDetails.id;

    try {
        const request = new paypal.orders.OrdersGetRequest(orderID);
        const response = await client.execute(request);

        // Process the order details and perform necessary actions

        res.status(200).send('Payment confirmed successfully');
    } catch (error) {
        console.error(error);
        res.status(500).send('Error confirming payment');
    }
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
