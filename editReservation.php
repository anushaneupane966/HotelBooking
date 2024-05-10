<?php
// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage.php");
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

// Fetch reservation details
$id = $_GET['id'];
$sql = "SELECT * FROM reservations WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $reservation = $result->fetch_assoc();
} else {
    echo "Reservation not found.";
    exit();
}

// Update reservation details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $num_guests = $_POST['num_guests'];

    // Update reservation in the database
    $sql = "UPDATE reservations SET name = '$name', email = '$email', phone = '$phone', date = '$date', time = '$time', num_guests = $num_guests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Reservation updated successfully."); window.location.href = "My_bookings.html";</script>';
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="editReservation.css">
</head>
<body>
    <h2>Edit Reservation</h2>
    <form method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $reservation['name']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $reservation['email']; ?>"><br>
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" value="<?php echo $reservation['phone']; ?>"><br>
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $reservation['date']; ?>"><br>
        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" value="<?php echo $reservation['time']; ?>"><br>
        <label for="num_guests">Number of Guests:</label><br>
        <input type="number" id="num_guests" name="num_guests" value="<?php echo $reservation['num_guests']; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
