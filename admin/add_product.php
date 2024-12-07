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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/add_product.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/add_product.css">
</head>
<body>
<header>
    <a class="title" href="../index.php"><h1 class="title">Kajstore</h1></a>
    <nav class="nav-header">
        <a href="../index.php">Main</a>
        <a href="./cart.php">Cart</a>
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
    <form action="../scripts/add_product_sc.php" method="post">
        <label for="product_name">Product name:</label>
        <input type="text" id="product_name" name="product_name">
        <label for="product_price">Product price:</label>
        <input type="number" id="product_price" name="product_price">
        <label for="product_description">Product description:</label>
        <textarea id="product_description" name="product_description"></textarea>
        
        <label for="product_image">Product image:</label>
        <select id="product_image" name="product_image">
            <?php
            $image_dir = '../media/';
            $images = scandir($image_dir);
            foreach($images as $image) {
                if($image != '.' && $image != '..') {
                    echo "<option value='$image'>$image</option>";
                }
            }
            ?>
        </select>
        
        <label for="product_file">Product file:</label>
        <select id="product_file" name="product_file">
            <?php
            $file_dir = '../download/';
            $files = scandir($file_dir);
            foreach($files as $file) {
                if($file != '.' && $file != '..') {
                    echo "<option value='$file'>$file</option>";
                }
            }
            ?>
        </select>
        
        <input type="submit" value="Add product">
    </form>
</main>
</body>
</html>