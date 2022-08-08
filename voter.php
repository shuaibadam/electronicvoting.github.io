<?php
require('./config/db.php');
session_start();

$email = $_SESSION['email'];
if (!isset($email)){
    header('Refresh:0; url=login.php');
}else{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/voter.css">    
    <link rel="stylesheet" href="files/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="files/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Downloads/fontawesome-free-6.1.1-web%20(1)/fontawesome-free-6.1.1-web/css/all.css">
</head>
<body>
    <?php
    $sql = "SELECT * FROM info WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($arr = mysqli_fetch_array($result)) {
            $fullname = $arr['fullname']; 
            $nin = $arr['nin']; 
            $image = $arr['image'];
            $status = $arr['status'];
            $_SESSION['status'] = $status;
            $uid = $arr['id'];
            $_SESSION['id'] = $uid;
            echo " 
    <nav class='nav bg-dark'>
        <!-- <div class='container'> -->
        <div class='card m-1';>
                <img src='images/$image'  class='card-img-top' alt='image'>
            </div>
            <div class='cube bg-dark text-center m-auto py-2 mx-2 mb-4'>
                <h1 class='card-text text-light'>Welcome  $fullname</h1>
                <p class='card-text text-light'>NIN: $nin</p>
            <!-- </div> -->
            </div>
            <div class='logout-div mx-5 px-5 my-3' >
                    <a href='logout.php' class='btn btn-secondary my-3' class='btn1'>Logout</a><br>
            </div>
    </nav>
            ";
        }
    }
    ?>
    <div class="container my-5">
    <?php
    $sql = "SELECT access FROM admin WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    if($result){
        while ($arr = mysqli_fetch_array($result)) {
            $access = $arr['access'];
          }
          if($access == 'start'){
            ?>
          <?php
                  $_SESSION['status'] = $status;
                  if($status == 0){
                    $newstatus = "STATUS: <b class='text-danger'>Not voted</b>";
                  }else{
                    $newstatus = "STATUS: <b class='success'> voted</b>";
                  }
                  ?>
                  <?php echo $newstatus;?>
            <div class="main">
            <?php
            $sql = "SELECT * FROM info WHERE standard = 'candidate'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
            $candid1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $_SESSION['candid1'] = $candid1;
                }
            if(isset($_SESSION['candid1'])) {
                $candid1 = $_SESSION['candid1'];
                for($i=0; $i<count($candid1); $i++){
            
            ?>
            <div class='card bg-light my-4' style='width: 18rem;'>
                <img src='images/<?php echo $candid1[$i]['image']?>' id="img" class='card-img-top m-auto' alt='...'>
                <div class='card-body';>
                  <p class='card-text'>Name: <strong><?php echo $candid1[$i]['fullname']?></strong></p>
                  <p class='card-text'>Post: <strong><?php echo $candid1[$i]['post']?></strong></p>
                  <p class='card-text'>party:<strong><?php echo $candid1[$i]['party']?></strong></p>
                  <p class='card-text'>Total votes:<strong> <?php echo $candid1[$i]['votes']?></strong></p>
                  <form action="./config/voting.php" method="post"> 
                    <input type="hidden" name="candidatevotes"  value="<?php echo $candid1[$i]['votes']?>">
                    <input type="hidden" name="candidateid"  value="<?php echo $candid1[$i]['id']?>">
                    <input type="hidden" name="uid"  value="<?php echo $_SESSION['id']?>">
                    <?php
                    $_SESSION['status'] = $status;
                    if($status == 0){
                        ?>
                        <button class='btn btn-danger my-3' type='submit'  name='vote'>vote</button>
                        <?php
                    }else{
                    ?>
                    <h3 class="bg-success text-white w-50 text-center pb-1" style="border-radius: 20px; box">voted</h3>
                    <?php
                  }
                  ?>
                </form>
                </div>
                </div>
                <?php
                }
            }
            ?>
            <?php  
            }else{
                $_SESSION['status'] = $status;
                if($status == 0){
                  $newstatus = "STATUS: <b class='text-danger'>Not voted</b>";
                }else{
                  $newstatus = "STATUS: <b class='success'> voted</b>";
                }
                ?>
                <?php echo $newstatus;?>
          <div class="main">
          <?php
          $sql = "SELECT * FROM info WHERE standard = 'candidate'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
          $candid1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $_SESSION['candid1'] = $candid1;
              }
          if(isset($_SESSION['candid1'])) {
              $candid1 = $_SESSION['candid1'];
              for($i=0; $i<count($candid1); $i++){
          
          ?>
          <div class='card bg-light my-4' style='width: 18rem;'>
              <img src='images/<?php echo $candid1[$i]['image']?>' id="img" class='card-img-top m-auto' alt='...'>
              <div class='card-body';>
                <p class='card-text'>Name: <strong><?php echo $candid1[$i]['fullname']?></strong></p>
                <p class='card-text'>Post: <strong><?php echo $candid1[$i]['post']?></strong></p>
                <p class='card-text'>party:<strong><?php echo $candid1[$i]['party']?></strong></p>
                <p class='card-text'>Total votes:<strong> <?php echo $candid1[$i]['votes']?></strong></p>
                <form action="./config/voting.php" method="post"> 
                  <input type="hidden" name="candidatevotes"  value="<?php echo $candid1[$i]['votes']?>">
                  <input type="hidden" name="candidateid"  value="<?php echo $candid1[$i]['id']?>">
                  <input type="hidden" name="uid"  value="<?php echo $_SESSION['id']?>">
              </form>
              </div>
              </div>
              <?php
              }
          }
            }
                }?>

        </div>
    </div>
    <?php }?>
</body>
</html>
