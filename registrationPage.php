<!DOCTYPE html>

<head>
    <title>Registration Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/javaScript/script.js"></script>
    <link rel="stylesheet" href="./assets/styleSheet/login.css">
    <link rel="stylesheet" href="./assets/styleSheet/register.css">
</head>

<body>
    <div class="image">
        <div class="appName">FriendsBook</div>
        <img src="./assets/images/people1.png">
    </div>
    <div class="registerDiv">
    <?php if(isset($_GET['success'])){ ?>
        <div class="success">
            <p> your registration is successful</p>
            <a href="loginPage.php">go to login page</a>
        </div>
        <?php } 
        else {?>
        <div class="registerContainer">
            <div class="register">Register</div>
            <div>
                <form class="registerForm" method="post" action="register.php">
                    <div class="inputDiv">
                        <div class="registerInputDiv">
                            <label>First Name</label>
                            <input type="text" placeholder="first name" name="firstName">
                        </div>
                        <div class="registerInputDiv">
                            <label>Last Name</label>
                            <input type="text" placeholder="last name" name="lastName">
                        </div>
                    </div>
                    <div class="inputDiv">
                        <div class="registerInputDiv">
                            <label>username</label>
                            <input type="text" placeholder="username" name="username">
                        </div>
                        <div class="registerInputDiv">
                            <label>password</label>
                            <input type="text" placeholder="password" name="password">
                        </div>
                    </div>
                    <div>
                        <label>Gender: </label>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">male</label>

                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">female</label>
                    </div>
                    <div class="registerInputDiv">
                        <label>Email</label>
                        <input type="email" placeholder="enter your email" name="email">
                    </div>
                    <div class="registerInputDiv">
                        <label>Tele-No</label>
                        <input type="text" placeholder="telephone number" name="telephoneNo">
                    </div>
                    <div class="registerInputDiv">
                        <label>Address</label>
                        <input type="text" placeholder="address" name="address">
                    </div>
                    <div class="registerInputDiv">
                        <label>upload image</label>
                        <input style="border:none" type="file" name="imageFile" accept="image/*" value="" />
                    </div>
                    <input id="register" class="registerButton" type="submit" name="register" value="register"
                        onclick="registerButtonHandel($_GET['success'])">
                </form>
            </div>
            <?php
                if (isset($_GET['error'])) {
                    ?>
            <p class="error1"><?php echo $_GET['error'] ?></p>
            <?php
                }
            ?>
        </div>
        <?php } ?>
    </div>
</body>

</html>