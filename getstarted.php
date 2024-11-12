<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "keyless_entry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to authenticate user
function authenticateUser($username, $password) {
    global $conn;

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return true; // Authentication successful
    } else {
        return false; // Authentication failed
    }
}

// Function to generate access code
function generateAccessCode($userId) {
    // Implement a secure random code generation method
    $code = rand(1000, 9999); // Example: Generate a 4-digit code

    // Store the code in the database, associated with the user and a time limit
    $sql = "INSERT INTO access_codes (user_id, code, expiration_time) VALUES ('$userId', '$code', NOW() + INTERVAL 10 MINUTE)";
    $conn ->query($sql);

    return $code;
}

// Function to validate access code
function validateAccessCode($code) {
    global $conn;

    $sql = "SELECT * FROM access_codes WHERE code='$code' AND expiration_time > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 1) {
        // Code is valid, mark it as used
        $sql = "DELETE FROM access_codes WHERE code='$code'";
        $conn->query($sql);
        return true;
    } else {
        return false;
    }
}

// Example usage:
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateUser($username, $password)) {
        // Authentication successful, generate access code
        $userId = getUserIdFromUsername($username); // Assuming a function to get user ID
        $accessCode = generateAccessCode($userId);

        // Send the access code to the user (e.g., via SMS, email, or app notification)
        // ...
    } else {
        // Authentication failed
        // ...
    }
}

if (isset($_POST['access_code'])) {
    $accessCode = $_POST['access_code'];

    if (validateAccessCode($accessCode)) {
        // Access granted
        // Trigger door unlock mechanism or other actions
        // ...
    } else {
        // Access denied
        // ...
    }
}

$conn->close();
?>