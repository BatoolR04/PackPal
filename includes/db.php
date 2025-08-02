<?php
// Enable error reporting to help debug issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "raza43_packpal";
$password = "TfZk66eU6yBtQkuLBGrZ";
$database = "raza43_packpal";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
