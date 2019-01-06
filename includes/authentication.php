<?php

function validate_access($required_scope = null)
{
    $access_request = $_REQUEST['access_token'];
    $access_headers = trim($_SERVER["Authorization"]);

    if (empty($access_headers)) {
        if (empty($access_request)) {
            response(false, 401, 'access_token_missing');
        } else {
            $token = $access_request;
        }
    } else {
        if (preg_match('/Bearer\s(\S+)/', $access_headers, $matches)) {
            $token = $matches[1];
        }
    }

    $access_token = check_data($token, false, '', true);

    $access_data = sql_select('access_tokens', 'client_id,user_id,expires,scope', "access_token='{$token}'", true);
    $scope = json_decode($access_data['scope']);

    if ($access_data['expires'] <= time()) {
        response(false, 401, 'bad_credentials');
    }

    if (isset($required_scope)) {
        scope_allowed($scope, $required_scope, true);
    }

    return ['client_id' => $access_data['client_id'], 'user_id' => $access_data['user_id'], 'expires' => $access_data['expires'], 'scope' => $scope];
}

function scope_allowed($scopes, $required_scope, $hard_fail = false) {
    if (strpos($required_scope, ':') !== false) {
        if (!in_array($required_scope, $scopes)) {
            $required_scope_without_read = substr($required_scope, 0, strpos($required_scope, ":"));
            if (!in_array($required_scope_without_read, $scopes)) {
                if ($hard_fail) {
                    response(false, 401, 'request_out_of_scope');
                } else {
                    return false;
                }
            }
        }
    } else {
        if (!in_array($required_scope, $scopes)) {
            if ($hard_fail) {
                response(false, 401, 'request_out_of_scope');
            } else {
                return false;
            }
        }
    }

    return true;
}
