<?php

function METHOD_DELETE($scope, $user_id, $picture_url, $username, $first_name, $last_name, $email) {
    scope_allowed($scope, 'delete', true);

    $user_id = check_data($user_id, true, 'user_id', true);

    sql_delete('users', "id='{$user_id}'");

    return 'account_deleted';
}
