<?php

function getSentEmails($email)
{

    global $connection;

    $query = "SELECT emails.ID, emails.subject, emails.email_from, emails.email_to, emails.details,emails.seen_status,files.addr 
              FROM emails LEFT JOIN files ON emails.file_id = files.ID WHERE emails.email_from = '$email'";
    $result = mysqli_query($connection, $query);
    $send_emails = mysqli_fetch_all($result, 1);
    mysqli_free_result($result);

    return $send_emails;
}

function getEmailByID($id)
{

    global $connection;

    $query = "SELECT emails.ID, emails.subject, emails.email_from, emails.email_to, emails.details,emails.seen_status,files.addr 
              FROM emails LEFT JOIN files ON emails.file_id = files.ID WHERE emails.ID = '$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_all($result, 1);
    $email = reset($row);
    mysqli_free_result($result);

    return $email;
}

function getReceivedEmails($email)
{

    global $connection;

    $query = "SELECT emails.ID, emails.subject, emails.email_from, emails.email_to, emails.details,emails.seen_status,files.addr 
              FROM emails LEFT JOIN files ON emails.file_id = files.ID WHERE emails.email_to = '$email'";
    $result = mysqli_query($connection, $query);
    $received_emails = mysqli_fetch_all($result, 1);
    mysqli_free_result($result);

    return $received_emails;

}

function sendingEmail($sender, $subject, $receivers, $details, $file_id = null)
{

    global $connection;
    $emails = [];

    $send_to = explode(",", $receivers); // separate different emails


    foreach ($send_to as $email) {
        $emails[] = trim($email);//this eliminates the spaces between different emails.
    }

    $emails = array_unique($emails); // if an email is written more than once it eliminates them.


    foreach ($emails as $email) {

        if (validateEmail($email)) {
            $query = "INSERT INTO emails VALUES (null,'$subject','$sender','$email','$details',0,";


            if (!empty($file_id)) { //if there is an id so put it in query

                $query .= "'$file_id')";
            } else { // else make file id null

                $query .= "null)";
            }

            mysqli_query($connection, $query);
        } else {
            break;
        }
    }

}

function searchInboxEmail($email, $q, $attachment = false)
{

    global $connection;

    if ($attachment) {

        $query = "SELECT emails.ID, emails.subject, emails.email_from, emails.email_to, emails.details,emails.seen_status,files.addr
                FROM emails INNER JOIN files ON emails.file_id = files.ID WHERE emails.details LIKE'%$q%'AND emails.email_to = '$email' ";
    } else {

        $query = "SELECT * FROM emails WHERE emails.details LIKE'%$q%'AND emails.email_to = '$email' ";
    }
    $result = mysqli_query($connection, $query);
    $emails = mysqli_fetch_all($result, 1);
    mysqli_free_result($result);

    return $emails;
}

function searchSentEmail($email, $q, $attachment = false)
{

    global $connection;


    if ($attachment) {

        $query = "SELECT * FROM emails INNER JOIN files ON emails.file_id = files.ID WHERE emails.details LIKE'%$q%'AND emails.email_from = '$email' ";
    } else {

        $query = "SELECT * FROM emails WHERE emails.details LIKE'%$q%'AND emails.email_from = '$email' ";
    }
    $result = mysqli_query($connection, $query);
    $emails = mysqli_fetch_all($result, 1);
    mysqli_free_result($result);

    return $emails;

}

function getEmailReceiver($id){

    global $connection;

    $query = "SELECT emails.to FROM emails WHERE emails.ID = '$id'";

    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);
    $receiver = reset($row);
    mysqli_free_result($result);

    return $receiver[0];
}

/*
 * This function will change the seen status of an email if the receiver see it.
 * @param string $id
 * Identifies which email is showing.
 * @param string @user
 * Identifies who is seeing the email. if the $user is the receiver then it sets seen value to 1.
 */
function emailIsSeen($id,$user){

    global $connection;
    $receiver = $user."@maktab.ir";

    $query = "UPDATE emails SET emails.seen_status = 1 WHERE emails.ID = '$id' AND email_to = '$receiver'";
    mysqli_query($connection,$query);
}