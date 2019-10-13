<?php
include_once "../Model/Cookies.mode.php";
include_once "../Include/LogIn.inc.php";
include "../Include/connect_db.inc.php";

if(isset($_COOKIE["logIn"])) {
    deleteDbCookie();
    deleteCookie();
}


session_start();
session_unset();
session_destroy();

mysqli_close($connection);
unset($_POST["remember"]);
header("location:LogIn.controller.php");
exit();