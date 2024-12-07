<?php
    session_start();
    $id_product = $_GET["product_id"];
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/product.css">
    <link rel="stylesheet" href="../responsive/main.css">
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
    </header>
    <main>
            <?php
                $sql = "SELECT id_product, price, name, photo_path, description FROM products WHERE id_product = ".$id_product;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                            $id_product = $row["id_product"];
                            $imgsrc = $row["photo_path"];
                            $name = $row["name"];
                            $price = $row["price"];
                            $description = $row["description"];
                            echo "<div class='product_box'>";
                                echo "<div class='product_box_img'>";
                                    echo "<img src='../media/".$imgsrc."' class='product_image'>";
                                echo "</div>";
                                echo "<div class='product_box_text'>";
                                    echo "<h1>".$name."</h1>";
                                    echo "<h3>"."Cena: ". $price." zł"."</h3>";
                                    echo "<br>";
                                    echo $description;
                                    echo "<br>";
                                    echo "<a href='../scripts/addtocart.php?product_id=".$id_product."'>Buy</a>";
                                echo "</div>";
                            echo "</div>";
                    }
                }
                ?>
    </main>
</body>
</html>