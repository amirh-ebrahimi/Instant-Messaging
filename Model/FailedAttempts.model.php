<?php

function newFailedAttempts(){

    global $connection;
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = time();

    $query = "INSERT INTO failed_attempts VALUES (null, '$ip', '$time')";

    mysqli_query($connection,$query);
}

## count failed attempts for an IP in a period of one hour ##
function countAllFailedAttempts($ip){

    global $connection;
    $current_ip = $_SERVER["REMOTE_ADDR"];
    $time_period = time() - 60*60;

    $query = "SELECT COUNT(failed_attempts.IP) FROM failed_attempts WHERE failed_attempts.IP = '$ip' AND failed_attempts.time > '$time_period'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);
    $row = reset($row);
    $failed_attempts = $row[0];

    return $failed_attempts;
}