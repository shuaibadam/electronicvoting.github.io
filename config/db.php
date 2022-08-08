<?php
$servername = "localhost";
$username = "root";
$password ="";
$db = "votingsystem";

$conn = mysqli_connect($servername, $username, $password, $db);
if(!$conn){
    die("unable to connect to the data base ".mysqli_connect_error());
}else{
    // echo "database connected successfully";
}
?>