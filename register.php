<?php

require "db-conn.php";

if (isset($_POST['register'])) {
    $firstName =  mysql_real_escape_String($_POST['firstName']);
    $lastName =  mysql_real_escape_String($_POST['lastName']);
    $userName =  mysql_real_escape_String($_POST['username']);
    $password =  mysql_real_escape_String($_POST['password']);
    $gender =  mysql_real_escape_String($_POST['gender']);
    $email =  mysql_real_escape_String($_POST['email']);
    $telephoneNo =  mysql_real_escape_String($_POST['telephoneNo']);
    $address =  mysql_real_escape_String($_POST['address']);
    $imageFile =  mysql_real_escape_String($_POST["imageFile"]);

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
        $sql = "INSERT INTO `users` (`username`,`firstName`,`lastName`,`password`,`telephone`,`address`,`email`,`gender`,`imageFile`)
         VALUES ('$userName', '$firstName', '$lastName','$password','$telephoneNo','$address','$email','$gender','$imageFile')";
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