<?php
// Set your recipient email address
$receiving_email_address = 'lewy.martin@outlook.com'; // **CHANGE THIS TO YOUR EMAIL ADDRESS**

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data (and sanitize it to prevent security vulnerabilities)
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = trim($_POST["message"]);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email format.";
        exit;
    }

    // Check if required fields are empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit;
    }

    // Construct the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set email headers
    $email_headers = "From: $name <$email>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    // The mail() function uses the local mail server configured on your host.
    // For more robust and reliable email sending, consider PHPMailer or a transactional email service.
    if (mail($receiving_email_address, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // Not a POST request, so redirect or show an error
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>