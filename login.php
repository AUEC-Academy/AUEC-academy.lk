<?php
session_start(); // Start a session to manage user login state

error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1); // Show errors on the screen

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "navitha"; // Set this to your password if one exists
$dbname = "AUEC"; // Make sure this database exists

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string(trim($_POST['email'])); // Sanitize input

    // Prepare and execute the SQL query to check for the user
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User found, set session variable and redirect to welcome page
        $_SESSION['user_email'] = $email; // You can store more user info as needed
        header("Location: welcome.php");
        exit();
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>
