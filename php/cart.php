<?php
    $finalprice = 0;
    session_start();
    if(!isset($_SESSION["logged_in"])){ $_SESSION["logged_in"] = false;}
        if(!$_SESSION["logged_in"]){
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
    <title>Cart</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/cart.css">
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
        <section id="left_side">
            <?php
                $id_user = $_SESSION["id_user"];
                $sql = "SELECT carts.id_product, products.price, products.name, products.description, products.photo_path FROM `carts`
                JOIN products ON carts.id_product = products.id_product
                WHERE id_user = $id_user;";

                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $price = $row["price"];
                        $name = $row["name"];
                        $description = $row["description"];
                        $photo_path = $row["photo_path"];
                        $finalprice += $price;
                        echo "<div class='product'>";
                        echo "<img src='../media/".$photo_path."'>";
                        echo "<div class='column'>";
                        echo "<p>$name</p>";
                        echo "<p>$description</p>";
                        echo "<p>Price: $price zł</p>";
                        echo "<a href='../scripts/remove_from_cart.php?id_product=".$row["id_product"]."'>Remove from cart</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No products found.";
                }
            ?>
        </section>
        <section id="right_side">
            <?php
            echo "<h1>"."Total price:". $finalprice. " zł</h1>"
            ?>
            <form action="../scripts/buy.php" method="post" class="pay_form">
                <label for="firtname">Firstname:</label>
                <input type="text" name="firstname" placeholder="First name" require maxlength="100">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" placeholder="Last name" require maxlength="100">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" require maxlength="200">
                <label for="payment">Payment method:</label>
                <select name="payment" require>
                    <option value="bank_transfer">Bank transfer</option>
                    <option value="blik">Blik</option>
                    <option value="paypal">Paypal</option>
                </select>
                <input type="reset" value="Reset 🔄️">
                <input type="submit" value="Buy 🛒">
        </section>
    </main>
    <script src="../js/form_c_block_refresh.js"></script>
    <script src="../js/appear_form.js"></script>
</body>
</html>
