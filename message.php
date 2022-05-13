<?php
require "db-conn.php";
session_start();
if (isset($_SESSION['username'])) {

    if (isset($_POST['sendMessage'])) {
        $userId = $_GET['userId'];
        $friendId = $_GET['friendId'];
        $body = mysqli_real_escape_String($conn, $_POST['message']);

        if (!empty($body)) {
            $message = "INSERT INTO messages (user_id,send_to_id,body) VALUES ($userId,$friendId,'$body')";
            $resultInsert = mysqli_query($conn, $message);

            header("location:messagesPage.php?userId=".$userId."&friendId=".$friendId);
        }
        else{
            header("location:messagesPage.php?error=type a message");
        }
    }
}
else {
    header("location:loginPage.php");
}
?>