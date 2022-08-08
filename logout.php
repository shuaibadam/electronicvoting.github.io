
<?php
session_start();
if (isset($_SESSION['email'])) {
        session_unset();
        session_destroy();
        header("Refresh:0; url=login.php");

}else{

}
