<?php
require_once 'reserveAction.php'; 

class ReservationHandlerTest extends \PHPUnit\Framework\TestCase {
    public function testMakeReservation() {
        // Mock the database connection
        $connMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new ReservationHandler($connMock);

        // Test reservation with valid data
        $result = $handler->makeReservation('test_user', '2023-01-01', '2023-01-05', 2, 1, 'Single Room', 600);
        $this->assertTrue($result);

    }
}
?>
