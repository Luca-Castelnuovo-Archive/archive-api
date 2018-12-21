<?php

//Load api functions
require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
// validate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'api:mail');

//Required vars
is_empty($_POST['from_name'], 'From name');
is_empty($_POST['to'], 'To');
is_empty($_POST['subject'], 'Subject');
is_empty($_POST['body'], 'Body');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Server configuration
$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = $GLOBALS['config']->services->mail->Host;
$mail->SMTPAuth = $GLOBALS['config']->services->mail->SMTPAuth;
$mail->Username = $GLOBALS['config']->services->mail->Username;
$mail->Password = $GLOBALS['config']->services->mail->Password;
$mail->SMTPSecure = $GLOBALS['config']->services->mail->SMTPSecure;
$mail->Port = $GLOBALS['config']->services->mail->Port;
$mail->msgHTML(true);

//From
$mail->setFrom($GLOBALS['config']->services->mail->From, $_POST['from_name']);
$mail->addReplyTo($GLOBALS['config']->services->mail->From, $_POST['from_name']);

//To
$mail->addAddress($_POST['to']);

//Subject and Body
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['body'];

//Execute mail send
if ($mail->send()) {
    response(true, '');
} else {
    response(false, 'Show mail error.');
}
