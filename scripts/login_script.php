<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kajstore";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashpassword = hash('sha256', $password);
    $password = " ";

    $sql = "SELECT id_user, first_name, last_name FROM `users` WHERE (email='$email')&&(password_user='$hashpassword');";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "Welcome ". $row['first_name']. " ". $row['last_name'];
            $_SESSION["id_user"] = $row['id_user'];
            $_SESSION["first_name"] = $row['first_name'];
            $_SESSION["last_name"] = $row['last_name'];
            $_SESSION["logged_in"] = true;
            header("Location: ../index.php");
        }
    } else {
        echo "User not found!";
    }
?>