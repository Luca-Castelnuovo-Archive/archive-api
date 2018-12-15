<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

//Authenticate
auth($_POST['token']);

//Required vars
is_empty($_POST['g-recaptcha-response'], 'Captcha Response');

//Load mail config
$config = (object) array(
    "secret_key" => "6Lc-1X0UAAAAAMhjb8AgOjEIEtLHpAVOuk3lq7uJ",
);

//Make validation request
$url = "https://www.google.com/recaptcha/api/siteverify?secret={$config->secret_key}&response={$_POST['g-recaptcha-response']}";
$response = json_decode(file_get_contents($url));

if ($response->success) {
    response(true, ["success" => "Captcha is valid."]);
} else {
    response(false, ["error" => "Captcha is invalid."]);
}
