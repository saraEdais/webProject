<?php
session_start();
require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_POST['likeReact'])) {
        $postId = $_GET['postId'];
        $react = $_POST['likeReact'];
        $username = $_SESSION['username'];
        $page=$_GET['page'];

        $getLikes = mysqli_query($conn, "SELECT likes FROM posts WHERE postId='$postId'");
        $row = mysqli_fetch_array($getLikes);
        $totalLikes = $row['likes'];

        if ($react === "Like") {
            $insertLikes = mysqli_query($conn, "INSERT INTO likes (username, postId) VALUES ('$username', '$postId')");

            $totalLikes++;
            $update = "UPDATE posts SET likes='$totalLikes' WHERE postId='$postId'";
            $query = mysqli_query($conn, $update);

            if ($page === "1") {
                header("location:homePage.php");
            } elseif ($page === '2') {
                header("location:profilePage.php");
            }
        } elseif ($react==="Unlike") {
            $deleteLikes = mysqli_query($conn, "DELETE FROM likes WHERE username='$username' AND postId='$postId'");

            $totalLikes--;
            $update = "UPDATE posts SET likes='$totalLikes' WHERE postId='$postId'";
            $query = mysqli_query($conn, $update);

            if ($page === "1") {
                header("location:homePage.php");
            } elseif ($page === '2') {
                header("location:profilePage.php");
            }
        }
    }
}
else {
    header("location:loginPage.php");
}
?>