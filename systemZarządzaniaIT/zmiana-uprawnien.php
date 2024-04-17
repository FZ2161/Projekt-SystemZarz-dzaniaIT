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
    <title>Zmiana uprawnień</title>
</head>
<body>
    <h2>ZMIANA UPRAWNIEŃ</h2>
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
<!-- ------------------------- FORMULARZ ------------------------ -->

    <?php

    if($_SESSION["zalogowanoJako"] != "admin") {
        // Wyświetlenie komunikatu, jeśli użytkownik nie jest zalogowany jako administrator
        echo "<p style='color: red;'>Nie masz uprawnień do zmiany uprawnień użytkowników.</p>";
    } else

    // if(!empty($_POST["noweUprawnienia"]) && !empty($_POST["login"])){
    //     $noweUprawnienia = $_POST["noweUprawnienia"];
    //     $login = $_POST["login"];

        // polaczenie
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $db = "system_zarzadzania_it";

        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $db);

        // Spr połączenia
        if(!$conn){
            echo "<p style='color: red;'>Nie można połączyć się z bazą danych</p>";
        } else {
            $sql1 = "SELECT login FROM users";
            $result = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($result) > 0) {
                echo "<form action='' method='post'>";
                echo "<label for='login'>Wybierz użytkownika:</label><br>";
                echo "<select name='login'>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['login'] . "'>" . $row['login'] . "</option>";
                }
                echo "</select><br><br>";

                // Wybór nowych uprawnień
                echo "<label for='noweUprawnienia'>Nowe uprawnienia:</label><br>";
                echo "<select name='noweUprawnienia'>";
                echo "<option value='admin'>Admin</option>";
                echo "<option value='user'>User</option>";
                echo "<option value='pracownik'>Pracownik</option>";
                echo "</select><br><br>";

                echo "<input type='submit' name='submit' value='Zmień'>";
                echo "</form>";
            } else {
                echo "<p style='color: red;'>Brak użytkowników w bazie danych.</p>";
            }
            
            
            if(isset($_POST['submit'])) {
                $selectedLogin = $_POST['login'];
                $selectedPermissions = $_POST['noweUprawnienia'];

                // zapytanie
                $sql = "UPDATE users SET uprawnienia='$selectedPermissions' WHERE login='$selectedLogin'";
                
                if(mysqli_query($conn, $sql)){
                    echo "<p style='color: green;'>Uprawnienia zmienione pomyślnie</p>";
                } else {
                    echo "<p style='color: red;'>Nie udało się zmienić uprawnień</p>";
                }
            }

            mysqli_close($conn);
        }
    
?>

    </div>
</body>
</html>