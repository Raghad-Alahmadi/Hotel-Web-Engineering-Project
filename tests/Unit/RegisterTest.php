<?php
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {

    public function testRegistration() {
        require_once 'register.php'; 

        $conn = createConnection();

        // Test with valid registration data
        $validRegistrationData = [
            'firstName' => 'Raghad',
            'lastName' => 'Alahmadi',
            'username' => 'raghad_alahmadi',
            'email' => 'raghad@eamil.com',
            'password' => '12345678'
        ];

        $this->assertFalse(checkExistingUser($conn, $validRegistrationData['username']));

        registerUser($conn, $validRegistrationData);

        $this->assertTrue(checkExistingUser($conn, $validRegistrationData['username']));

        // Test with invalid registration data (missing required field)
        $invalidRegistrationData = [
            'firstName' => 'Raghad',
            'lastName' => 'Alahmadi',
            'username' => '', // Missing required field
            'email' => 'raghad@email.com',
            'password' => '12345678'
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Please fill in all the fields.");

        registerUser($conn, $invalidRegistrationData);

        $conn->close();
    }
}
?>
