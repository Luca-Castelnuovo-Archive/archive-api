<?php

function authenticate_access($access_REQUEST, $access_HEADER, $required_scope = null)
{
    if (empty($access_REQUEST) && empty($access_HEADER)) {
        response(false, 'missing_access_token');
    } elseif (!empty($access_REQUEST)) {
        $token = $access_REQUEST;
    } elseif (!empty($access_HEADER)) {
        $token = $access_HEADER;
    }

    $access_token = check_data($token, true, 'access_token', true);

    $access_data = sql_select('access_tokens', 'client_id,user_id,expires,scope', "access_token='{$token}'", true);
    $scope = json_decode($access_data['scope']);

    if ($access_data['expires'] <= time()) {
        response(false, 'bad_access_token_0');
    }

    if (isset($required_scope)) {
        if (in_array($required_scope, $scope)) {
            response(false, 'bad_access_token_1');
        }
    }

    return ['client_id' => $access_data['client_id'], 'user_id' => $access_data['user_id'], 'expires' => $access_data['expires'], 'scope' => $scope];
}
