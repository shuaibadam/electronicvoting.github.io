<?php
require('./db.php');
session_start();

if (isset($_POST['update'])) {
    
    $uid = $_POST['uid'];
    $post = $_POST['post'];
    $party = $_POST['party'];

    echo $uid."<br>";
    echo $post."<br>";
    echo $party."<br>";

    $sql = "UPDATE info SET party='$party' WHERE id='$uid'";
    $result = mysqli_query($conn, $sql);
    

    $query = "UPDATE info SET post='$post' WHERE id='$uid'";
    $result2 = mysqli_query($conn, $query);



    if($result && $result2){
        header("Location: ../edit-participant.php");
    }else{
        echo "<script>alert('technical error !!')</sript>";
    
    }
}