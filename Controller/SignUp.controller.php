<?php
include_once "../Include/Validation.inc.php";
include_once "../Model/Users.model.php";
include "../Include/connect_db.inc.php";


$errors = [];
$signup_flag = false;
if (isset($_POST["SignUp"]) && signUpFieldsAreFilled() && signUpValidateAll() && userExistBefore($_POST["username"])) {


    $name = $_POST["name"];
    $family = $_POST["family"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $city = $_POST["city"];


    newUser($username, $password, $city, $name, $family);
    $signup_flag = true;
}

mysqli_close($connection);

if ($signup_flag) {
    header("location:LogIn.controller.php");
    exit();

} else {
    include "../View/SignUp.view.php";
}