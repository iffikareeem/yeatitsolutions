<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'Php_Mailer/Exception.php';
require 'Php_Mailer/PHPMailer.php';
require 'Php_Mailer/SMTP.php';

if (isset($_POST['submit'])) {
    // Sanitize user inputs
    $subject = htmlspecialchars($_POST['subject']);
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);
    $fromemail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email and required fields
    if (empty($name)|| !filter_var($fromemail, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='failed'>Please fill in all fields correctly.</div>";
        exit;
    }

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ra3124108@gmail.com'; // Replace with your email
        $mail->Password   = 'mezqgrjvdcwhkfsu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('ra3124108@gmail.com', 'Yeaitsolutions');
        $mail->addAddress('aleeraza09@gmail.com', 'Owner');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name<br>Email: $fromemail<br>Message: $message";

        $mail->send();
        echo '<div class="success">Message has been sent.</div>';
    } catch (Exception $e) {
        echo "<div class='failed'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }
}
?>
