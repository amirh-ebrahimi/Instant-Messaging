<?php
function newFile($file,$checksum){

    global $connection;
    $addr = "../files/Attachments/".$file["name"];


    $query = "INSERT INTO files VALUES (null,'$addr','$checksum')";
    mysqli_query($connection,$query);

    return mysqli_insert_id($connection);
}

function getFileWithChecksum($checksum){

    global $connection;

    $query = "SELECT files.ID FROM files WHERE files.checksum = '$checksum'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_all($result);

    if(reset($row)){// if the row was not empty...

        $file_id = reset($row);//... then the element is file id.
    }else{//... Else the file id is NULL.

        $file_id = null;

    }
    mysqli_free_result($result);


    return $file_id[0];
}