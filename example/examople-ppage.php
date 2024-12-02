<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kajstore";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }
    echo "Connected successfully";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
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
        
    </main>
</body>
</html>