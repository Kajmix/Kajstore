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
    <title>Edit product</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/edit_product.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/edit_product.css">
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
                        echo "<img src='../media/".$imgsrc."' class='product-box-image'>";
                        echo $name;
                        echo "<br>";
                        echo $description;
                        echo "<br>";
                        echo $price." zł";
                        echo "<br>";
                        echo "<a href='./edit_edit_product.php?id_product=".$id_product."'>Edit</a>";
                        echo "<a href='../scripts/delete_product.php?id_product=".$id_product."'>Delete</a>";
                        echo "</div>";
                }
            }
        ?>
</main>
</body>
</html>