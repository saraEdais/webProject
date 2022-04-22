<?php
session_start();
require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['postSubmit'])) {
        $username = $_SESSION['username'];
        $postText = $_POST['postText'];
        $postImage= $_POST['addImage'];

        //inserted the content of the post to a database if an image is get
        if (!empty($postImage)) {
            if (empty($postText)) {
                header("location:homePage.php?&error=you should enter a text");
                exit();
            }
            $sql = "INSERT INTO posts (username,textContent,imageContent,likes) VALUES ('$username','$postText','$postImage',0)";
            $resultInsert = mysqli_query($conn, $sql);
            if ($resultInsert) {
                echo "New record created successfully";
                header("location:homePage.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            if (empty($postText)) {
                header("location:homePage.php?error=you should enter a text");
                exit();
            }
            $sql = "INSERT INTO posts (username,textContent,likes) VALUES ('$username','$postText',0)";
            $resultInsert = mysqli_query($conn, $sql);
            if ($resultInsert) {
                echo "New record created successfully";
                header("location:homePage.php");
                exit();
            } else {
                echo "Error: " . $sqlInsert . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "error";
    }
}
else{
    header("location:loginPage.php");
}
?>