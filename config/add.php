<?php
require('.//db.php');
session_start();

if (isset($_POST['add'])) {
    
    $uid = $_POST['uid'];
    $sql = "UPDATE info SET standard='candidate' WHERE id='$uid'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ../user.php");
    }else{
        // echo "<script>alert('technical error !!')</sript>";
    
    }
}




