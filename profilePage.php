<?php
session_start();
require "db-conn.php";

//fetch the user details, friends and posts
if (isset($_SESSION['username'])) {
    $usernameProfile=$_SESSION['username'];
    $query = "SELECT * FROM users WHERE username='$usernameProfile'";
    $result = mysqli_query($conn, $query);
    if ($row=mysqli_fetch_assoc($result)) {
        $userId=$row['id'];
        $firstName=$row['firstName'];
        $lastName=$row['lastName'];
        $image=$row['imageFile'];
        $phoneNo=$row['telephone'];
        $email=$row['email'];
        $address=$row['address'];
    }
    // fetch all posts for this username
    $posts="SELECT * FROM posts WHERE username ='$usernameProfile' ORDER BY createdTime DESC" ;
    $userPosts = mysqli_query($conn, $posts);

    //select user friends
    $userFriends = "SELECT * FROM users WHERE id IN (SELECT friendId FROM friends WHERE status ='friend' AND userId='$userId') ";
    $friendsResult = mysqli_query($conn, $userFriends); 

    //select all posts the user liked it
    $likedPost="SELECT postId FROM likes WHERE username='$usernameProfile'";
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
    <title>profile Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="./assets/javaScript/script.js"></script>

    <link rel="stylesheet" href="../assets/styleSheet/profile.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <div>
        <div class="header">
            <div class="title">
                <img src="./assets/images/people1.png">
                <a class="anchor" href=<?php echo"./homePage.php"?>>FriendsBook</a>
            </div>
            <div class="subHeader">
                <a class="anchor" href=<?php echo "profilePage.php" ?>> <i class="fa fa-user"
                        style="color:white;margin-right:5px"></i>
                    <?php echo $usernameProfile ?> </a>
                <div><i class="fa fa-commenting" style="color:white;margin-left:5px"></i> Message</div>
                <div id="friendIcon" class="friendsIcon"><i class='fas fa-users' style='margin-left:5px'></i></div>
                <a class="anchor" href="logout.php"><i class="fa fa-sign-out" style="margin-left:5px"></i> Logout</a>
            </div>
        </div>
        <div class="content">
            <div class="firstSide">
                <div class="profile">
                    <div class="imageSide">
                        <img src=<?php echo "./assets/images/".$image ?>>
                    </div>
                    <div class="infoSide">
                        <h3><?php echo $firstName." ".$lastName ?></h3>
                        <p><i class="fa fa-phone" style="font-size:18px;margin-right:3px"></i> <?php echo $phoneNo ?>
                        </p>
                        <p><i class="fa fa-envelope-o" style="font-size:18px;margin-right:3px"></i><?php echo $email ?>
                        </p>
                        <p><i class="fa fa-home" style="font-size:18px;margin-right:3px"></i> <?php echo $address ?></p>
                    </div>
                </div>
                <div id="friends" class="friends">
                    <div class="closeFriend"><i id="closeFriendList" class="fa fa-times closeFriendList"
                            style="font-size:18px"></i></div>
                    <label> <i class='fas fa-user-friends' style='font-size:22px;margin:6px 8px;'></i> My
                        Friends</label>
                    <div class="list">
                        <?php
                        if(mysqli_num_rows($friendsResult)===0){?>
                        <div> Do not have friends yet </div>
                        <?php }
                        else {
                            while ($friend=mysqli_fetch_array($friendsResult)) { ?>
                        <div class="friendsList">
                            <?php  ?>
                            <div class="friendName">
                                <img src=<?php echo"./assets/images/".$friend['imageFile'] ?>>
                                <span class="span"><?php echo $friend['firstName']." ".$friend['lastName']?><span
                                        class="sunSpan"><?php echo " (".$friend['username'].")"?></span></span>
                            </div>
                            <div>
                                <button class="deleteButton">
                                    <a
                                        href=<?php echo "friendsHandel.php?userId=".$userId."&friendId=".$friend['id']."&status=delete" ?>>
                                        <i class='fas fa-user-minus' style='font-size:22px;color:rgb(156, 6, 6);'></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="secundSide">
                <!-- add posts from database  -->
                <?php 
                if(mysqli_num_rows($userPosts) === 0){
                    echo "<p> No posts yet </p>";
                }
                else{
                    while ($post=mysqli_fetch_assoc($userPosts)) { 
                        $postId=$post['postId'];
                        ?>
                <div class="posts">
                    <div class="postHeader">
                        <div class="subPostHeader">
                            <img class="userImage" src=<?php echo "./assets/images/".$image ?>>
                            <h3><?php echo $firstName." ".$lastName ?></h3>
                        </div>
                        <div class="editAndDelete">
                            <button onclick="edit(<?php echo $postId ?>)">
                                <i class="fa fa-edit" style="font-size:23px;color:#06582b"></i>
                            </button>
                            <button>
                                <a href=<?php echo "deletePost.php?postId=$postId"?>>
                                    <i class="fa fa-remove" style="font-size:24px;color:rgb(156, 6, 6)"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="postContent">
                        <p> <?php echo $post['textContent'] ?> </p>
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
                        <div class="react">
                            <form method="post" action=<?php echo"like.php?postId=$postId&page=2" ?>>
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
                    <div id=<?php echo"commentPart".$postId ?> class="comment">
                        <form method="post" action=<?php echo"comment.php?postId=$postId&page=2" ?> class="commentForm">
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
                <!-------------------- Edit Part ------------------->
                <div id=<?php echo "editPart".$postId ?> class="editPart">
                    <div class="editHeader">
                        <span>Edit post</span>
                        <i id=<?php echo"closeEdit".$postId ?> onclick="closeHandel(<?php echo $postId ?>)"
                            class="fa fa-remove" style="font-size:20px;color: black; cursor: pointer;"></i>
                    </div>
                    <div>
                        <form class="editForm" method="post" action=<?php echo"updatePost.php?postId=".$postId?>>
                            <textarea class="textarea" rows="10" cols="50" name="editText"></textarea>
                            <label onclick="addImage(<?php echo $postId ?>)">
                                <i class="fa fa-file-image-o" style="font-size:24px;margin:0px 4px;cursor:pointer"></i>
                            </label>
                            <input class="editImage" id=<?php echo"image".$postId ?> type="file" name="editImage"
                                accept="image/*">
                            <input class="editSubmit" type="submit" name="editPost" value="Edit">
                        </form>
                    </div>
                </div>
                <?php    } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
<script src="./assets/javaScript/script1.js"></script>

</html>