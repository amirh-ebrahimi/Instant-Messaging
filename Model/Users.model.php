<?php

function newUser($username,$password,$city,$name,$family){

    global $connection;
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $email = $username."@maktab.ir";


    $query = "INSERT INTO users VALUES (null,'$username','$hash_password','$city','$email','$name','$family')";

    mysqli_query($connection,$query);
}

function getUser($username,$password){

    global $connection;

    $query = "SELECT users.username, users.password FROM users WHERE users.username = '$username'";


    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result,1);
    mysqli_free_result($result);
    $user = reset($row);
    if(password_verify($password,$user["password"])) { // if password is correct...
        return $user; //... then return user...
    }else{

        return null; // ... else return NULL.
    }
}

function userExistBefore($username){

    global $connection;
    global $errors;

    $query = "SELECT * FROM users WHERE users.username = '$username'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0){

        $errors[] = "This username is used before.";
        return false;
    }

    return true;
}

function emailExistBefore($email){

    global $connection;
    global $errors;

    $query = "SELECT * FROM users WHERE users.email = '$email'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0){

        $errors[] = "This email is used before.";
        return false;
    }

    return true;

}

function emailAndUserAreUnique($username,$email){

    return (userExistBefore($username) & emailExistBefore($email));
}

