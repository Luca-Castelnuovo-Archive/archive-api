<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
$access_token = validate_access('client_credentials');

//Required vars
is_empty($_POST['g-recaptcha-response'], 'Captcha Response');

//Make validation request
$url = "https://www.google.com/recaptcha/api/siteverify?secret={$GLOBALS['config']->services->recaptcha->secret_key}&response={$_POST['g-recaptcha-response']}";
$response = json_decode(file_get_contents($url));

// Output result
if ($response->success) {
    response(true, 200, 'captcha_valid');
} else {
    log_action('1', 'captcha.invalid', $_SERVER["REMOTE_ADDR"], '', $access_token['client_id']);
    response(false, 400, $response->error-codes);
}
