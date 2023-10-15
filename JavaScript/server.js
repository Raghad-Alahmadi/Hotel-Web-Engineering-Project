const express = require('express');
const sql = require('mssql');

const app = express();
const port = 3000;

// SQL Server configuration
const config = {
    server: 'RIE',
    database: 'Hotel_Users',
    options: {
        encrypt: true // For Azure
    }
};

// API endpoint to fetch users
app.get('/api/users', async (req, res) => {
    try {
        // Connect to the database
        await sql.connect(config);

        // Execute the query
        const result = await sql.query('SELECT * FROM HotelUsers');

        // Send the result as JSON
        res.json(result.recordset);
    } catch (err) {
        console.error('Error:', err.message);
        res.status(500).send('Internal Server Error');
    } finally {
        // Close the connection
        await sql.close();
    }
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
