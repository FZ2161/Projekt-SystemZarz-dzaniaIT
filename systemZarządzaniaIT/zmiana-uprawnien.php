<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>index</title>
</head>
<body>
    <div id="menu">
        <h2>ZMIANA UPRAWNIEŃ</h2>
        <?php 
            include "menu.php";
        ?>
    </div>

    <div id="glowny">
<!-- ------------------------- FORMULARZ ------------------------ -->
    <form  action="" method="post">
        <label for="login">login: </label>
        <br>
        <input type="text" name="login">
        <br>
        <br>
        <label for="noweUprawnienia">Nowe uprawnienia: </label>
        <br>
        <input type="text" name="noweUprawnienia">
        <input type="submit" value="zmień">
    </form>

<?php
    if(!empty($_POST["noweUprawnienia"])&&!empty($_POST["login"])){
        $noweUprawnienia=$_POST["noweUprawnienia"];
        $login=$_POST["login"];

        #######  Połączenie z bazą  ###########
        $dbHost="localhost";
        $dbUser="root";
        $dbPassword="";
        $db="system_zarzadzania_it";

        $conn=mysqli_connect($dbHost, $dbUser, $dbPassword, $db);

        if(!$conn){
            echo "<p style='color: red;'>nie zmieniono</p>";
        }

        $sql="UPDATE users SET uprawnienia='$noweUprawnienia' WHERE 'login' = '$login'";

        
        if($noweUprawnienia != "admin" || $noweUprawnienia = !"user" || $noweUprawnienia = !"pracownik"){
            echo "<p style='color: red;'>nie zmieniono</p>";
        }
        else if (mysqli_query($conn, $sql)){
            echo "<p style='color: green;'>zmieniono</p>";
        }

    }
?>
    </div>
</body>
</html>