<?php
function newCookie($value,$username){

    global $connection;
    $user_agent = $_SERVER["HTTP_USER_AGENT"];

    $query = "INSERT INTO cookies VALUES (null,(SELECT users.ID FROM users WHERE users.username = '$username'),'$user_agent','$value')";
    mysqli_query($connection,$query);
}

function getCookieValue($username){

    global $connection;

    $query = "SELECT users.cookie FROM users WHERE users.username = '$username'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);
    $row = reset($row);
    $value = $row[0];

    return $value;
}

function checkCookie(){

    global $connection;
    $value = $_COOKIE["logIn"];
    $user_agent = $_SERVER["HTTP_USER_AGENT"];

    $query = "SELECT users.username FROM users INNER JOIN cookies ON users.ID = cookies.user_id WHERE cookies.value = '$value' AND cookies.user_agent = '$user_agent'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    $user = reset($row); //The first element of array


    return $user;
}

function deleteDbCookie(){

    global $connection;
    $value = $_COOKIE["logIn"];
    $user_agent = $_SERVER["HTTP_USER_AGENT"];

    $query = "DELETE FROM cookies WHERE cookies.value = '$value' AND cookies.user_agent = '$user_agent'";
    mysqli_query($connection,$query);

}