<?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Establish database connection
      $servername = "localhost";
      $username = "TableBooking"; 
      $password = "TableBooking"; 
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
      $sql = "SELECT * FROM admin WHERE Username='$entered_username' AND Password='$entered_password'";
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
          // Username and password do not match
          echo "<p class='error'>Invalid username or password</p>";
      }

      $conn->close();
  }
  ?>