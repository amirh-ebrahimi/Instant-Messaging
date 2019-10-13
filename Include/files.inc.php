<?php

function movingFile($file){

    $tmp_destination = $file["tmp_name"];
    $destination = "../files/Attachments/" . $file["name"];
    move_uploaded_file($tmp_destination, $destination);
}