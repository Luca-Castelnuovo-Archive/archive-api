<?php

function validate_access($access_REQUEST, $access_HEADER, $required_scope = null)
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
        response(false, 'bad_access_token');
    }

    if (isset($required_scope)) {
        scope_allowed($scope, $required_scope, true);
    }

    return ['client_id' => $access_data['client_id'], 'user_id' => $access_data['user_id'], 'expires' => $access_data['expires'], 'scope' => $scope];
}

function scope_allowed($scopes, $required_scope, $hard_fail = false) {
    if (strpos($required_scope, ':') !== false) {
        if (!in_array($required_scope, $scopes)) {
            if ($hard_fail) {
                response(false, 'request_out_of_scope');
            } else {
                return false;
            }
        }
    } else {
        if (!in_array($required_scope, $scopes)) {
            $required_scope_read = $required_scope . ':read';
            if (!in_array($required_scope_read, $scopes)) {
                if ($hard_fail) {
                    response(false, 'request_out_of_scope');
                } else {
                    return false;
                }
            }
        }
    }

    return true;
}
