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
    <title>Admin Role</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/variables.css">
    <link rel="stylesheet" href="../css/rcadmin.css">
    <link rel="stylesheet" href="../responsive/main.css">
</head>
<body>
    <header>
        <a class="title" href="../index.php"><h1 class="title">Kajstore</h1></a>
        <nav class="nav-header">
            <a href="../index.php">Main</a>
            <a href="../php/cart.php">Cart</a>
            <a href="../php/login.php">Login</a>
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
    echo "<a href = '../php/user.php?user_id=". $_SESSION['id_user']."'>". $_SESSION["first_name"]. " ". $_SESSION["last_name"]. "</a>";
}
?>
</div>
</header>
<main>
    <?php
        $sql = "SELECT first_name, last_name, id_user, is_admin FROM users;";
        $result = $conn->query($sql);

        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Role</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row["id_user"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>";
                echo ($row["is_admin"] == 1) ? "Admin" : "User";
                echo "</td>";
                echo "<td><a href='../scripts/charange_admin.php?user_id=" . $row["id_user"] . "&user_rank=" . $row["is_admin"] . "'>Change admin rank</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
    ?>
</main>
</body>
</html>
