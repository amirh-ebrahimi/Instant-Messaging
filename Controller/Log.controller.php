<?php
include_once "../Include/LogIn.inc.php";

session_start();
## if user is not log in then go to logIn page ##
if (!isset($_SESSION["user"])){

    header("location:LogIn.controller.php");
    exit();
}elseif(isset($_COOKIE["logIn"])){ // if COOKIE is set then write a log file with cookie and go to dashboard.

    makeLogFileWithCookie($_SESSION["user"]);
    header("location:Dashboard.controller.php");
    exit();
}else{ //else write a log file without cookie and go to dashboard.

    makeLogFile($_SESSION["user"]);
    header("location:Dashboard.controller.php");
    exit();
}
