<?php 
require "db-conn.php";
session_start();
if (isset($_SESSION['adminName'])) {
    $adminName=$_SESSION['adminName'];
    
    $users = "SELECT * FROM users";
    $usersResult = mysqli_query($conn, $users);

    $posts = "SELECT * FROM posts";
    $postsResult = mysqli_query($conn, $posts);

}
else{
    header("location:adminLoginPage.php");
}
?>
<html>

<head>
    <title>FriendsBook</title>
    <link rel="stylesheet" href="./assets/styleSheet/admin.css">
    <link rel="stylesheet" href="./assets/styleSheet/profile.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="header">
        <div class="title">
            <img src="./assets/images/people1.png">
            <a class="anchor">FriendsBook</a>
        </div>
        <div class="subHeader">
            <a class="anchor"><i class="fa fa-user" style="color:white;margin-right:5px"></i><?php echo $adminName ?>
            </a>
            <a class="anchor" href="logout.php?admin=1"><i class="fa fa-sign-out" style="margin-left:5px"></i>
                Logout</a>
        </div>
    </div>
    <div class="body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Users</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Posts</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <?php
                if($usersResult){ $i=1;?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">first name</th>
                            <th scope="col">last name</th>
                            <th scope="col">telephone</th>
                            <th scope="col">address</th>
                            <th scope="col">email</th>
                            <th scope="col">active</th>
                            <th scope="col">edit active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($users=mysqli_fetch_array($usersResult)){ 
                            $id=$users['id'];
                            $active=$users['active'];
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $users['username'] ?></td>
                            <td><?php echo$users['firstName'] ?></td>
                            <td><?php echo $users['lastName'] ?></td>
                            <td><?php echo$users['telephone'] ?></td>
                            <td><?php echo $users['address'] ?></td>
                            <td><?php echo $users['email'] ?></td>
                            <td><?php echo $users['active'] ?></td>
                            <td><a href=<?php echo"adminControl.php?userId=".$id."&active=".$active?>><i class="fa fa-edit"
                                        style="font-size:24px"></i></a></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <?php
                if($postsResult){ $i=1;?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">post body</th>
                            <th scope="col">post image</th>
                            <th scope="col">posted time</th>
                            <th scope="col">activation</th>
                            <th scope="col">edit activation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($posts=mysqli_fetch_array($postsResult)){
                            $postId=$posts['postId'];
                            $activation=$posts['activation'];
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $posts['username'] ?></td>
                            <td><?php echo$posts['textContent'] ?></td>
                            <td><?php if($posts['imageContent']) {echo "<img class='imgTable' src=./assets/images/".$posts['imageContent'].">";}else{echo "Null";} ?></td>
                            <td><?php echo$posts['createdTime'] ?></td>
                            <td><?php echo $posts['activation'] ?></td>
                            <td><a href=<?php echo"adminControl.php?postId=".$postId."&active=".$activation?>><i class="fa fa-edit"
                                        style="font-size:24px"></i></a></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>