<?php
include_once "../Include/Validation.inc.php";
include_once "../Include/files.inc.php";
include "../Include/connect_db.inc.php";
include_once "../Include/LogIn.inc.php";
include_once "../Model/Email.model.php";
include_once "../Model/Files.model.php";
session_start();
loggedIn();

$errors = [];

$username = $_SESSION["user"];

## sending email ##
if (isset($_POST["send"]) && emailFieldsAreFilled()) {

    $sender = $username . "@maktab.ir";
    $subject = $_POST["subject"];
    $receivers = $_POST["send_to"];
    $details = $_POST["details"];
    $file = $_FILES["attachment"];

    if (!empty($file["name"])) {

        $checksum = md5_file($file["tmp_name"]);
        ## check if file exists in database or not ##
        $file_id = getFileWithChecksum($checksum);
        ## move file to server if it does not exist before ##
        if(empty($file_id)) {
            movingFile($file);
            $file_id = newFile($file,$checksum);// get the id of new file in data base

        }

    } else {

        $file_id = null;
    }

    sendingEmail($sender, $subject, $receivers, $details, $file_id);

}
mysqli_close($connection);
include "../View/Dashboard.view.php";