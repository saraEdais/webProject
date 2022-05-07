<?php 
session_start();
if(isset($_SESSION['username'])&& $_GET['user']){
    unset($_SESSION['username']);
    header("location:loginPage.php");
}
else if(isset($_SESSION['adminName'])&& $_GET['admin']){
    unset($_SESSION['adminName']);
    header("location:AdminLoginPage.php");
}

?>