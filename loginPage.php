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
                <span class="signIn">SignIn</span>
            </div>
            <p>
                New User?
                <a href="./registrationPage.php"> Create an account</a>
            </p>
            <form method="post" action="login.php" class="loginForm">
                <div>
                    <label>username</label>
                    <input class="textInput" type="text" placeholder="username" name="username">
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