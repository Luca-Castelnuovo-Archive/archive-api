<?php

function authenticate_access($access_REQUEST, $access_HEADER, $required_scope = null)
{
    //set token from request or headder

    $access_token = check_data($_REQUEST['access_token'], true, 'access_token', true);

    // Query token
    $access = sql_select('access_tokens', 'client_id,user_id,expires,scope', "access_token='{$access_token}'", true);
    $scopes = json_decode($access_token['scope']);

    // Check if expires
    if ($access['expires'] <= time()) {
        response(false, 'bad_access_token');
    }

    // Validate token
    $token_valid = false;
    foreach ($scopes as $scope) {
        if ($scope == $required_scope) {
            $token_valid = true;
            break;
        }
    }

    if (!$token_valid) {
        response(false, 'bad_access_token');
    }

    return ['client_id' => $access_token['client_id'], 'user_id' => $access_token['user_id'], 'expires' => $access_token['expires'], 'scope' => $scope];
}
