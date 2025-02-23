<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer
// require 'path/to/PHPMailer/src/PHPMailer.php'; // If manually installed
// require 'path/to/PHPMailer/src/SMTP.php';
// require 'path/to/PHPMailer/src/Exception.php';

if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || empty($_POST['mobile']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$mobile = htmlspecialchars($_POST['mobile']);
$m_subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

$admin_email = "bs863313@gmail.com"; // Change this to Admin Email

$mail = new PHPMailer(true);

try {
  // SMTP Configuration
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com'; // Gmail SMTP Server
  $mail->SMTPAuth = true;
  $mail->Username = 'bs863313@gmail.com'; // Your Gmail Email
  $mail->Password = 'umjv xfhj teuk nnkf'; // Your Gmail App Password (See below)
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  // Email Content
  $mail->setFrom($email, $name);
  $mail->addAddress($admin_email);
  $mail->Subject = "New Contact Form Submission: $m_subject";
  $mail->Body = "You have received a new message from your Customer.\n\n" .
    "Name: $name\n" .
    "Email: $email\n" .
    "Mobile: $mobile\n" .
    "Subject: $m_subject\n" .
    "Message:\n$message";

  $mail->send();
  echo "Message sent successfully!";
} catch (Exception $e) {
  echo "Mailer Error: " . $mail->ErrorInfo;
}
