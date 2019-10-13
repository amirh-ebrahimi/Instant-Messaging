<?php
include "../Include/connect_db.inc.php";
include_once "../Include/Validation.inc.php";
include_once "../Model/Email.model.php";
session_start();
loggedIn();

$id = $_GET["id"];
$user = $_SESSION["user"];
$email = getEmailByID($id);
emailIsSeen($id,$user);

mysqli_close($connection);

include "../View/EmailDetails.view.php";