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
    <link rel="stylesheet" href="css/participant.css">    
    <link rel="stylesheet" href="files/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="files/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Downloads/fontawesome-free-6.1.1-web%20(1)/fontawesome-free-6.1.1-web/css/all.css">
</head>
<body>
<?php
$sql = "SELECT * FROM admin WHERE fullname = '$fullname'";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($arr = mysqli_fetch_array($result)) {
        $fullname = $arr['fullname']; 
        $nin = $arr['nin']; 
        $image = $arr['image'];
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
    <div class=" bg-dark m-auto text-center my-3 w-50 b">
        <h1 class='card-text text-light py-3'>Candidates</h1>
    </div>

        <?php
                        $sql = "SELECT * FROM info WHERE standard = 'candidate'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            $candidate = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $_SESSION['candidate'] = $candidate;
                        }

                        $sql ="SELECT * FROM info WHERE standard = 'candidate'";
                        $result =  mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                          $candid = mysqli_fetch_all($result, MYSQLI_ASSOC);
                          $candid = count($candid);
                          if ($candid >= 1){
                            ?>
                                <div class="container my-2">
                          <h2 class="edit-btn text-danger mx-5 text-center"><a href="edit-participant.php">Edit</a></h2>
                           <h2 class="mx-3">
                            <?php 
                        $sql = "SELECT * FROM admin WHERE id=1";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            $title = mysqli_fetch_array($result);
                            $mytitle =$title['title'];
                            echo $mytitle;
                        }

                           ?></h2><br>
                           <div class="main">
                           <?php  
                            if(isset($_SESSION['candidate'])) {
                                $candidate = $_SESSION['candidate'];
                                for($i=0; $i<count($candidate); $i++){
                                    ?>
                                    <div class='card bg-light my-1' style='width: 18rem;'>
                                    <img src='images/<?php echo $candidate[$i]['image']?>' class='card-img-top m-auto' alt='...'>
                                    <div class='card-body';>
                                      <p class='card-text mx-3'>Name: <?php echo $candidate[$i]['fullname']?></p>
                                      <p class='card-text mx-3'>Post: <?php echo $candidate[$i]['post']?></p>
                                      <p class='card-text mx-3'>party: <?php echo $candidate[$i]['party']?></p>
                                      <p class='card-text mx-3'>Total votes: <?php echo $candidate[$i]['votes']?></p>
                                      <p class='card-text mx-3'>Standard: <?php echo $candidate[$i]['standard']?></p>
                                      <p class='card-text mx-3'>Status:
                                         <?php 
                
                                        $newstatus = $candidate[$i]['status'];
                                        if ($newstatus == 0){
                                            echo "Not voted";
                                        }else{
                                            echo  "voted";
                                        }
                                         ?></p>
                                      <form action="./config/remove.php" method="post">
                                      <input type="hidden" name="uid"  value="<?php echo $candidate[$i]['id']?>">
                                      <button class="btn btn-danger  my-4"type="submit" name="remove" class="vote">Remove as candidate</button><br>
                                      </form>
                                    </div>
                                    </div>
                
                                    <?php
                                }
                            }
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
                        <h2 class='text-danger'>No candidate available</h2>
                    </div>
                </div>
              </div> 
                            <?php
                        }


            ?>
        </div>
    </div>
</body>
</html>
<?php } ?>

