<!DOCTYPE html>
<head>
    <title>FriendsBook</title>
    <link rel="stylesheet" href="./assets/styleSheet/login.css">
</head>

<body>
    <div class="image">
        <div class="appName">FriendsBook</div>
        <img src="./assets/images/people1.png">
    </div>
    <div class="logInContainerDiv">
        <div class="logInContainer">
            <div>
                <span class="signIn">Admin SignIn</span>
            </div>
            <form method="post" action="adminLogin.php" class="loginForm">
                <div>
                    <label>Admin name</label>
                    <input class="textInput" type="text" placeholder="Admin name" name="adminName">
                </div>
                <div>
                    <label>password</label>
                    <input class="textInput" type="password" placeholder="password" name="password">
                </div>
                <?php
                    if(isset($_GET['error'])){?>
                <p class="error"><?php echo $_GET['error'] ?></p>
                <?php   }
                 ?>
                <input class="submitButton" type="submit" name="submit" value="login">
            </form>
        </div>
    </div>
</body>

</html>