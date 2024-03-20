<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>rejestracja</title>
</head>
<body>
    <h2>REJESTRACJA</h2>
    <?php
    include "menu.php";
    ?>
    
    <!-- ------------------------------------------------------- -->

    <form action="" method="post">
        <input type="text" name="login">
        <input type="text" name="password">
        <input type="submit" value="zarejestruj">
    </form>

    <?php
    if(!empty($_POST["login"])&&!empty($_POST["password"])){
        $login=$_POST["login"];
        $password=$_POST["password"];
        echo 1;
    } else {
        echo 0;
    }
    ?>
</body>
</html>