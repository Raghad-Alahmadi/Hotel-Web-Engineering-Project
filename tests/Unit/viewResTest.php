<?php

require 'viewRes.php'; 

use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    public function testFetchReservations()
    {
        // Mock the session
        $sessionMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['start'])
            ->getMock();

        // Set the session username
        $sessionMock->username = 'test_user';

        // Mock the MySQLi connection
        $connMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create an instance of your reservation script class
        $reservationHandler = new YourReservationsScript($connMock, $sessionMock);

        // Set up the expected SQL query and result
        $expectedSql = "SELECT ReservationID, CustomerName, RoomID, CheckInDate, CheckOutDate, Room_type, Quantity, Total FROM reservations WHERE CustomerName = 'test_user'";
        $expectedResult = $this->createMock(mysqli_result::class);

        // Configure the mock query result
        $connMock->expects($this->once())
            ->method('query')
            ->with($expectedSql)
            ->willReturn($expectedResult);

        // Call the method under test
        $result = $reservationHandler->fetchReservations();

        // Assert that the result matches the expected result
        $this->assertEquals($expectedResult, $result);
    }
}
