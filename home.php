<?php
require('./config/db.php');
session_start();

$fullname = $_SESSION['fullname'];

if (!isset($fullname)){
    header('Refresh:0; url=login.php');
    echo "<script>alert('No user found')</script>";
    exit();
}else{
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">    
    <link rel="stylesheet" href="files/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="files/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Downloads/fontawesome-free-6.1.1-web%20(1)/fontawesome-free-6.1.1-web/css/all.css">
</head>
<body>
<?php

$sql = "SELECT * FROM admin WHERE id = 1";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($arr = mysqli_fetch_array($result)) {
        $fullname = $arr['fullname']; 
        $nin = $arr['nin']; 
        $image = $arr['image'];
        $standard = $arr['standard'];
        $access = $arr['access'];
        $email = $arr['email'];

        echo "
        <nav class='navbar navbar-expand-md bg-dark navbar-light pb-0 pt-3'>
        <div class='container-fluid;'>
            <div class='cube mx-5-md' style='max-width: 310px;'>
            
        </div>
            <button class='navbar-toggler bg-light'
            type='button' 
            data-bs-toggle='collapse'
            data-bs-target='#navmenu'>
            <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navmenu'>
                <ul class='navbar-nav ms-auto w-50'>
                    <li class='navbar-item my-3' >
                        <a href='home.php' class='navbar-link text-light mx-5'>Home </a>
                    </li>
                    <li class='navbar-item my-3'>
                        <a href='participant.php' class='navbar-link text-light mx-5'>Candidates </a>
                    </li>
                    <li class='navbar-item my-3'>
                        <a href='user.php' class='navbar-link text-light mx-5'>Voters </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    ";
    }
}
?>
    <div class="container  my-4 bg-secondary-md">
        <div class="row m-auto bg-dark">

            <div class='col-4-md card bg-secondary my-5 m-auto' style='width: 18rem; height: 28rem'>
            <img src='images/<?php echo $image;?>' class='m-auto my-3' alt='...'>
                <div class='card-body text-center text-dark';>
                  <p class='card-text text-center' style="font-weight: bold; font-size: 180%;"><?php echo $standard;?></p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;"><?php echo $fullname;?></p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;"><?php echo $email;?></p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;">NIN : <?php echo $nin;?></p>
                  <div class='logout-divmy-3' >
                        <form action='./config/start.php' class="mx-1" style="display: inline-block;" method="post">
                            <input type="hidden" name="access" value="<?php 
                            echo $access;
                            ?>">
                            <?php
                            if($access == 'start'){
                                echo "<button class='btn btn-light my-auto my-1 bg-danger text-light' type='submit'  name='start' class='btn1'>Stop voting</button><br>";
                            }else {
                                echo "<button class='btn btn-light my-auto my-1 bg-dark text-light' type='submit'  name='start' class='btn1'>Give access</button><br>";
                            }
                            ?>
                            
                        </form>
                            <a href="admin-logout.php"class='btn btn-light my-auto my-1'class='btn1'>Logout</a><br>
                    </div>
                </div>
            </div>
            <div class='col-4-md card bg-secondary  m-auto' style='width: 42rem; height: 22rem'>
                <div class='card-body text-dark';>
                  <p class='card-text text-center' style="font-weight: bold; font-size: 180%;">Infos</p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;">Number of Candidates: 
                  <?php
                  $sql ="SELECT * FROM info WHERE standard = 'candidate'";
                  $result =  mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result) > 0){
                    $candid = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $candid = count($candid);
                    echo $candid;
                  }else{
                    echo 0;
                  }
                  ?></p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;">Number of voters:
                 <?php
                  $query ="SELECT * FROM info WHERE standard = 'voter'";
                  $outcome =  mysqli_query($conn, $query);
                  if(mysqli_num_rows($outcome) >= 1){
                  $voter1 = mysqli_fetch_all($outcome, MYSQLI_ASSOC);
                  $voter1 = count($voter1);
                  echo $voter1;
                  }else{
                    echo "0";
                  }
                  ?>
                  </p>
                  <p class='card-text' style="font-weight: bold; font-size: 110%;">Number of casted votes:
                  <?php
                  $query2 ="SELECT * FROM info WHERE status = 1";
                  $outcome2 =  mysqli_query($conn, $query2);
                  if(mysqli_num_rows($outcome2) > 0){
                    $voted = mysqli_fetch_all($outcome2, MYSQLI_ASSOC);
                    $voted = count($voted);
                    echo $voted;
                  }else{
                    echo "0";
                  }
                  ?>
                  </p>
                  <p class='card-text text-center' style="font-weight: bold; font-size: 180%;">Top Candidate</p>

                  <p class='card-text' style="font-weight: bold; font-size: 110%;">
                  <?php
                  $query2 ="SELECT * FROM info WHERE votes = (SELECT  MAX(votes) as max_items FROM info)";
                  $outcome2 =  mysqli_query($conn, $query2);
                  if($outcome2){
                    while ($arr = mysqli_fetch_array($outcome2)) {
                        $fullname = $arr['fullname'];
                        $party = $arr['party'];
                        $nin = $arr['nin'];
                        $votes = $arr['votes'];
                        echo "Name : ".$fullname.'<br>';
                        echo "Party : ".$party.'<br>';
                        echo "Votes : ".$votes.'<br>';

                    }
                  }else{
                    echo 0;
                  }
                  ?>
                  </p>
                </div>
            </div>

            </div>
        </div>
<?php }?>
</body>
</html>
