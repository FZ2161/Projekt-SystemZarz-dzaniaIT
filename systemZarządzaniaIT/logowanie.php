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
    if($_SESSION["zalogowanoJako"]=="nie zalogowano" || empty($_SESSION["zalogowanoJako"])){
        
        echo "
        <form action='' method='post'>
        <label for='login'>Login:</label>
        <input type='text' id='login' name='login'> <br><br>
        <label for='password'>Hasło:</label>
        <input type='password' id='password' name='password'> <br><br>
        <input type='submit' value='Zaloguj'>
        </form>
        ";
        
        
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
                echo "err: " . mysqli_connect_error($conn);
            }

            $sql="SELECT * FROM users WHERE login='$login' && password='$zaszyfrowane'";

            $results=mysqli_query($conn, $sql);

            if(mysqli_num_rows($results)>0){
                while($row=mysqli_fetch_assoc($results)){
                $_SESSION["zalogowanoJako"]=$row["uprawnienia"];  //zapis zmiennej zalogowano jako:
                echo "zalogowano jako: ". $_SESSION["zalogowanoJako"];
                }
                header("Location: {$_SERVER['PHP_SELF']}");
                exit;
            } else{
                echo "<p>niepoprawne dane</p>";
            }

        } else {
            echo "<p>podaj wszystkie dane</p>";
        }
    } else {
        echo "
        <form action='' method='get'>
            <input style='display: none;' type='text' value='wyloguj' name='wyloguj'>
            <input type='submit' value='wyloguj'> <br><br>
        </form>
        ";

        
        if(isset($_GET["wyloguj"])){
            $_SESSION["zalogowanoJako"]="nie zalogowano";
            header("Location: {$_SERVER['PHP_SELF']}");
            exit;
        }
        
        if(!empty($_SESSION["zalogowanoJako"])){
            echo "zalogowano jako: " . $_SESSION["zalogowanoJako"];
        } else {
            echo "nie zalogowano";
        }
        
        if(!isset($_SESSION["zalogowanoJako"])){
            $_SESSION["zalogowanoJako"] ="nie zalogowano";
       }
    }
       ?>
 </div>

</body>
</html>