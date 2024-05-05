<?php
// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    echo "No reservation ID provided.";
    exit();
}

// Database configuration
$servername = "localhost";
$username = "astro";
$password = "Serena562181";
$database = "rdbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reservation ID from GET parameters
$id = $_GET['id'];

// SQL to delete the canceled reservation from cancelReservation table
$sql_delete = "DELETE FROM cancelReservation WHERE id = $id";

if ($conn->query($sql_delete) === TRUE) {
    echo "Reservation canceled successfully.";
} else {
    echo "Error canceling reservation: " . $conn->error;
}

// Close the database connection
$conn->close();
?>