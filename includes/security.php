<?php

#################
# Validate data #
#################

// Validate data isn't empty
function is_empty($var, $type ='Unknown')
{
    if (empty($var)) {
        $type = strtolower(trim($type));
        response(false, "{$type}_empty");
    }
}


// Clean data
function clean_data($data)
{
    $conn = sql_connect();
    $data = $conn->escape_string($data);
    sql_disconnect($conn);

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
}


// Check data
function check_data($data, $isEmpty = true, $isEmptyType = 'Unknown', $clean = true)
{
    if ($isEmpty) {
        is_empty($data, $isEmptyType);
    }

    if ($clean) {
        return clean_data($data);
    } else {
        return $data;
    }
}
