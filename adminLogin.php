<?php
session_start();

require "db-conn.php";

if (isset($_POST['submit'])) {
    $adminName =  mysql_real_escape_String($_POST['adminName']);
    $password =  mysql_real_escape_String($_POST['password']);
    
    if(empty($adminName) && empty($password)){
        header("location:adminLoginPage.php?error=adminName and password is required");
        exit();
    }
    else if (empty($adminName)) {
        header("location:adminLoginPage.php?error=adminName is required");
        exit();
    }
    else if (empty($password)) {
        header("location:adminLoginPage.php?error=Password is required");
        exit();
    }
    $query = "SELECT * FROM admin WHERE name='$adminName' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['name'] === $adminName && $row['password'] === $password) {
            $_SESSION['adminName']=$adminName;
            header("location:adminPage.php");
            exit();
        }
    }
    else {
        header("location:adminLoginPage.php?error=Incorrect adminName or password");
        exit();
    }
}
?>