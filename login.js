// Function to display error message
function showError(message) {
    var errorMessage = document.getElementById('error-message');
    errorMessage.textContent = message;
    errorMessage.style.display = 'block';
  }
  
  // Submit event listener for the login form
  document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    // Get the username and password values
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    // Send the form data to the server using fetch API
    fetch('login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password)
    })
    .then(response => {
      if (response.ok) {
        // Redirect to dashboard if login is successful
        window.location.href = 'Customerdashboard.html';
      } else {
        // Display error message if login fails
        showError('Invalid username or password');
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
  