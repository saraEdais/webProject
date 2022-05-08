<?php
session_start();

require "db-conn.php";

if (isset($_POST['submit'])) {
    $userName =  mysql_real_escape_String($_POST['username']);
    $password =  mysql_real_escape_String($_POST['password']);
    if(empty($userName) && empty($password)){
        header("location:loginPage.php?error=Username and password is required");
        exit();
    }
    else if (empty($userName)) {
        header("location:loginPage.php?error=Username is required");
        exit();
    }
    else if (empty($password)) {
        header("location:loginPage.php?error=Password is required");
        exit();
    }
    $query = "SELECT * FROM users WHERE username='$userName' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $userName && $row['password'] === $password) {
            $_SESSION['username']=$userName;
            header("location:homePage.php");
            exit();
        }
    }
    else {
        header("location:loginPage.php?error=Incorrect username or password");
        exit();
    }
}
?>