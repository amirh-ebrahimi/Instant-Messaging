<?php
include_once "../Configure/dbConnection.conf.php";
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}