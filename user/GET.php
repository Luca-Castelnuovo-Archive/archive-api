<?php

function GET_user($scope, $user_id) {
    $user_id = check_data($user_id, true, 'user_id', true);

    $user = sql_select('users', 'id,username,email,first_name,last_name,picture_url,created,applications,developer,admin', "id='{$user_id}'", true);

    $output = [];
    $output['id'] = intval($user['id']);
    $output['picture_url'] = $user['picture_url'];
    $output['username'] = $user['username'];
    $output['first_name'] = $user['first_name'];
    $output['last_name'] = $user['last_name'];

    // Email
    if (scope_allowed($scope, 'email:read', false)) {
        $output['email'] = $user['email'];
    } else {
        $output['email'] = null;
    }

    // Applications
    if (scope_allowed($scope, 'applications:read', false)) {
        $output['applications'] =  json_decode($user['applications'], true);
    } else {
        $output['applications'] = null;
    }

    $output['developer'] = settype($user['developer'],'boolean');
    $output['admin'] = settype($user['admin'],'boolean');
    $output['created'] = $user['created'];

    return $output;
}
