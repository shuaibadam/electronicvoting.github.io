<?php
require('.//db.php');
session_start();

if (isset($_POST['remove'])) {
    
    $uid = $_POST['uid'];
    $sql = "UPDATE info SET standard='voter' WHERE id='$uid'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ../participant.php");
    }else{
        // echo "<script>alert('technical error !!')</sript>";
    
    }
}