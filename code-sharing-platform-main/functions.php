<?php

// Find an id for the 64base system of 6 characters

function getNewId()
{
    $charSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';

    $uid = '';
    while (strlen($uid) <= 10) {
        $uid .= $charSet[random_int(0, strlen($charSet) - 1)];
    }

    return $uid;
}

function uniqueId()
{
    include "../config.php";
    $uniqueId = '';
    do {
        $uniqueId = getNewId();

        $sql = "SELECT snippet_id FROM code_snippets WHERE snippet_id='${uniqueId}'";
        $result = mysqli_query($conn, $sql) or die("Query failed");
    } while (mysqli_num_rows($result) != 0);

    return $uniqueId;
}

?>