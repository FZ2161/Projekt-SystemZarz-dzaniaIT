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
    <title>rejestracja</title>
</head>
<body>
    <h2>REJESTRACJA</h2>
    <div id="menu">
        <?php  // menu
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
    
    <!-- ------------------------------------------------------- -->

    <form action="" method="post">
        <label for='login'>Login:</label>
        <input type='text' id='login' name='login'> <br><br>
        <label for='password'>Hasło:</label>
        <input type='password' id='password' name='password'> <br><br>
        <input type='submit' value='Zarejestruj'>
        </form>

    <?php
    if(!empty($_POST["login"])&&!empty($_POST["password"])){
        $login=$_POST["login"];
        $pass=$_POST["password"];

        function szyfruj_haslo($pass){
            return md5($pass);
        }
        $zaszyfrowane = szyfruj_haslo($pass);
        
        $dbHost="localhost";
        $dbUser="root";
        $dbPassword="";
        $db="system_zarzadzania_it";

        $conn=mysqli_connect($dbHost, $dbUser, $dbPassword, $db);

        if(!$conn){
            echo mysqli_connect_error($conn);
        }

        $sql="INSERT INTO users VALUES ('$login', '$zaszyfrowane', 'user')";


        if(mysqli_query($conn, $sql)){
            echo "<p style='color:green;'>" . "dodano użytkownika" . "</p>" ;
        } else {
            echo "<p style='color:red;'>" . "Nie dodano użytkownika" . "</p>" ;
        }

    } else {
        echo "<p>" . "Aby się zarejestrować wypełnij pola" . "</p>" ;
    }
    ?>


    </div>
</body>
</html>