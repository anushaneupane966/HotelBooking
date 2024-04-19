<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "astro"; 
    $password = "Serena562181"; 
    $dbname = "rdbs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the form
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Validate username format (only alphabetic characters)
    if (!ctype_alpha($entered_username)) {
        // Invalid username format, display an error message
        echo "<script>alert('Username should consist exclusively of alphabetic characters');</script>";
        // Redirect the user back to index.html
        echo "<script>window.location.href = 'index.html?error=Invalid%20username%20format';</script>";
        exit(); // Stop further execution
    }

    // Validate password format (minimum 8 characters)
    if (strlen($entered_password) < 8) {
        // Invalid password format, display an error message
        echo "<script>alert('Password should have a minimum of 8 characters');</script>";
        // Redirect the user back to index.html
        echo "<script>window.location.href = 'index.html?error=Invalid%20password%20format';</script>";
        exit(); // Stop further execution
    }

    // Query to check if the username and password match
    $sql = "SELECT * FROM signup WHERE Username='$entered_username' AND Password='$entered_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password match
        // Start session and store user information if needed
        session_start();
        $_SESSION['username'] = $entered_username;
        // Redirect to dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password, display an error message
        echo "<script>alert('Invalid username or password');</script>";
        // Redirect the user back to index.html
        echo "<script>window.location.href = 'index.html?error=Invalid%20username%20or%20password';</script>";
    }

    $conn->close();
} else {
    // Redirect back to index.html if the form is not submitted
    header("Location: index.html");
    exit();
}
?>
