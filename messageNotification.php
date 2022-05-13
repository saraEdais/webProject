<?php
require "db-conn.php";
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $messages="SELECT * FROM messages WHERE send_to_id IN(SELECT id FROM users WHERE username='$username') AND seen_state=0";
    $result=mysqli_query($conn,$messages);
    $messagesContent=mysqli_num_rows($result);
    if($messagesContent >0){
        echo "1";
    }
}
else{
    header("location:loginPage.php");
}
?>