<?php
require "db-conn.php";
session_start();
if (isset($_SESSION['adminName'])) {
    if (isset($_GET['userId'])&&isset($_GET['active'])) {
        $userId = $_GET['userId'];
        $activeState = $_GET['active'];

        if ($activeState === "1") {
            $sql = "UPDATE users SET active= 0 WHERE id=$userId";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location:adminPage.php");
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } elseif ($activeState === "0") {
            $sql = "UPDATE users SET active= 1 WHERE id=$userId";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location:adminPage.php");
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    } else {
        if (isset($_GET['postId'])&&isset($_GET['active'])) {
            $postId = $_GET['postId'];
            $activation = $_GET['active'];
    
            if ($activation === "1") {
                $sql = "UPDATE posts SET activation= 0 WHERE postId=$postId";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("location:adminPage.php");
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            } elseif ($activation === "0") {
                $sql = "UPDATE posts SET activation= 1 WHERE postId=$postId";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("location:adminPage.php");
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
        }
    }
}
else {
    header("location:adminLoginPage.php");
}
?>