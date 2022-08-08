<?php
require('./db.php');
session_start();

if (isset($_POST['start'])) {
    $access = $_POST['access'];
    // echo $access;
    if ($access == 'start') {
        $newaccess = 'stop';
    }elseif ($access == 'stop') {
        $newaccess ='start';
    }
    echo $newaccess;
    $sql = "UPDATE admin SET access='$newaccess' WHERE id=1";
    $result = mysqli_query($conn, $sql);

    $_SESSION['newaccess'] = $newaccess;
    if($result){
        header("Location: ../home.php");
    }else{
        // header("Location: ../home.php");

    }
}