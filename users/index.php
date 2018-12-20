<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization']);

$user = sql_select('users', 'id,username,email,first_name,last_name,picture_url,created,applications', "id='{$access_token['user_id']}'", true);

$user['applications'] = json_decode($user['applications'], true);

$user['scope'] = $user['applications'][$access_token['client_id']];

response(true, '', $user);
