<?php
session_start();
include './vendor/autoload.php';
include './src/connect.php';
include './src/control.php';
include './src/cart.php';
include './src/product.php';
$cart = new Cart();

use PHPMailer\PHPMailer\PHPMailer;

if (empty($_SESSION['user'])) {
  header("Location: signin.php");
  exit();
}

$mail = new PHPMailer(true);

$to = $_SESSION['user'];

try {
  $mail->IsSMTP();
  $mail->CharSet = 'UTF-8';
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
  $content = $cart->to_content_mail();
  $mail->MsgHTML($content);
  $mail->send();
  unset($_SESSION['cart']);
  $_SESSION['mail_success'] = 1;
  header("Location: success_order.php", true, 303);
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
