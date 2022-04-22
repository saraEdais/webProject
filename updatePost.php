<?php
session_start();

require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['editPost']) && isset($_GET['postId'])) {
        $postId=$_GET['postId'];
        $editText=$_POST['editText'];
        $editImage=$_POST['editImage'];

        if (!empty($editImage)) {
            if (empty($editText)) {
                header("location:homePage.php?error=enter the text");
                exit();
            }
            $sql = "UPDATE posts SET textContent='$editText',imageContent='$editImage' WHERE postId=$postId";
            $resultInsert = mysqli_query($conn, $sql);
            if ($resultInsert) {
                echo "record update successfully";
                header("location:profilePage.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            if (empty($editText)) {
                header("location:profilePage.php?error=enter the text ");
                exit();
            }
            $sql = "UPDATE posts SET textContent='$editText' WHERE postId=$postId";
            $resultInsert = mysqli_query($conn, $sql);
            if ($resultInsert) {
                echo "record update successfully";
                header("location:profilePage.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
else{
    header("location:loginPage.php");
}
?>