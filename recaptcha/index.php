<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'api:mail');

//Required vars
is_empty($_POST['g-recaptcha-response'], 'Captcha Response');

//Make validation request
$url = "https://www.google.com/recaptcha/api/siteverify?secret={$GLOBALS['config']->services->recaptcha->secret_key}&response={$_POST['g-recaptcha-response']}";
$response = json_decode(file_get_contents($url));

// Output result
if ($response->success) {
    response(true, 'Captcha is valid.');
} else {
    response(false, 'Captcha is invalid.');
}
