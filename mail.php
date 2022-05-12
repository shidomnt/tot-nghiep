<?php
session_start();
include './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (empty($_SESSION['user'])) {
  header("Location: signin.php");
  exit();
}

$mail = new PHPMailer(true);

$to = $_SESSION['user'];

try {
  $mail->IsSMTP();
  $mail->Mailer = "smtp";
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "developerworking7@gmail.com";
  $mail->Password   = "Developer123";
  $mail->IsHTML(true);
  $mail->AddAddress($to);
  $mail->SetFrom("developerworking7@gmail.com", "Shoe");
  $mail->Subject = "Xác nhận mua hàng";
  $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
  $mail->MsgHTML($content);
  
  $mail->send();
  header("Location: {$_SERVER['HTTP_REFERER']}", true, 303);
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
