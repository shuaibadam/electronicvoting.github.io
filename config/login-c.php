<?php
 include('./db.php');
session_start();
 if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM info WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        header("Refresh:0; url=../login.php");
        echo "In valid email";
    }else{
        $sql = "SELECT * FROM info WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            header("Refresh:0; url=../login.php");
            echo "<script>alert('No user found')</script>";
        }else {
            // echo"one user found";
            while ($arr = mysqli_fetch_array($result)) {
                $fullname = $arr['fullname'];
                $email = $arr['email'];
                $uid = $arr['id'];


                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                // $_SESSION['id'] = $uid;
                

            }

            echo "<script>alert('Login is successfull')</script>";
            header("Refresh:0; ../voter.php");


        }

    }
 }