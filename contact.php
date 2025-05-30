<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'luxewd.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@luxewd.net';
    $mail->Password = 'Luxewd@12345';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Get Form Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = "Luxewd - " . $_POST['subject'];
    $message = $_POST['message'];

    // Email Headers
    $mail->setFrom('info@luxewd.net', 'Luxewd Scheduler');
    $mail->addAddress('info@luxewd.net');

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = $subject;

    // Email Body (Styled)
    $email_content = '
    <html>
    <head>
        <style>
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                text-align: left;
            }
            .content {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                text-align: left;
            }
            .message {
                padding: 10px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Meeting Details:</h2>
            <div class="content">
                <p><strong>Company Name:</strong> ' . htmlspecialchars($name) . '</p>
                <p><strong>Company Email:</strong> ' . htmlspecialchars($email) . '</p>
                <p><strong>Proposal Subject:</strong> ' . htmlspecialchars($subject) . '</p>
                <p><strong>Proposal Message:</strong> ' . htmlspecialchars($message) . '</p>
            </div>
        </div>
    </body>
    </html>';

    $mail->Body = $email_content;

    // Send Email
    $mail->send();
    echo "<script>
    alert('Thanks for your Proposal! We will contact you soon.');
    window.location.href = 'index.html'; 
    </script>";
} catch (Exception $e) {
    echo "<script>
    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
    window.location.href = 'index.html'; 
    </script>";
}
