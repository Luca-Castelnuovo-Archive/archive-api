<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
validate_access('client_credentials');

//Required vars
is_empty($_POST['g-recaptcha-response'], 'Captcha Response');

//Make validation request
$url = "https://www.google.com/recaptcha/api/siteverify?secret={$GLOBALS['config']->services->recaptcha->secret_key}&response={$_POST['g-recaptcha-response']}";
$response = json_decode(file_get_contents($url));

// Output result
if ($response->success) {
    response(true, 200, 'captcha_valid');
} else {
    response(false, 400, $response->error-codes);
}
