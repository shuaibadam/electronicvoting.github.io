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
require('./config/db.php');

$sql = "SELECT * FROM admin WHERE fullname = '$fullname'";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($arr = mysqli_fetch_array($result)) {
        $fullname = $arr['fullname']; 
        $nin = $arr['nin']; 
        $image = $arr['image'];
        $title = $arr['title'];
    }
}
?>

    <div class=" bg-dark m-auto text-center my-5 w-50 b">
        <h1 class='card-text text-light py-3'>Edit-candidates</h1>

    </div>
    <div class="container my-5">
<button type="button" class="btn btn-success m-3">
<a href="participant.php">Done</a></button>
<form action="./config/title.php" method="post">
<label for="title">title:</label><br>
 <input type="text" name="title" value="<?php echo $title; ?>"><br>
 <button class="btn btn-success  my-4" id="minee"type="submit" name="update-title" >Update</button><br>
</form>

<div class="main">
    <?php
        $sql = "SELECT * FROM info WHERE standard = 'candidate'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          $candidate = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $_SESSION['candidate'] = $candidate;
        }

        if(isset($_SESSION['candidate'])) {
            $candidate = $_SESSION['candidate'];
            for($i=0; $i<count($candidate); $i++){
?>
    <div class='card bg-light my-4' style='width: 18rem;'>
        <img src='images/<?php echo $candidate[$i]['image']?>' class='card-img-top m-auto' alt='...'>
        <div class='card-body';>
            <p class='card-text'>Name: <?php echo $candidate[$i]['fullname']?></p>
            <form action="./config/edit-participant-c.php" method="post">
              <label for="post">Post:</label><br>
              <input type="text" name="post" value="<?php echo $candidate[$i]['post']?>"><br>
              <label for="post">Party:</label><br>
              <input type="text" name="party" value="<?php echo $candidate[$i]['party']?>">
              <input type="hidden" name="uid"  value="<?php echo $candidate[$i]['id']?>">
              <button class="btn btn-success  my-4"type="submit" name="update" class="vote">Update</button><br>
            </form>
        </div>
    </div>

        <?php
            
                }
            }else{
                header("Location: index.php");
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php } ?>

