<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $firstName = htmlspecialchars(trim($_POST['fname']));
    $lastName  = htmlspecialchars(trim($_POST['lname']));
    $email     = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $subject   = htmlspecialchars(trim($_POST['subject']));
    $message   = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!$email) {
        echo "<script>alert('Invalid email address.'); window.location.href='contact.html';</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'trabbani79@gmail.com';            // ✅ Your Gmail address
        $mail->Password   = 'gssmqatovlcrzeti';                // ✅ Your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email content
        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress('trabbani79@gmail.com');            // ✅ Your Gmail to receive the message
        $mail->addReplyTo($email);

        $mail->Subject = $subject ?: 'New Contact Form Message';
        $mail->Body    = "You received a new message from your website contact form:\n\n"
                       . "Name: $firstName $lastName\n"
                       . "Email: $email\n"
                       . "Subject: $subject\n\n"
                       . "Message:\n$message\n";

        $mail->send();
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href='contact.html';</script>";
    }
}
?>
