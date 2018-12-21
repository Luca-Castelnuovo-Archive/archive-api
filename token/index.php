<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access($_REQUEST['access_token'], $_SERVER['Authorization']);

require 'GET.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $output = METHOD_GET($access_token);
        break;

    default:
        response(false, 'incorrect_http_method');
        break;
}

response(true, '', $output);
