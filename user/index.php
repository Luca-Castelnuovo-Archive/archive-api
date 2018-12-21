<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'basic:read');

require 'GET.php';
require 'PUT.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $output = GET_user($access_token['scope'], $access_token['user_id']);
        break;

    case 'PUT':
        $output = PUT_user($access_token['scope'], $access_token['user_id'], $_REQUEST['picture_url'], $_REQUEST['username'], $_REQUEST['first_name'], $_REQUEST['last_name'], $_REQUEST['email']);
        break;

    case 'DELETE':
        $output = DELETE_user($access_token['scope'], $access_token['user_id']);
        break;

    default:
        response(false, 'incorrect_http_method');
        break;
}

response(true, '', $output);
