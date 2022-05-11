<?php
session_start();

require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['editPost']) && isset($_GET['postId'])) {
        $postId=$_GET['postId'];
        $editText= mysqli_real_escape_String($conn,$_POST['editText']);
        $editImage= mysqli_real_escape_String($conn,$_POST['editImage']);

        if (!empty($editImage)) {
            if (empty($editText)) {
                header("location:homePage.php?error=enter the text");
                exit();
            }
            $sql = "UPDATE posts SET textContent='$editText',imageContent='$editImage' WHERE postId=$postId";
            $resultInsert = mysqli_query($conn, $sql);
            if ($resultInsert) {
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