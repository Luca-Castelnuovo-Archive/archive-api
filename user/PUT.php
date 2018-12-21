<?php

function PUT_user($scope, $user_id, $picture_url, $username, $first_name, $last_name, $email) {
    scope_allowed($scope, 'basic', true);

    $user_id = check_data($user_id, true, 'user_id', true);

    $picture_url = check_data($picture_url, false, '', true);
    $username = check_data($username, false, '', true);
    $first_name = check_data($first_name, false, '', true);
    $last_name = check_data($last_name, false, '', true);
    $email = check_data($email, false, '', true);

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

    return GET_user($user_id);
}
