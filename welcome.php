<?php
session_start(); // Start a session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to login page
    header("Location: login.html");
    exit();
}

// Retrieve user information from session
$user_email = $_SESSION['user_email'];
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; // Default to 'Guest' if name is not set

// Store the user info in session variables to be used in the HTML
$_SESSION['user_name'] = $user_name;
$_SESSION['user_email'] = $user_email;

// Redirect to the welcome.html page
header("Location: welcome.html");
exit();
?>


<!--DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - AUEC Academy</title>
</head>
<body>
    <h1>Welcome!</h1>
    <p id="user-info">You are logged in as: <?php echo htmlspecialchars($user_name); ?></p> <!-- Display user name -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
