<?php

function authenticate_access($access_REQUEST, $access_HEADER, $required_scope = null)
{
    if (!isset($access_REQUEST) && empty($access_REQUEST) && !isset($access_HEADER) && empty($access_HEADER)) {
        response(false, 'bad_access_token');
    } elseif (!isset($access_REQUEST) && empty($access_REQUEST)) {
        $token = $access_HEADER;
    } elseif (!isset($access_HEADER) && empty($access_HEADER)) {
        $token = $access_HEADER;
    }

    $access_token = check_data($token, true, 'access_token', true);

    $access_data = sql_select('access_tokens', 'client_id,user_id,expires,scope', "access_token='{$token}'", true);
    $scope = json_decode($access_data['scope']);

    // Check if expires
    if ($access_data['expires'] <= time()) {
        response(false, 'bad_access_token');
    }

    // Check token scope

    return ['client_id' => $access_data['client_id'], 'user_id' => $access_data['user_id'], 'expires' => $access_data['expires'], 'scope' => $scope];
}
