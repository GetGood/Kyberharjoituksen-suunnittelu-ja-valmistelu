<?php
// logout.php
session_start();
  
if (isset($_SESSION['uid'])) {
    unset($_SESSION['uid']);

}
  
header("Location: http://" . $_SERVER['HTTP_HOST']
                           . dirname($_SERVER['PHP_SELF']) . '/'
                           . "login.php");
?>