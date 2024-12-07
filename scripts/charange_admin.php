<?php
    session_start();
    if(!isset($_SESSION["logged_in"])){$_SESSION["logged_in"] = false;}
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kajstore";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }

    $sql_is_admin = "SELECT is_admin FROM users WHERE id_user = ". $_SESSION["id_user"].";";
    $result_is_admin = $conn->query($sql_is_admin);
    if($result_is_admin->num_rows > 0){
        while($row = $result_is_admin->fetch_assoc()){
            $is_admin = $row["is_admin"];
        }
    }
    if($is_admin == 0){
        header("Location: ../index.php");
    }
    $user_id = $_GET["user_id"];
    $user_rank = $_GET["user_rank"];
    if ($user_rank == 1){
        $sql = "UPDATE users SET is_admin = 0 WHERE id_user = $user_id;";
        $conn->query($sql);
    }
    if ($user_rank == 0){
        $sql = "UPDATE users SET is_admin = 1 WHERE id_user = $user_id;";
        $conn->query($sql);
    }
    header("Location: ../admin/rcadmin.php");
    ?>