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

    $id_product = $_GET["product_id"];
    $id_user = $_SESSION["id_user"];

    $check = "SELECT 1
    FROM carts
    WHERE (carts.id_user = $id_user) && (carts.id_product = $id_product)
    UNION
    SELECT 1
    FROM bought_products
    WHERE (bought_products.id_user = $id_user) && (bought_products.id_product = $id_product)
    LIMIT 1;
    ";
    $result = $conn->query($check);
    if($result->num_rows > 0){
        header("Location: ../index.php");
    }else{
            $id_product = $_GET["product_id"];

        if($_SESSION["logged_in"]){
            $id_user = $_SESSION["id_user"];
            $sql = "INSERT INTO carts (id_user, id_product) VALUES ('$id_user', '$id_product')";
            if($conn->query($sql) === TRUE){
                echo "Your account has been created!";
                header("Location: ../index.php");
            }else{
                echo "Error: ". $sql . "<br>". $conn->error;
            }
        }else{
            header("Location: ../php/login.php");
        }
    }
?>