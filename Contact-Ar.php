<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // إعدادات SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.privateemail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@luxewd.net';
    $mail->Password = 'Luxewddubai@123';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // استقبال بيانات النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = "Luxewd - " . $_POST['subject'];
    $message = $_POST['message'];

    // تهيئة البريد الإلكتروني
    $mail->setFrom('info@luxewd.net', 'جدولة Luxewd');
    $mail->addAddress('info@luxewd.net');

    // محتوى البريد الإلكتروني
    $mail->isHTML(true);
    $mail->Subject = $subject;

    // هيكلية البريد الإلكتروني
    $email_content = '
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <style>
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                text-align: right;
                direction: rtl;
            }
            .content {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                text-align: right;
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
            <h2>تفاصيل الاجتماع:</h2>
            <div class="content">
                <p><strong>اسم الشركة:</strong> ' . htmlspecialchars($name) . '</p>
                <p><strong>البريد الإلكتروني:</strong> ' . htmlspecialchars($email) . '</p>
                <p><strong>موضوع الاقتراح:</strong> ' . htmlspecialchars($subject) . '</p>
                <p><strong>رسالة الاقتراح:</strong></p>
                <div class="message">
                    <p>' . nl2br(htmlspecialchars($message)) . '</p>
                </div>
            </div>
        </div>
    </body>
    </html>';

    $mail->Body = $email_content;

    // إرسال البريد
    $mail->send();
    echo "<script>alert('شكرًا لك على اقتراحك! سنتواصل معك قريبًا.');</script>";
} catch (Exception $e) {
    echo "<script>alert('تعذر إرسال الرسالة. خطأ: {$mail->ErrorInfo}');</script>";
}
