<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_table'])) {
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

    // Retrieve booking details from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $num_guests = $_POST['num_guests'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, date, time, num_guests) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $phone, $date, $time, $num_guests);

    // Execute the SQL statement
    if ($stmt->execute() === TRUE) {
        // Close statement and connection
        $stmt->close();
        $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Add your CSS styles for the confirmation popup */
    </style>
</head>
<body>
    <div class="popup">
        <div class="popup-content">
            <h2>Booking Confirmation</h2>
            <p>Your booking has been successfully submitted!</p>
            <a href="dashboard.html">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
<?php
        // Stop further execution
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
