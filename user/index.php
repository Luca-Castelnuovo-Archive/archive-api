<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization']);

$user = sql_select('users', 'id,username,email,first_name,last_name,picture_url,created,applications', "id='{$access_token['user_id']}'", true);

$user['applications'] = json_decode($user['applications'], true);

$output = [];
$output['id'] = $user['id'];
$output['picture_url'] = $user['picture_url'];
$output['username'] = $user['username'];
$output['first_name'] = $user['first_name'];
$output['last_name'] = $user['last_name'];

// Email
if (in_array('user:email', $access_token['scope'])) {
    $output['email'] = $user['email'];
} else {
    $output['email'] = null;
}

// Applications
if (in_array('user:applications', $access_token['scope'])) {
    $output['applications'] = $user['applications'];
} else {
    $output['applications'] = null;
}

$output['created'] = $user['created'];

response(true, '', $output);
