<?php

//Load api functions
require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
$access_token = validate_access('client_credentials');

//Required vars
is_empty($_POST['from_name'], 'from_name');
is_empty($_POST['to'], 'to');
is_empty($_POST['subject'], 'subject');
is_empty($_POST['body'], 'body');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Server configuration
$mail = new PHPMailer(true);
// $mail->SMTPDebug = 2;
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
    log_action('1', 'mail.success', $_SERVER["REMOTE_ADDR"], $_POST['to'], $access_token['client_id']);
    response(true, 200, 'mail_sent');
} else {
    log_action('1', 'mail.error', $_SERVER["REMOTE_ADDR"], $_POST['to'], $access_token['client_id']);
    response(false, 400, 'unknown_error');
}
