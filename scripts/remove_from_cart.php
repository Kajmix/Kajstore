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
    
    $id_product = $_GET['id_product'];
    $id_user = $_SESSION["id_user"];

    $sql = "DELETE FROM carts WHERE (id_user = $id_user) && (id_product = $id_product);";
    $conn->query($sql);
    header("Location: ../php/cart.php");
?>