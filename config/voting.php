<?php
session_start();
require('./db.php');
if (isset($_POST['vote'])) {
    # code...
$votes = $_POST['candidatevotes'];
// echo "<script>alert($votes)</script>";

$totalvotes =$votes+1; 
// echo "<script>alert($totalvotes)</script>";


$candidid = $_POST['candidateid'];
// echo "<script>alert($candidid)</script>";

$uid = $_POST['uid'];
// echo "<script>alert($uid)</script>";


$sql = "UPDATE info SET votes='$totalvotes' WHERE id='$candidid'";
$result1 = mysqli_query($conn, $sql);
$query = "UPDATE info SET status=1 WHERE id='$uid'";
$result2 = mysqli_query($conn, $query);

if($result1 && $result2){
    header("Location: ../voter.php");
    echo "<script>alert('hey')</sript>";
}else{
    echo "<script>alert('technical error !!')</sript>";

}
}


