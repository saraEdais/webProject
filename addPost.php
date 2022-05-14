<?php
session_start();
require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['postSubmit'])) {
        $username = $_SESSION['username'];
        $postText = mysqli_real_escape_String($conn,$_POST['postText']);
        $postImage=  mysqli_real_escape_String($conn,$_POST['addImage']);
        $active=$_GET['active'];

        if ($active) {
            //inserted the content of the post to a database if an image is get
            if (!empty($postImage)) {
                if (empty($postText)) {
                    header("location:homePage.php?&error=you should enter a text");
                    exit();
                }
                $sql = "INSERT INTO posts (username,textContent,imageContent,likes) VALUES ('$username','$postText','$postImage',0)";
                $resultInsert = mysqli_query($conn, $sql);
                if ($resultInsert) {
                    header("location:homePage.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } 
            else {
                if (empty($postText)) {
                    header("location:homePage.php?error=you should enter a text");
                    exit();
                }
                $sql = "INSERT INTO posts (username,textContent,likes) VALUES ('$username','$postText',0)";
                $resultInsert = mysqli_query($conn, $sql);
                if ($resultInsert) {
                    header("location:homePage.php");
                    exit();
                } else {
                    echo "Error: " . $sqlInsert . "<br>" . mysqli_error($conn);
                }
            }
        } 
        else{
            header("location:homePage.php?error= you don't have permission to post a post"); 
        }
    }
}
else{
    header("location:loginPage.php");
}
?>