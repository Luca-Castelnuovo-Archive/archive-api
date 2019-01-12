<?php

function METHOD_DELETE($scope, $user_id, $picture_url, $username, $first_name, $last_name, $email, $client_id)
{
    scope_allowed($scope, 'delete', true, $client_id, $user_id);

    $user_id = check_data($user_id, true, 'user_id', true);

    sql_delete('users', "id='{$user_id}'");

    log_action('1', 'user.deleted', $_SERVER["REMOTE_ADDR"], $user_id, $client_id);
    return 'account_deleted';
}
