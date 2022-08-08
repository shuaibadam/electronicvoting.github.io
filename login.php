<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="files/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="files/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Downloads/fontawesome-free-6.1.1-web%20(1)/fontawesome-free-6.1.1-web/css/all.css">
</head>
<body>
    <div class="container">
        <div class="const bg-dark my-4 m-auto text-center">
            <div class="admin">
                <a href="admin-login.php"><button class="btn1 mx-4 p-1" id="admin">Admin</button></a>
            </div>
            <form class="" action="./config/login-c.php" method="POST">
                <h1 class="text-light">Login</h1>
                <label class="mt-4" for="email">Email:</label><br>
                <input type="email" name="email" placeholder="Enter your Email" class="inputs" required="required"><br>
                <label class="mt-4" for="password">password:</label><br>
                <input type="password" name="password" placeholder="Enter your Password" class="inputs" required="required"><br>
                <button class="btn btn-secondary my-3" type="submit" name="login" class="btn1">Login</button><br>
            </form>
            </form>
            <div class="form2 my-3" action="">
                <span>Don't have an account?</span> <a href="index.php"><button class="btn1 mx-4 p-1" >Sign Up</button></a>
            </div>
        </div>
    </div>
</body>
</html>