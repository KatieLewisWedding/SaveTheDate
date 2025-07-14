document.getElementById('contactForm').addEventListener('submit', function(event) {
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const subject = document.getElementById('subject').value;
  const message = document.getElementById('message').value;
  const messagesDiv = document.getElementById('form-messages');
  messagesDiv.innerHTML = ''; // Clear previous messages

  if (!name || !email || !subject || !message) {
      messagesDiv.innerHTML = '<p class="error-message">All fields are required!</p>';
      event.preventDefault(); // Stop form submission
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      messagesDiv.innerHTML = '<p class="error-message">Please enter a valid email address!</p>';
      event.preventDefault(); // Stop form submission
  }
});

