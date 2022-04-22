<?php 
session_start();

require "db-conn.php";
if (isset($_SESSION['username'])) {
    if (isset($_GET['status'])) {
        $username=$_SESSION['username'];
        $userId=$_GET['userId'];
        $friendId=$_GET['friendId'];

        // send add request
        if ($_GET['status']==='send') {
            $sendQuery="INSERT INTO friends (userId, friendId, status) VALUES ('$userId', '$friendId', 'send')";
            $send=mysqli_query($conn, $sendQuery);

            $receiveQuery="INSERT INTO friends (userId, friendId, status) VALUES ('$friendId', '$userId', 'receive')";
            $receive=mysqli_query($conn, $receiveQuery);

            if ($send && $receive) {
                header("location:homePage.php");
            } else {
                echo "Error: "."<br>" . mysqli_error($conn);
            }
        }
        //accept the request
        elseif ($_GET['status']==='accept') {
            $deleteSql="DELETE FROM friends WHERE userId IN('$userId','$friendId') AND friendId IN('$friendId','$userId') AND status IN ('receive','send')";
            $deleteResult=mysqli_query($conn, $deleteSql);


            $acceptQuery="INSERT INTO friends (userId, friendId, status) VALUES ('$userId', '$friendId', 'friend'),('$friendId', '$userId', 'friend')";
            $accept=mysqli_query($conn, $acceptQuery);

            if ($accept) {
                header("location:homePage.php");
            } else {
                echo "Error: "."<br>" . mysqli_error($conn);
            }
        }
        // deny the request
        elseif ($_GET['status']==='deny') {
            $denySql="DELETE FROM friends WHERE userId IN('$userId','$friendId') AND friendId IN('$friendId','$userId') AND status IN ('receive','send')";
            $deny=mysqli_query($conn, $denyQuery);

            if ($deny) {
                header("location:homePage.php");
            } else {
                echo "Error: "."<br>" . mysqli_error($conn);
            }
        }
        // delete friend
        elseif ($_GET['status']==='delete') {
            $deleteFriend="DELETE FROM friends WHERE userId IN('$userId','$friendId') AND friendId IN('$friendId','$userId') AND status IN ('friend','friend')";
            $delete=mysqli_query($conn, $deleteFriend);

            if ($delete) {
                header("location:profilePage.php");
            } else {
                echo "Error: "."<br>" . mysqli_error($conn);
            }
        }
    }
}
else{
    header("location:loginPage.php");
}
?>