<?php
session_start();
require "db-conn.php";
if (isset($_SESSION['username'])) {
    $username= $_SESSION['username'];
    //user details
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_assoc($result);
    $userId=$row['id'];
    $firstName=$row['firstName'];
    $lastName=$row['lastName'];
    $image=$row['imageFile'];

    //selected all posts for user and user friends from database
    $posts="(
            SELECT * FROM posts WHERE username='$username'
        )
        UNION
        (
            SELECT * FROM posts WHERE username IN 
            (SELECT username FROM users WHERE id IN 
            (SELECT friendId FROM friends WHERE status ='friend' AND userId='$userId'))
        )
        ORDER BY createdTime DESC";
    $postsResult = mysqli_query($conn, $posts);

    //select users for Suggested friends list
    $users = "SELECT * FROM users WHERE username !='$username'";
    $sqlResult = mysqli_query($conn, $users);

    //select friend requests receive
    $request = "SELECT * FROM users WHERE id IN (SELECT friendId FROM friends WHERE status ='receive' AND userId='$userId') ";
    $receiveResult = mysqli_query($conn, $request);

    //select friend requests send
    $send = "SELECT * FROM users WHERE id IN (SELECT friendId FROM friends WHERE status ='send' AND userId='$userId') ";
    $sendResult = mysqli_query($conn, $send);
    $sendArray= array();
    while ($sends=mysqli_fetch_array($sendResult)) {
        array_push($sendArray, $sends['id']);
    };

    //select friends
    $userFriends = "SELECT friendId FROM friends WHERE status ='friend' AND userId='$userId' ";
    $friendsResult = mysqli_query($conn, $userFriends);
    $friendArray= array();
    while ($friends=mysqli_fetch_array($friendsResult)) {
        array_push($friendArray, $friends['friendId']);
    };

    //select all posts the user liked it
    $likedPost="SELECT postId FROM likes WHERE username='$username'";
    $likesResult=mysqli_query($conn, $likedPost);
    $likesArray= array();
    while ($likes=mysqli_fetch_array($likesResult)) {
        array_push($likesArray, $likes['postId']);
    };
}
else{
    header("location:loginPage.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="./assets/javaScript/script.js"></script>

    <link rel="stylesheet" href="../assets/styleSheet/profile.css">
    <link rel="stylesheet" href="../assets/styleSheet/home.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <div>
        <div class="header">
            <div class="title">
                <img src="./assets/images/people1.png">
                <a class="anchor" href=<?php echo"homePage.php" ?>>FriendsBook</a>
            </div>
            <div class="subHeader">
                <a class="anchor" href=<?php echo "profilePage.php" ?>> <i class="fa fa-user"
                        style="color:white;margin-right:5px"></i>
                    <?php echo $username ?> </a>
                <div><i class="fa fa-commenting" style="color:white;margin-left:5px"></i> Message</div>
                <div id="friendIcon" class="friendIcon"><i class='fas fa-users' style='margin-left:5px'></i></div>
                <a class="anchor" href="logout.php"><i class="fa fa-sign-out" style="margin-left:5px"></i> Logout</a>
            </div>
        </div>
        <div class="contents">
            <div class="postsPart">
                <div class="addPost">
                    <div class="postsHeader">
                        <img class="userImage" src=<?php echo "./assets/images/".$image ?>>
                        <h3><?php echo $firstName." ".$lastName ?></h3>
                    </div>
                    <div class="postText">
                        <form method="post" action=<?php echo "addPost.php"?>>
                            <textarea rows="3" cols="40" placeholder="write a post" name="postText"></textarea>
                            <label id="addImage"><i class="fa fa-file-image-o"
                                    style="font-size:24px;margin:0px 4px;cursor:pointer"></i></label>
                            <input id="image" class="imageInput" type="file" name="addImage" accept="image/*">
                            <input class="submitPost" type="submit" name="postSubmit" value="addPost">
                        </form>
                        <?php
                        if(isset($_GET['error'])){ ?>
                        <span><?php echo $_GET['error'] ?></span>
                        <?php } 
                        ?>
                    </div>
                </div>
                <!----------- add posts from database  -------------->
                <?php 
                if(mysqli_num_rows($postsResult) === 0){
                    echo "<p> No posts yet </p>";
                }
                else{
                    while ($post=mysqli_fetch_array($postsResult)) { 
                        $postId=$post['postId'];
                        $user=$post['username']
                        ?>
                <div class="posts">
                    <div class="postsHeader">
                        <?php 
                        $select = "SELECT * FROM users WHERE username='$user'";
                        $results = mysqli_query($conn, $select);
                        $row1=mysqli_fetch_assoc($results);
                        ?>
                        <img class="userImage" src=<?php echo "./assets/images/".$row1['imageFile'] ?>>
                        <h3><?php echo $row1['firstName']." ".$row1['lastName'] ?></h3>
                    </div>
                    <div class="postContent">
                        <p><?php echo $post['textContent'] ?></p>
                        <?php if($post['imageContent']){ ?>
                        <div>
                            <img src=<?php echo "./assets/images/".$post['imageContent'] ?>>
                        </div>
                        <?php } ?>
                    </div>
                    <div id=<?php echo"postReact".$postId ?> class="postReact">
                        <div class="react" onclick="commentHandel(<?php echo $postId ?>)">
                            comment
                            <i class="fa fa-comment-o" style="font-size:19px;color:blue;margin-left:6px"></i>
                        </div>
                        <!--------------------likes part---------------------->
                        <div class="react">
                            <form method="post" action=<?php echo"like.php?postId=$postId&page=1" ?>>
                                <?php if(in_array($postId,$likesArray)){?>
                                <label><?php if ($post['likes']>0) {echo $post['likes'];} ?></label>
                                <input type="submit" name="likeReact" value="Unlike">
                                <i class="fa fa-thumbs-o-up" style="font-size:19px;color:blue"></i>
                                <?php }
                                else { ?>
                                <label><?php if ($post['likes']>0) {echo $post['likes'];} ?></label>
                                <input type="submit" name="likeReact" value="Like">
                                <i class="fa fa-thumbs-o-up" style="font-size:19px;color:blue"></i>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                    <!-------------------- comments part  -------------------->
                    <div id=<?php echo"commentPart".$postId ?> class="comment">
                        <form method="post" action=<?php echo"comment.php?postId=$postId&page=1" ?> class="commentForm">
                            <input type="text" placeholder="type a comment" name="comment">
                            <input type="submit" name="commentSubmit" value="add comment">
                        </form>
                        <?php
                            $commentSql="SELECT * FROM comments WHERE postId='$postId' ORDER BY createdTime DESC";
                            $comments=mysqli_query($conn,$commentSql);
                            while($comment = mysqli_fetch_assoc($comments)){ 
                                $usersComment=$comment['username'];
                                $selectUser = "SELECT * FROM users WHERE username='$usersComment'";
                                $selectResults = mysqli_query($conn, $selectUser);
                                $userRow=mysqli_fetch_assoc($selectResults);
                            ?>
                        <div class="commentList">
                            <div class="userComment">
                                <img src=<?php echo "./assets/images/".$userRow['imageFile'] ?> class="userImage">
                                <h5><?php echo $userRow['firstName']." ".$userRow['lastName'] ?></h5>
                            </div>
                            <div class="commentText">
                                <?php echo $comment['comment'] ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php    } ?>
                <?php } ?>
            </div>
            <!--------------suggestedFriends and request add----------------->
            <div id="friendsPart" class="friendsPart">
                <div class="friendRequest">
                    <div class="closeFriends"><i id="closeFriendsList" class="fa fa-times closeFriendsList"
                            style="font-size:18px"></i></div>
                    <label>Friend requests</label>
                    <div class="list">
                        <?php
                        if(mysqli_num_rows($receiveResult)===0){?>
                        <div> No friends requests </div>
                        <?php }
                        else {
                            while ($req=mysqli_fetch_array($receiveResult)) { ?>
                        <div class="friendsList">
                            <?php  ?>
                            <div class="friendName">
                                <img src=<?php echo"./assets/images/".$req['imageFile'] ?>>
                                <span><?php echo $req['firstName']." ".$req['lastName']?></span>
                            </div>
                            <div class="acceptOrDeny">
                                <button>
                                    <a
                                        href=<?php echo "friendsHandel.php?userId=".$userId."&friendId=".$req['id']."&status=accept" ?>>
                                        <i class='fas fa-user-plus' style='font-size:18px;color:rgb(12, 114, 29)'></i>
                                    </a>
                                </button>
                                <button>
                                    <a
                                        href=<?php echo "friendsHandel.php?userId=".$userId."&friendId=".$req['id']."&status=deny" ?>>
                                        <i class='fas fa-user-times' style='font-size:18px;color:rgb(156, 6, 6)'></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="suggestedFriends">
                    <label>Suggested friends</label>
                    <div class="list">
                        <?php 
                        while($friend=mysqli_fetch_array($sqlResult)){
                            if(!in_array($friend['id'],$friendArray)){ ?>
                        <div class="friendsList">
                            <div class="friendName">
                                <img src=<?php echo"./assets/images/".$friend['imageFile'] ?>>
                                <span><?php echo $friend['firstName']." ".$friend['lastName']?></span>
                            </div>
                            <div>
                                <?php if(in_array($friend['id'],$sendArray)){ ?>
                                <button class="sendButton">
                                    <i class="fa fa-send" style="color:white;margin-right:4px"></i> Send
                                </button>
                                <?php }
                                else{ ?>
                                <button class="addButton">
                                    <a
                                        href=<?php echo "friendsHandel.php?userId=".$userId."&friendId=".$friend['id']."&status=send" ?>>
                                        <i class="fa fa-user-plus" style="color:white;margin-right:6px"></i> Add
                                    </a>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                            } 
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./assets/javaScript/script1.js"></script>
</html>