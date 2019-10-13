<?php

/*
 * if a name has more than one part (like Amir Reza)
 * this function will put each as an element of
 * an array.
 */
function splitName($name){

    $pos = strpos($name," ");
    if($pos === false){

        return $name;
    }else{

        $new_name = explode(" ",$name);
        return $new_name;
    }
}

## checking if all the fields are filled ##
function signUpFieldsAreFilled()
{
    global $errors;
    $fill = !empty($_POST["name"]) && !empty($_POST["family"]) && !empty($_POST["city"]) && !empty($_POST["username"]) && !empty($_POST["password"]);

    if($fill){

        return true;
    }else{
        $errors[] = "Please fill all the necessary fields";
        return false;
    }
}

function validateEmail($email){
    global $errors;
    $regex = "/^[A-Za-z0-9_.%+-]+@[A-Za-z0-9.]+\.[a-z]{2,}/";
    if (!preg_match($regex, $email)) {

        $errors[] = "Please Enter a Valid Email";
        return false;

    } else {

        return true;
    }
}

function validateUsername(){

    global $errors;
    /*
     *  Username only can have alphabets,numbers,"." and "_"
     * Username size is between 8 and 20
     * Username can't have "." and "_" at the beginning or end of it.
     * Username can't have "__" , "._" , "_." and ".."
     */
    $regex = "/^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
    if(!preg_match($regex,$_POST["username"])){

        $errors[] = "Your username is not valid";
        return false;
    }else{

        return true;
    }
}

function validateName($index){

    global $errors;
    $regex = "/^[A-Z][a-zA-Z][^#&<>\"~;$^%{}?()*0-9]{1,20}$/i";
    if (!preg_match($regex, trim($_POST[$index]))) {

        $errors[] = "Please Enter a Valid ".$index;
        return false;

    } else {

        return true;
    }
}

function passHasNotName(){

    global $errors;
    $name = $_POST["name"];
    $password = $_POST["password"];

    $name_tmp = splitName($name);

    if(is_array($name_tmp)){

        foreach ($name_tmp as $value){

            $validation = stripos($password,$value);
            if($validation !== false){

                $errors[] = "your Password can not have your name";
                return false;
            }
        }
        return true;
    }else{

        $validation = stripos($password,$name_tmp);
        if ($validation !== false){
            $errors[] = "your Password can not have your name";
            return false;
        }else{

            return true;
        }
    }
}

function passHasNotFamily(){

    global $errors;
    $family = $_POST["family"];
    $password = $_POST["password"];

    $family_tmp = splitName($family);

    if(is_array($family_tmp)){

        foreach ($family_tmp as $value){

            $validation = stripos($password,$value);
            if($validation !== false){
                $errors[] = "your Password can not have your family name";
                return false;
            }
        }
        return true;
    }else{

        $validation = stripos($password,$family_tmp);
        if ($validation !== false){

            $errors[] = "your Password can not have your family name";
            return false;
        }else{

            return true;
        }
    }

}

function passHasNotEmail(){

    global $errors;
    $email = $_POST["email"];
    $password = $_POST["password"];

    ## explode email username and server (emailusername@emailsrver) ##
    $email_array = explode("@",$email);
    $email_username = $email_array[0];
    $validation = stripos($password,$email_username);

    if($validation !== false){

        $errors[] = "your Password can not have your email username";
        return false;
    }else{

        return true;
    }
}

function passHasNotCity(){

    global $errors;
    $city = $_POST["city"];
    $password = $_POST["password"];

    $validation = stripos($password,$city);

    if($validation !== false){

        $errors[] = "your Password can not have your city";
        return false;
    }else{

        return true;
    }
}

## passwords does not use name,family,... ##
function passIsUnique(){

    return (passHasNotName() & passHasNotFamily()  & passHasNotCity());

}

## check if password is in black list or not ##
function passIsNotBlack(){

    global $errors;

    $blacklist = fopen("../files/blcklistPasswords.txt","r");
    while ($black_pass = fgets($blacklist)){


        if ($_POST["password"] === trim($black_pass)){

            $errors[] = "Your password is in blacklist.";
            fclose($blacklist);
            return false;
        }

    }
    fclose($blacklist);
    return true;

}

## check the strength of password ##
function passIsStrong(){

    global $errors;

    if (strlen($_POST["password"]) < 8) {
        $errors[] = "Password too short! (at least 8 characters)";
        return false;
    }

    if (!preg_match("#\d#", $_POST["password"])) {
        $errors[] = "Password must include at least one number!";
        return false;
    }

    if (!preg_match("#[a-zA-Z]#", $_POST["password"])) {
        $errors[] = "Password must include at least one letter!";
        return false;
    }

    if (!preg_match("#[^a-zA-Z\d]#", $_POST["password"])) {
        $errors[] = "Password must include at least one special characters!";
        return false;
    }

    return true;
}

function validatePassword(){

    return (passIsUnique() && passIsNotBlack() && passIsStrong());
}

## check all the fields ##
function signUpValidateAll(){

    return (validateName("name") & validateName("family") & validateName("city")  & validateUsername() & validatePassword());
}

function emailFieldsAreFilled(){

    global $errors;

    $fill = !empty($_POST["send_to"]) && !empty($_POST["subject"]);

    if($fill){

        return true;

    }else{
        $errors[] = "Pleas fill all the necessary fields";
        return false;
    }

}

## check if the user is logged in or not ##
function loggedIn(){

    if(!isset($_SESSION["user"])){

        header("location:LogIn.controller.php");
        exit();
    }
}