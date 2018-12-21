<?php

function METHOD_PUT($scope, $user_id) {
    scope_allowed($scope, 'basic', true);

    $user_id = check_data($user_id, true, 'user_id', true);

    parse_str(file_get_contents("php://input"), $put_vars);

    $picture_url = check_data($put_vars['picture_url'], false, '', true);
    $username = check_data($put_vars['username'], false, '', true);
    $first_name = check_data($put_vars['first_name'], false, '', true);
    $last_name = check_data($put_vars['last_name'], false, '', true);
    $email = check_data($put_vars['email'], false, '', true);

    $user = sql_select('users', 'username,email', "id='{$user_id}'", true);

    if (!empty($picture_url)) {
        sql_update('users', [
            'picture_url' => $picture_url,
        ], "id='{$user_id}'");
    }

    if (!empty($username)) {
        if ($username != $user['username']) {
            $existing_username = sql_select('users', 'id', "username='{$username}'", false);
            if ($existing_username->num_rows > 0) {
                response(false, 'username_already_taken');
            }
        }

        sql_update('users', [
            'username' => $username,
        ], "id='{$user_id}'");
    }

    if (!empty($first_name)) {
        sql_update('users', [
            'first_name' => $first_name,
        ], "id='{$user_id}'");
    }

    if (!empty($last_name)) {
        sql_update('users', [
            'last_name' => $last_name,
        ], "id='{$user_id}'");
    }

    if (!empty($email)) {
        scope_allowed($scope, 'email', true);

        if ($email != $user['email']) {
            $existing_email = sql_select('users', 'id', "email='{$email}'", false);
            if ($existing_email->num_rows > 0) {
                response(false, 'email_already_taken');
            }
        }

        sql_update('users', [
            'email' => $email,
        ], "id='{$user_id}'");
    }

    return METHOD_GET($scope, $user_id);
}
