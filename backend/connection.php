<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "web_project";

// Create connection
$conn = new mysqli($host, $username, $password, $database);
//echo "connected";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
