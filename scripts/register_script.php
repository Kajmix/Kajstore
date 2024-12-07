<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kajstore";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $hashpassword = hash('sha256', $password);

    if($password == $rpassword){
        $password = " ";
        $rpassword = " ";
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `password_user`, `email`, `birthdate`) VALUES ('$firstname','$lastname','$hashpassword','$email','$birthdate');";
        if($conn->query($sql) === TRUE){
            header("Location: ../index.php");
        }else{
            echo "Error: ". $sql . "<br>". $conn->error;
        }
    }else{
        echo "Passwords do not match!";
    }
?>