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

    // Query to check if the username and password match
    $sql = "SELECT * FROM signup WHERE Username='$entered_username' AND Password='$entered_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password match
        // Start session and store user information if needed
        session_start();
        $_SESSION['username'] = $entered_username;

        // Query to fetch user's email
        $sql_email = "SELECT Email FROM signup WHERE Username='$entered_username'";
        $result_email = $conn->query($sql_email);

        if ($result_email->num_rows > 0) {
            // Fetch the user's email
            $row_email = $result_email->fetch_assoc();
            $_SESSION['email'] = $row_email['Email'];
        } else {
            // Handle error
            $_SESSION['email'] = ''; // Set email to empty string
        }

        // Redirect to dashboard or home page
        header("Location: customerDashboard.html");
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
