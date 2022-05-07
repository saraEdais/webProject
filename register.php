<?php

require "db-conn.php";

if (isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $telephoneNo = $_POST['telephoneNo'];
    $address = $_POST['address'];
    $imageFile = $_POST["imageFile"];

    //check if all requirement is fill
    if (empty($firstName) || empty($lastName) || empty($password) || empty($userName) || empty($gender) || empty($email) || empty($telephoneNo) || empty($address) || empty($imageFile)) {
        header("location:registrationPage.php?error= some requirement is not fill ");
        exit();
    }
    //check if the username is not a duplicate
    $userNameQuery = "SELECT * FROM users WHERE username='$userName'";
    $result = mysqli_query($conn, $userNameQuery);
    if (mysqli_num_rows($result) !== 0) {
        header("location:registrationPage.php?error=username is already exist, enter another username");
        exit();
    }
    else{
        //inserted data to users table in mySQL
        $sql = "INSERT INTO `users` (`username`,`firstName`,`lastName`,`password`,`telephone`,`address`,`email`,`gender`,`imageFile`,'active')
         VALUES ('$userName', '$firstName', '$lastName','$password','$telephoneNo','$address','$email','$gender','$imageFile',1)";
        $resultInsert= mysqli_query($conn, $sql);
        if ($resultInsert) {
            echo "New record created successfully";
            header("location:registrationPage.php?success=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
else{
    echo "error";
}
?>