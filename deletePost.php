<?php
session_start();
require "db-conn.php";

if (isset($_SESSION['username'])) {
    $postId = $_GET['postId'];
 
    $delete = "DELETE FROM posts WHERE postId='$postId'";
    $deleteResult = mysqli_query($conn, $delete);
    if ($deleteResult) {
        header("location:profilePage.php");
    }
    else {
        echo "error" . mysqli_error($mysql);
    }
}
else {
    header("location:loginPage.php");
}
?>