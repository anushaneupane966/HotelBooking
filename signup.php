<?php
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

      // Get form data
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Sanitize data
      $username = mysqli_real_escape_string($conn, $username);
      $email = mysqli_real_escape_string($conn, $email);
      $password = mysqli_real_escape_string($conn, $password);

      // Insert data into signup table
      $sql = "INSERT INTO signup (Username, Email, Password) VALUES ('$username', '$email', '$password')";

      if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: index.html");
        exit();
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

      $conn->close();
  }
  ?>
