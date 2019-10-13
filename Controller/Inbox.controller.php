<?php
include "../Include/connect_db.inc.php";
include_once "../Include/Validation.inc.php";
include_once "../Model/Email.model.php";

session_start();
loggedIn();

$username = $_SESSION["user"];
$email = $username."@maktab.ir";

$inbox_mails = getReceivedEmails($email);

include "../View/Inbox.view.php";