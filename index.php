<?php
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
</head>
<body>
    <header>
        <a class="title" href="./index.php"><h1 class="title">Kajstore</h1></a>
        <nav class="nav-header">
            <a href="./index.php">Main</a>
            <a href="./assets/html/download.html">Download</a>
            <a href="./php/login.php">Login</a>
        </nav>
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
                        echo "<a href='./php/product.php?product_id=".$id_product."'>Kup</a>";
                        echo "</div>";
                }
            }
        ?>
    </main>
</body>
</html>