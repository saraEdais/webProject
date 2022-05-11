<?php
require "db-conn.php";
session_start();
if (isset($_SESSION['username'])) {
    $postId=$_GET['postId'];

    $commentSql="SELECT * FROM comments WHERE postId='$postId' ORDER BY createdTime DESC";
    $comments=mysqli_query($conn, $commentSql);
}
else {
    header("location:loginPage.php");
}
?>
<html>

<head>
    <link rel="stylesheet" href="../assets/styleSheet/profile.css">
    <link rel="stylesheet" href="../assets/styleSheet/home.css">
</head>

<body>
    <form method="post" action=<?php echo"comment.php?postId=$postId&page=1" ?> class="commentForm">
        <input type="text" placeholder="type a comment" name="comment">
        <input type="submit" name="commentSubmit" value="add comment">
    </form>
    <?php 
        while ($comment = mysqli_fetch_assoc($comments)) {
            $usersComment=$comment['username'];
            $selectUser = "SELECT * FROM users WHERE username='$usersComment'";
            $selectResults = mysqli_query($conn, $selectUser);
            $userRow=mysqli_fetch_assoc($selectResults); ?>
    <div class="commentList">
        <div class="userComment">
            <img src=<?php echo "./assets/images/".$userRow['imageFile'] ?> class="userImage">
            <h5><?php echo $userRow['firstName']." ".$userRow['lastName'] ?></h5>
        </div>
        <div class="commentText">
            <?php echo $comment['comment'] ?>
        </div>
    </div>
    <?php
        }
    ?>
</body>
</html>