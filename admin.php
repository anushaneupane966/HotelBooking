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
      $sql = "SELECT * FROM admin WHERE Username='$entered_username' AND Password='$entered_password'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Username and password match
          // Start session and store user information if needed
          session_start();
          $_SESSION['username'] = $entered_username;
          // Redirect to dashboard or home page
          header("Location: adminDashboard.html");
          exit();
      } else {
          // Invalid username or password, display an error message
            echo "<script>alert('Invalid username or password');</script>";
            // Redirect the user back to index.html
            echo "<script>window.location.href = 'admin.html?error=Invalid%20username%20or%20password';</script>";
        }

      $conn->close();
  }
  ?>
