<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $full_name = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mobile_number = filter_var($_POST['mobile_number'], FILTER_SANITIZE_STRING);
    $email_subject = filter_var($_POST['email_subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Recipient email address
    $to = "narayan2k01@gmail.com";

    // Email subject and body
    $subject = "New Contact Form Submission: " . $email_subject;
    $body = "
    Full Name: {$full_name}
    Email: {$email}
    Mobile Number: {$mobile_number}
    Subject: {$email_subject}
    Message: {$message}
    ";

    // Headers
    $headers = "From: {$full_name} <{$email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to a thank you page or back to the portfolio
        header("Location: index.html#contact?status=success");
        exit();
    } else {
        // Handle failure
        header("Location: index.html#contact?status=error");
        exit();
    }
} else {
    // Not a POST request
    header("Location: index.html");
    exit();
}
?>