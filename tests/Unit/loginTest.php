<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {

    public function testLoginUser() {
        require_once 'login.php';

        $conn = createConnection();

        // Test with valid credentials
        $validUser = loginUser($conn, 'valid_username', 'valid_password');
        $this->assertNotFalse($validUser);
        $this->assertArrayHasKey('username', $validUser);

        // Test with invalid username
        $invalidUser = loginUser($conn, 'invalid_username', 'valid_password');
        $this->assertFalse($invalidUser);

        // Test with invalid password
        $invalidPassword = loginUser($conn, 'valid_username', 'invalid_password');
        $this->assertFalse($invalidPassword);

        $conn->close();
    }
}
?>
