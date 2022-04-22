<?php 
session_start();
require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['commentSubmit'])) {
        $comment=$_POST['comment'];
        $username=$_SESSION['username'];
        $postId=$_GET['postId'];
        $page=$_GET['page'];

        if ($page==="1") {
            if (!empty($comment)) {
                $sql = "INSERT INTO comments (username,postId,comment) VALUES ('$username','$postId','$comment')";
                $resultInsert = mysqli_query($conn, $sql);
                if ($resultInsert) {
                    header("location:homePage.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        else if ($page==="2") {
            if (!empty($comment)) {
                $sql = "INSERT INTO comments (username,postId,comment) VALUES ('$username','$postId','$comment')";
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
}
else {
    header("location:loginPage.php");
}

?>