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
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/variables.css">
</head>
<body>
    <header>
        <a class="title" href="../index.php"><h1 class="title">Kajstore</h1></a>
        <nav class="nav-header">
            <a href="./index.php">Main</a>
            <a href="./php/download.html">Download</a>
            <a href="./php/creator.html">Creator</a>
        </nav>
    </header>
    <main>
        <section class="login">
            <form action="./login.php" method="post">
                <h1>Register</h1>
                <h3>Username:</h3>
                <input type="text" name="username" placeholder="Username">
                <h3>Firstname:</h3>
                <input type="text" name="firstname" placeholder="Firstname">
                <h3>Lastname:</h3>
                <input type="text" name="lastname" placeholder="Lastname">
                <h3>Birthday</h3>
                <input type="date" name="birthdate">
                <h3>E-mail:</h3>
                <input type="email" name="email" placeholder="E-mail">
                <h3>Password:</h3>
                <input type="password" name="password" placeholder="Password">
                <h3>Repeat password:</h3>
                <input type="password" name="rpassword" placeholder="Repeat password">
                <h3>Reset</h3>
                <input type="reset">
                <button type="submit" name="register">Register</button>
            </form>
            <a href="./register.php">Have account?</a>
        </section>
    </main>
</body>
</html>
