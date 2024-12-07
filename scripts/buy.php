<?php
$finalprice = 0;
session_start();
if(!isset($_SESSION["logged_in"])){ $_SESSION["logged_in"] = false; }
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "kajstore";

$conn = new mysqli($servername, $username, $password, $db_name);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$id_user = $_SESSION["id_user"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$payment = $_POST["payment"];
$email = $_POST["email"];

$sql = "SELECT first_name, last_name, email FROM users WHERE id_user = $id_user;";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $first_namesql = $row["first_name"];
        $last_namesql = $row["last_name"];
        $emailsql = $row["email"];
    }
}
if(($firstname == $first_namesql)&&($lastname == $last_namesql) && ($email == $emailsql)){
    $sql = "CALL ProcessOrder($id_user, '$payment');";
    $conn->query($sql);
    header("Location: ../index.php");
}else{
    die("You did something wrong!");
}

?>