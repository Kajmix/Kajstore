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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/variables.css">
    <link rel="stylesheet" href="./responsive/main.css">
    <link rel="stylesheet" href="./responsive/index.css">
</head>
<body>
    <header>
        <a class="title" href="./index.php"><h1 class="title">Kajstore</h1></a>
        <nav class="nav-header">
            <a href="./index.php">Main</a>
            <a href="./php/cart.php">Cart</a>
            <a href="./php/login.php">Login</a>
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
            echo "<img src='./media/$photo_path' class='user_image'>";
            echo "<a href = './php/user.php?user_id=". $_SESSION['id_user']."'>";
            echo '';
            echo $_SESSION["first_name"];
            echo " ";
            echo $_SESSION["last_name"];
            echo "</a>";
            }
        ?>
        </div>
    </header>
    <main>
        <?php
            $sql = "SELECT id_product, price,name, photo_path, description FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                        $id_product = $row["id_product"];
                        $imgsrc = $row["photo_path"];
                        $name = $row["name"];
                        $price = $row["price"];
                        $description = $row["description"];
                        echo "<div class='product-box'>";
                        echo "<img src='./media/".$imgsrc."' class='product-box-image'>";
                        echo $name;
                        echo "<br>";
                        echo $description;
                        echo "<br>";
                        echo $price." zł";
                        echo "<br>";
                        echo "<a href='./php/product.php?product_id=".$id_product."'class='link_product'>Buy</a>";
                        echo "</div>";
                }
            }
        ?>
    </main>
    <script src="./js/appear_index.js"></script>
</body>
</html>