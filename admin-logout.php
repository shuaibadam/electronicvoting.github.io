
<?php
session_start();

if (isset($_SESSION['fullname'])) {
        session_unset();
        session_destroy();
        header("Refresh:0; url=admin-login.php");

}else{

}
