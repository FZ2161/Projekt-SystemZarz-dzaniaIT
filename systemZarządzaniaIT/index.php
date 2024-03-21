<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>index</title>
</head>
<body>
    <h2>index</h2>
    <?php
    include "menu.php";
    
    if(!empty($_SESSION["zalogowanoJako"])){
        echo $_SESSION["zalogowanoJako"];
    } else {
        echo "nie zalogowano";
    }
    ?>

    <form action="" method="get">
        <input style="display: none;" type="text" value="wyloguj" name="wyloguj">
        <input type="submit" value="wyloguj">
    </form>

    <?php
    if(isset($_GET["wyloguj"])){
        $_SESSION["zalogowanoJako"]="nie zalogowano";
        echo "wylogowano";
    }
    ?>
    
</body>
</html>