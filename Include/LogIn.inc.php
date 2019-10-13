<?php

# getting the IP and USERAGENT of user in a log file #
function makeLogFile($username){

    $time = time();
    $time_stamp = date("Y-m-d H:m:s",$time);
    $ip = $_SERVER["REMOTE_ADDR"];
    $useragent = $_SERVER["HTTP_USER_AGENT"];


    $file = fopen("../files/log.text","a+");
    $line = '| User '.$username.' Connect from '.$ip.' at '.$time_stamp.' with User Agent: '.$useragent."\r\n";
    fwrite($file,$line);
    fclose($file);
}

function makeLogFileWithCookie($username){

    $time = time();
    $time_stamp = date("Y-m-d H:m:s",$time);
    $ip = $_SERVER["REMOTE_ADDR"];
    $useragent = $_SERVER["HTTP_USER_AGENT"];


    $file = fopen("../files/log.text","a+");
    $line = '| User '.$username.' Connect from '.$ip.' at '.$time_stamp.' with User Agent: '.$useragent.
        ' and with COOKIE value: '.$_COOKIE["logIn"]."\r\n";

    fwrite($file,$line);
    fclose($file);
}

## check if a user is blocked or not ##
function blockUser($number_of_allowed_attempts = 3){

    global $failed_attempts;

    if ($failed_attempts >= $number_of_allowed_attempts){

        return true;
    }else{

        return false;
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function setLogInCookie(){

    $value = generateRandomString();
    $expire_time = time() + 60*60*24*30; // Keep user log in for a month

    setcookie("logIn",$value,$expire_time,"/");

    return $value;
}

function deleteCookie(){

    $time = time() - 100000;
    setcookie("logIn",null,$time,"/");
}