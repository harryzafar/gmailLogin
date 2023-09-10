<?php
$conn = new mysqli('localhost', 'root', '', 'api');
if($conn->connect_error){
    die("Connection Failed with Database".$conn->connect_error);
}



?>