<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'basic:read');

require 'GET.php';
require 'PUT.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $output = METHOD_GET($access_token['scope'], $access_token['user_id']);
        break;

    case 'PUT':
        $output = METHOD_PUT($access_token['scope'], $access_token['user_id']);
        break;

    case 'DELETE':
        $output = METHOD_DELETE($access_token['scope'], $access_token['user_id']);
        break;

    default:
        response(false, 'incorrect_http_method');
        break;
}

response(true, '', $output);
