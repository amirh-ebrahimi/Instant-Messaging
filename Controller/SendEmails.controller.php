<?php
include "../Include/connect_db.inc.php";
include_once "../Include/Validation.inc.php";
include_once "../Model/Email.model.php";
include_once "../Model/Files.model.php";

session_start();
loggedIn();

$username = $_SESSION["user"];
$email = $username."@maktab.ir";

$sent_mails = getSentEmails($email);



mysqli_close($connection);

include "../View/SendMails.view.php";