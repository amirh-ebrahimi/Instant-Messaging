<?php
include "../Include/connect_db.inc.php";
include_once "../Include/Validation.inc.php";
include_once "../Model/Email.model.php";

session_start();
loggedIn();

$username = $_SESSION["user"];
$email = $username."@maktab.ir";

switch ($_GET["search"]){

    case "inbox":
        if(isset($_GET["attachment"])) {
            $inbox_mails = searchInboxEmail($email,$_GET["q"],true);

            include "../View/Inbox.view.php";
            break;
        }else{

            $inbox_mails = searchInboxEmail($email,$_GET["q"]);
            include "../View/Inbox.view.php";
            break;
        }

    case "sent":

        if (isset($_GET["attachment"])){

            $sent_mails = searchSentEmail($email,$_GET["q"],true);
            include "../View/SendMails.view.php";
            break;
        }else{

            $sent_mails = searchSentEmail($email,$_GET["q"]);
            include "../View/SendMails.view.php";
            break;
        }

}