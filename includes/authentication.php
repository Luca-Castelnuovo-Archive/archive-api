<?php

function authenticate_access($access_REQUEST, $access_HEADER, $required_scope = null)
{
    //set token from request or headder

    $access_token = check_data($_REQUEST['access_token'], true, 'access_token', true);

    // Query token
    $access_data = sql_select('access_tokens', 'client_id,user_id,expires,scope', "access_token='{$access_token}'", true);
    $scope = json_decode($access_data['scope']);

    // Check if expires
    if ($access_data['expires'] <= time()) {
        response(false, 'bad_access_token');
    }

    // Check token scope

    return ['client_id' => $access_data['client_id'], 'user_id' => $access_data['user_id'], 'expires' => $access_data['expires'], 'scope' => $scope];
}
