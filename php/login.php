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
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/login.css">
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
        <section class="login">
            <img src="../media/default.png" alt="User" class="default">
            <form action="../scripts/login_script.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="E-mail" require maxlength="200">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" require>
                <button type="submit" name="login">Login</button>
            </form>
            <a href="./register.php">Don't have account?</a>
        </section>
    </main>
    <script src="../js/form_rl_block_refresh.js"></script>
    <script src="../js/appear_form.js"></script>
</body>
</html>
