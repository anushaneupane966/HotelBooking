<?php
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

// Retrieve user's email from session
session_start();
$userEmail = $_SESSION['email'];

// Calculate date range for the next 7 days
$currentDate = date('Y-m-d');
$endDate = date('Y-m-d', strtotime('+7 days'));

// Query to retrieve bookings for the next 7 days associated with the user's email
$sql = "SELECT * FROM reservations WHERE date BETWEEN '$currentDate' AND '$endDate' AND email = '$userEmail'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Check if there are any bookings
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "<h3>Booking #" . $row['id'] . "</h3>";
            echo "<p>Name: " . $row['name'] . "</p>";
            echo "<p>Date: " . date('F j, Y', strtotime($row['date'])) . "</p>";
            echo "<p>Time: " . date('g:i A', strtotime($row['time'])) . "</p>";
            echo "<p>Number of Guests: " . $row['num_guests'] . "</p>";

            // Check if the "status" key exists in the row array
            if (isset($row['status'])) {
                echo "<p>Status: " . $row['status'] . "</p>";
            } else {
                echo "<p>Status: Unknown</p>"; // Handle the case where "status" is not present
            }

            // Output edit and delete buttons
            echo "<button onclick=\"editBooking(" . $row['id'] . ")\">Edit</button>";
            echo "<button onclick=\"deleteBooking(" . $row['id'] . ")\">Delete</button>";

            echo "</li>";
        }
    } else {
        echo "<li>No bookings for the next 7 days </li>";
    }
}

// Close connection
$conn->close();
?>
