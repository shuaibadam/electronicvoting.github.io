<?php
include('./db.php');
session_start();

if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $nin = $_POST['nin'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $passwordLenght = strlen($password);
    $ninLenght = strlen($nin);



    $image = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $path = '../images/'.$image;

    if ($ninLenght < 11 || $ninLenght > 11 ) {
        echo "<script>alert('Invalid NIN')</script>";
        header('Refresh:0; url=../index.php');

    } elseif($passwordLenght < 6 || $passwordLenght > 12) {
        echo "<script>alert('password too short or too long')</script>";
        header('Refresh:0; url=../index.php');

    } elseif($password !== $cpassword) {
        echo "<script>alert('password does not match')</script>";
        header('Refresh:0; url=../index.php');

    } else{
        $sql = "SELECT * FROM info WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            echo "<script>alert('Email already exist')</script>";
            header('Refresh:0; url=../index.php');
            
        } else{
            $sql = "SELECT * FROM info WHERE nin = '$nin'";
            $result = mysqli_query($conn, $sql); 
            if (mysqli_num_rows($result) == 1) {
                echo "<script>alert('User already exist')</script>";
                header('Refresh:0; url=../index.php');

            } else{
                move_uploaded_file($tmp_name, $path);
                $sql = "INSERT INTO info (fullname, email, nin, password, image, standard, status, votes) VALUES ('$fullname', '$email', '$nin', '$password', '$image', 'voter', 0, 0)";
                $result = mysqli_query($conn, $sql);

                if ($result){
                    $sql = "SELECT * FROM info WHERE email = '$email' AND password = '$password'";
                    $query = mysqli_query($conn, $sql);

                    if ($query){

                        while ($arr = mysqli_fetch_array($query)) {
                            $fullname = $arr['fullname'];
                            $email = $arr['email'];

                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Registration is successfull')</script>";
                            header("Refresh:0; ../voter.php");
                        }
                    }
                }

            }
        }
    }

}/**/ 

?>