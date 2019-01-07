<?php

function METHOD_POST($user_id, $message) {
    $user_id = check_data($user_id, true, 'user_id', true);
    $message = check_data($message, true, 'message', true);

    $output['message'] = 'Notification API not finished';

    return $output;
}
