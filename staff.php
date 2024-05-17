<?php
// Database connection parameters
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

// Fetch staff data
function fetchStaffData($conn) {
    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);

    $staffData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $staffData[] = $row;
        }
    }

    return $staffData;
}

// Add staff
function addStaff($conn, $name, $email, $phone, $role) {
    $sql = "INSERT INTO staff (name, email, phone, role) VALUES ('$name', '$email', '$phone', '$role')";
    if ($conn->query($sql) === TRUE) {
        return "New staff added successfully";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fire staff
function fireStaff($conn, $id) {
    $sql = "DELETE FROM staff WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        return "Staff fired successfully";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["role"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];

        echo addStaff($conn, $name, $email, $phone, $role);
    }

    if (isset($_POST["staffId"])) {
        $id = $_POST["staffId"];

        echo fireStaff($conn, $id);
    }
} else {
    // Fetch staff data
    echo json_encode(fetchStaffData($conn));
}

$conn->close();
?>
