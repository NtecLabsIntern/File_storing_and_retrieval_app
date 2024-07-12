<?php
$conn = new mysqli('localhost', 'root', '', 'File_Storage_app');
//checking if connected:
    if(!$conn){
        die("Connection Failed: ".mysqli_error($conn));
    }
?>