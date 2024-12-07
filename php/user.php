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
    <title>User</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/user_info.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../responsive/main.css">
    <link rel="stylesheet" href="../responsive/user.css">
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
        $id_user = $_GET["user_id"];
        $sqluser = "SELECT first_name, last_name, birthdate, photo_path, is_admin, email, created_at FROM `users` WHERE id_user = $id_user;";
        $result = $conn->query($sqluser);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $birthdate = $row["birthdate"];
                $photo_path = $row["photo_path"];
                $is_admin = $row["is_admin"];
                $email = $row["email"];
                $created_at = $row["created_at"];

                echo "<div class='user_info'>";
                echo "<div class='left_user_info'>";
                echo "<img src='../media/$photo_path' class='user_info_image'>";
                echo "</div>";
                echo "<div class='right_user_info'>";
                if($is_admin){
                    echo "<p>👑Admin👑</p>";
                }
                echo "<h2>$first_name $last_name</h2>";
                echo "<p>Birthdate: $birthdate</p>";
                echo "<p>Created at: $created_at</p>";
                echo "<button onclick='showemail()'>Show email</button>";
                echo "<a href='bought_products.php?user_id=$id_user'>Bought products</a>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </main>
    <script>
        function showemail(){
            alert("Your email is: <?php echo $email; ?>");
        }
    </script>
</body>
</html>