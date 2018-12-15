<?php

//Load api functions
require $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

//Authenticate
auth($_POST['token']);

//Required vars
is_empty($_POST['from_name'], 'From name');
is_empty($_POST['to'], 'To');
is_empty($_POST['subject'], 'Subject');
is_empty($_POST['body'], 'Body');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Load mail config
$config = (object) array(
    "Host" => "smtp.strato.com",
    "SMTPAuth" => true,
    "Username" => "no-reply@lucacastelnuovo.nl",
    "Password" => "1BWWeAGWaYTjAECKqHlXulzRf1euc3mHzti155KSYH0x28uiZMq3blT13zOo9MpJDedYezF0YGx1sPsTJCU3heskArhJqo7nxMkfUtofxKRhNg0dvFcYIq0ht1s5a3sH",
    "SMTPSecure" => "ssl",
    "Port" => 465,
    "From" => "no-reply@lucacastelnuovo.nl",
);

//Server configuration
$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = $config->Host;
$mail->SMTPAuth = $config->SMTPAuth;
$mail->Username = $config->Username;
$mail->Password = $config->Password;
$mail->SMTPSecure = $config->SMTPSecure;
$mail->Port = $config->Port;
$mail->msgHTML(true);

//From
$mail->setFrom($config->From, $_POST['from_name']);
$mail->addReplyTo($config->From, $_POST['from_name']);

//To
$mail->addAddress($_POST['to']);

//Subject and Body
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['body'];

//Execute mail send
if ($mail->send()) {
    response(true, ["success" => "Mail is sent."]);
} else {
    response(false, ["error" => "Mail isn't sent."]);
}
