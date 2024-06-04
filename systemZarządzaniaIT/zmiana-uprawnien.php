<?php 
session_start();
if(!isset($_SESSION["zalogowanoJako"])){
    $_SESSION["zalogowanoJako"] = "nie zalogowano";
}



?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>logowanie</title>
</head>
<body>
    <h2>LOGOWANIE</h2>
    <div id="menu">
        <?php 
            if($_SESSION["zalogowanoJako"] == "admin") {
                include "admin-menu.php";
            } else if ($_SESSION["zalogowanoJako"] == "user"){
                include "user-menu.php";
            } else if ($_SESSION["zalogowanoJako"] == "pracownik"){
                include "pracownik-menu.php";
            } else { 
                include "nMenu.php";
            }
        ?>
    </div>
    <div id="glowny">
    
    <?php

        
        echo "
        <form action='' method='post'>
        <label for='login'>Login:</label><br><br>
        <input type='text' id='login' name='login'> <br><br>

        <label for='upr'>Nowe uprawnienia:</label><br><br>
        <input type='text' id='upr' name='upr'> <br><br>

        <input type='submit' value='Zatwierdź'>
        </form>
        ";
        
        
        if(isset($_POST["login"])&&isset($_POST["upr"])){
            $login=$_POST["login"];
            $upr=$_POST["upr"];

            $dbHost="localhost";
            $dbUser="root";
            $dbPassword="";
            $db="system_zarzadzania_it";

            $conn=mysqli_connect($dbHost, $dbUser, $dbPassword, $db);

            if(!$conn){
                echo "err: " . mysqli_connect_error($conn);
            }

            $sql="UPDATE `users` SET `uprawnienia`='$upr' WHERE login = '$login'";
            
            if(mysqli_query($conn, $sql)){
                echo "<br> <p style='color: green;'>Pomyślnie zaktualizowano uprawnienia</p>";
            } else {
                echo "<p style='color: red;'>Nie udało się zaktualizować uprawnień</p>";
            }
        } else {
            echo "<p>Nie udało się zaktualizować danych</p>";
        }

    
       ?>
 </div>

</body>
</html>