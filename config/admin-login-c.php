<?php
 session_start();
 include('./db.php');
 if (isset($_POST['admin-login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        header("Refresh:0; url=../admin-login.php");
        echo "<script>alert('Not an admin!')</script>";

    }else{
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password' AND standard = 'administrator'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            header("Refresh:0; url=../admin-login.php");
            echo "<script>alert('Incorrect password')</script>";
        }else {
            while ($arr = mysqli_fetch_array($result)) {
                $fullname = $arr['fullname'];
                $email = $arr['email'];

                $_SESSION['fullname'] = $fullname;
                // $_SESSION['email'] = $email;
                echo "<script>alert('Login success')</script>";
                header("Refresh:0; ../home.php");

            }
        }

    }
 }




//  $sql = "SELECT * FROM info WHERE standard = 'voter'";
// $result = mysqli_query($conn, $sql);
// if(mysqli_num_rows($result) > 0){
//     $voters = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     $_SESSION['voters'] = $voters;
// }