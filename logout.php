<?php
session_start(); // Start the session
session_destroy(); // Destroy the session
header("Location: login.html"); // Redirect to the login page
exit();
?>
