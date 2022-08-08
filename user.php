<?php
require('./config/db.php');
session_start();

$fullname = $_SESSION['fullname'];

if (!isset($fullname)){
    header('Refresh:0; url=login.php');
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
    <link rel="stylesheet" href="css/user.css">    
    <link rel="stylesheet" href="files/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="files/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Downloads/fontawesome-free-6.1.1-web%20(1)/fontawesome-free-6.1.1-web/css/all.css">
</head>
<body>
    <?php
require('./config/db.php');

$sql = "SELECT * FROM admin WHERE fullname = '$fullname'";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($arr = mysqli_fetch_array($result)) {
        $fullname = $arr['fullname']; 
        $nin = $arr['nin']; 
        $image = $arr['image'];
        // $uid = $arr['id'];
        // $_SESSION['id'] = $uid;



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
                <ul class='navbar-nav ms-auto'>
                    <li class='navbar-item my-3' >
                        <a href='home.php' class='navbar-link text-light mx-5'>Home </a>
                    </li>
                    <li class='navbar-item my-3'>
                        <a href='participant.php' class='navbar-link text-light mx-5'>Candidates </a>
                    </li>
                    <li class='navbar-item my-3'>
                        <a href='user.php' class='navbar-link text-light mx-5'>Voters </a>
                    </li>
                    <li class='navbar-item'>
                        
                    <div class='logout-div mx-5 px-5 my-3' >
                    <a href='admin-logout.php'class='btn btn-light my-auto my-1'class='btn1'>Logout</a><br>
                    </div>
                    
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        
        ";

    }
}


    ?>
    <div class=" bg-dark m-auto text-center my-3 w-50 ">
        <h1 class='card-text text-light py-3'>Voters</h1>
        <!-- <p class='card-text text-light'>NIN: 12345678900</p> -->
            <!-- </div> -->
    </div>

    <div class="container my-2">

        <div class="main ">
           <?php

       $sql = "SELECT * FROM info WHERE standard = 'voter'";
       $result = mysqli_query($conn, $sql);
       if(mysqli_num_rows($result) > 0){
         $voters = mysqli_fetch_all($result, MYSQLI_ASSOC);
         $_SESSION['voters'] = $voters;
         }

         $sql = "SELECT * FROM info WHERE standard = 'voter'";
         $result = mysqli_query($conn, $sql);
         if(mysqli_num_rows($result) > 0){
           $voters = mysqli_fetch_all($result, MYSQLI_ASSOC);
           $voters = count($voters);
           if ($voters >= 1) {

                        if(isset($_SESSION['voters'])) {
                $voters = $_SESSION['voters'];
                for($i=0; $i<count($voters); $i++){
                    ?>
                    <div class='card bg-light my-2' style='width: 18rem;'>
                    <img src='images/<?php echo $voters[$i]['image']?>' class='card-img-top m-auto' alt='...'>
                    <div class='card-body';>
                      <p class='card-text mx-3'>Name: <?php echo $voters[$i]['fullname']?></p>
                      <p class='card-text mx-3'>Standard: <?php echo $voters[$i]['standard']?></p>
                      <p class='card-text mx-3'>Status: <?php

                      $newstatus = $voters[$i]['status'];
                       if ($newstatus == 0){
                        echo "Not voted";
                       }else{
                        echo  "voted";
                       }
                       
                       ?></p>
                      <p class='card-text mx-3'>E-mail: <?php echo $voters[$i]['email']?></p>
                      <p class='card-text mx-3'>NIN: <?php echo $voters[$i]['nin']?></p>

                      <form action="./config/add.php" method="post">
                      <input type="hidden" name="uid"  value="<?php echo $voters[$i]['id']?>">
                      <button class="btn btn-success  my-4"type="submit" name="add" class="vote">Add to candidate</button><br>
                      </form>
                    </div>
                    </div>
                    <?php
                }
            }


           }else{

           }
           }else{
            ?>
            <div class='container'>
            <div class='main bg-dark my-4 py-5 m-auto'>
                <div class='cube bg-dark text-center m-auto py-2 mx-2 mb-4'>
                </div>
                <div class='card bg-dark';>
                </div>
                <div class='card-body bg-light text-center mx-3 my-2';>
                    <h2 class='text-danger'>No voters available</h2>
                </div>
            </div>
          </div> 
          <?php }


            ?>
        </div>
    </div>


        </div>
    </div>
</body>
</html>
<?php } ?>