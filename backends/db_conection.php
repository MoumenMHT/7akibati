<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$database = "7akibati"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, "", $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
