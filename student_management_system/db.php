<?php
$servername = "localhost";
$username = "root";  // MySQL username
$password = "hrishita";      // MySQL password
$dbname = "student_system";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
