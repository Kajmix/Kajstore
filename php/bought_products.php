<?php
    session_start();
    if(!isset($_SESSION["logged_in"])){$_SESSION["logged_in"] = false;}
    if($_SESSION["id_user"] != $_GET["user_id"]){
        header("Location: ../index.php");
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kajstore";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bought products</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/bought_products.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/bought_products.css">
</head>
<body>
    <header>
    <a class="title" href="../index.php"><h1 class="title">Kajstore</h1></a>
        <nav class="nav-header">
            <a href="../index.php">Main</a>
            <a href="../php/cart.php">Cart</a>
            <a href="./login.php">Login</a>
        </nav>
        <div class="user">
        <?php
            if($_SESSION["logged_in"]){
            $sql = "SELECT photo_path FROM users WHERE id_user = ". $_SESSION["id_user"].";";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $photo_path = $row["photo_path"];
                }
            }
            echo "<img src='../media/$photo_path' class='user_image'>";
            echo "<a href = './user.php?user_id=". $_SESSION['id_user']."'>";
            echo '';
            echo $_SESSION["first_name"];
            echo " ";
            echo $_SESSION["last_name"];
            echo "</a>";
            }
        ?>
        </div>
        </div>
    </header>
    <main>
        <?php
        $id_user = $_GET["user_id"];
            $sqlproducts = "SELECT products.name, products.file_path, products.photo_path FROM bought_products 
            JOIN products on products.id_product = bought_products.id_product
            WHERE id_user = $id_user;";
            $result = $conn->query($sqlproducts);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<div class='product'>";
                    echo "<img src='../media/".$row["photo_path"]."' class='product_image'>";
                    echo "<h1>".$row["name"]."</h1>";
                    echo "<a href='../download/".$row["file_path"]."' download>Download</a>";
                    echo "</div>";
                }
            }else{
                echo "<h1Buy something! :< </h1>";
            }
        ?>
    </main>
    <script src="../js/appear_bp.js"></script>
</body>
</html>