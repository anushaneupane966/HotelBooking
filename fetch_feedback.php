<?php
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

// SQL query to fetch feedback
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

$feedbackData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($feedbackData);
?>
