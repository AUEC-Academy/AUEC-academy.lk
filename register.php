<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "navitha";
$dbname = "AUEC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phonenumber = $conn->real_escape_string(trim($_POST['phonenumber'])); // Correct field name

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered. Please use a different email.";
    } else {
        // Prepare and bind SQL statement
        $sql = "INSERT INTO users (name, email, phonenumber) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $phonenumber);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            header("Location: welcome.html");
            exit();
        } else {
            echo "Error: " . $stmt->error; // Display error if any
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
