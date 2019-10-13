<?php
include_once "../Include/LogIn.inc.php";
include_once "../Model/Users.model.php";
include_once "../Model/FailedAttempts.model.php";
include_once "../Model/Cookies.mode.php";
include "../Include/connect_db.inc.php";
session_start();


## check and see if the COOKIE is truly set then set the SESSION ##
if(isset($_COOKIE["logIn"])){

    $user = checkCookie();
    if(!empty($user)){
        $_SESSION["user"] = $user["username"];
    }
}



$failed_attempts = countAllFailedAttempts($_SERVER["REMOTE_ADDR"]);


if(blockUser()){

    exit("Your access to this site is blocked");

}elseif (isset($_POST["LogIn"]) && !empty($_POST["password"]) && !empty($_POST["username"]) ){


    $password = $_POST["password"];
    $username = $_POST["username"];

    $user = getUser($username,$password);

    ## check if there is user or not ##
    if(empty($user)){
        newFailedAttempts();
        $failed_attempts++;
        exit("Your username or password is not correct!('$failed_attempts' out of 3 try)");
    }elseif (isset($_POST["remember"])){


        $value = setLogInCookie();
        newCookie($value,$username);
        header("location:LogIn.controller.php");
        exit();
    }else{

        $_SESSION["user"] = $user["username"];

    }
}
mysqli_close($connection);
## check if the SESSION is set then go to dashboard ##
if (isset($_SESSION["user"])){
    header("location:Log.controller.php");
    exit();

}

include "../View/LogIn.view.php";