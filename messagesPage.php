<?php
session_start();
require "db-conn.php";
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    
    $userId=$_GET['userId'];
    $friendId=$_GET['friendId'];

    $messages="SELECT * FROM messages WHERE user_id IN ($friendId,$userId) AND send_to_id IN ($userId,$friendId) ORDER BY sended_at ASC";
    $result=mysqli_query($conn,$messages);
    $messagesContent=mysqli_num_rows($result);

    $update_query = "UPDATE messages SET seen_state = 1 WHERE send_to_id=$userId AND user_id=$friendId ";
    mysqli_query($conn, $update_query);

    $users="SELECT * FROM users WHERE id=$userId";
    $results=mysqli_query($conn,$users);
    $userRow=mysqli_fetch_array($results);

    $friend="SELECT * FROM users WHERE id=$friendId";
    $fResults=mysqli_query($conn,$friend);
    $friendRow=mysqli_fetch_array($fResults);
}
else {
    header("location:loginPage.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>profile Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/styleSheet/profile.css">
    <link rel="stylesheet" href="../assets/styleSheet/message.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <div class="title">
            <img src="./assets/images/people1.png">
            <a class="anchor" href="./homePage.php">FriendsBook</a>
        </div>
        <div class="subHeader">
            <a class="anchor" href="profilePage.php" > <i class="fa fa-user"
                    style="color:white;margin-right:5px"></i>
                <?php echo $username ?> </a>
            <a class="anchor" href="profilePage.php"><i class="fa fa-commenting" style="color:white;margin-left:5px"></i> Message</a>
            <div id="friendsIcon" class="friendsIcon" onclick="friendIconHandel()"><i class='fas fa-users'
                    style='margin-left:5px'></i></div>
            <a class="anchor" href="logout.php?user=1"><i class="fa fa-sign-out" style="margin-left:5px"></i>
                Logout</a>
        </div>
    </div>
    <div class="content">
        <div class="messageSide">
            <div class="messageContent" id="messageContent">
                <div class="messageHeader">
                    <div class="userName">
                        <img class="userImage" src=<?php echo "./assets/images/".$friendRow['imageFile']  ?>>
                        <h5><?php echo $friendRow['firstName']." " .$friendRow['lastName']?> </h5>
                    </div>
                </div>
                <div class="messageBody">
                    <?php if($messagesContent ===0){ ?>
                    <h4> No messages</h4>
                    <?php }
        else {
            while($message=mysqli_fetch_array($result)){?>
                    <div class="messageList">
                        <div class="userName">
                            <h5><?php if ($message['user_id']===$friendId) {
                                echo $friendRow['firstName'];
                            } else {
                                echo $userRow['firstName'];} ?></h5>
                        </div>
                        <div class="messageText">
                            <?php echo $message['body'] ?>
                        </div>
                    </div>
                    <?php
            } 
        }?>
                </div>
                <div class="sendMessage">
                    <form action=<?php echo "message.php?userId=".$userId."&friendId=".$friendId?> method="post">
                        <input class="messageInput" placeholder="type your message" name="message"></input>
                        <input class="sendButton" type="submit" name="sendMessage" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./assets/javaScript/script1.js"></script>

</html>