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

    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_description = $_POST["product_description"];
    $product_image = $_POST["product_image"];
    $product_file = $_POST["product_file"];

    $sql = "INSERT INTO `products`(`price`, `name`, `description`, `file_path`, `photo_path`) VALUES ($product_price, '$product_name', '$product_description', '$product_file', '$product_image');";
    $conn->query($sql);
    header("Location: ../admin/admin_panel.php");
?>