<?php 
session_start();
if(!isset($_SESSION["zalogowanoJako"])){
    $_SESSION["zalogowanoJako"] ="nie zalogowano";
}

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

    
    
</body>
</html>