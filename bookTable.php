<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="bookTable.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>

    <div id="bookingForm">
    
        <div class="left-column">
        <div style="display: flex;">
            <h1><a href="customerDashboard.html" style="text-decoration:none;">&lt;</a></h1>
            <h1 style="padding-left:40px;">Booking Form</h1>
        </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="date" name="date" required>
                <input type="time" name="time" required>
                <input type="number" name="num_guests" placeholder="Number of Guests" required min="1">
            </div>
            <div class="right-column payment-inputs">
                <!-- Payment fields -->
                <input type="text" name="cardholder_name" placeholder="Card holder Name" required>
                <input type="text" name="card_number" placeholder="Card Number (16-digits)" required>
                <input type="number" name="amount" placeholder="Amount (Rs)" required min="1">
                <input type="text" name="cvv" placeholder="pin (4-digits)" required>
                <input type="hidden" name="book_table" value="1">
                <button type="submit">Book A Table</button>
            </form>
        </div>
    </div>

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
        // Retrieve payment details from the form
        $cardholder_name = $_POST['cardholder_name'];
        $card_number = $_POST['card_number'];
        $amount = $_POST['amount'];
        $cvv = $_POST['cvv'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, date, time, num_guests, cardholder_name, card_number, amount, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssissss", $name, $email, $phone, $date, $time, $num_guests, $cardholder_name, $card_number, $amount, $cvv);

        // Execute the statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();
            // Payment successfully processed
            ?>
            <script>
                function redirectToCustomerDashboard() {
                    // Redirect to the customer dashboard
                    window.location.href = "customerDashboard.html";
                }

                function closePopup() {
                    // Close the pop-up window
                    window.close();
                }

                // Show pop-up after form submission
                window.onload = function() {
                    var confirmation = confirm("Your booking has been confirmed! Would you like to go to the Customer Dashboard?");
                    if (confirmation) {
                        redirectToCustomerDashboard();
                    } else {
                        closePopup();
                    }
                }
            </script>
            <?php
            exit(); // Stop execution after displaying confirmation
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
