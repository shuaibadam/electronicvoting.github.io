<?php
require('./db.php');
session_start();

if (isset($_POST['update-title'])) {
    
    $title = $_POST['title'];

    echo $title;

    $sql = "UPDATE admin SET title='$title' WHERE id=1";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        header("Location: ../edit-participant.php");
    }else{
        echo "<script>alert('technical error !!')</sript>";
    
    }
}