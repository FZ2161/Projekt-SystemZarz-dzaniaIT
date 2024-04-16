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
    <link rel="stylesheet" href="pracownik.css">
    <title>Panel pracownika</title>
</head>
<body>
    <h2>PRACOWNIK</h2>

    <?php
         $dbHost="localhost";
         $dbUser="root";
         $dbPassword="";
         $db="system_zarzadzania_it";
 
         $conn=mysqli_connect($dbHost, $dbUser, $dbPassword, $db);
 
         if(!$conn){
             echo "Nie można połączyć się z bazą danych";
         }
    ?>

    <!-- --------------------  MENU  -------------------- -->
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
        <!-- <textarea id="kod_php" name="kod_php" rows="20" cols="50"></textarea><br><br> -->
        <div id="lewy">
            
            <div id="utworz">
                <h2>
                    Utwórz projekt
                </h2>
            </div>

            <div id="edytuj">
                <h2>
                    Edytuj projekt
                </h2>
                <?php
                #####################  Wybór projektu i formularz  #####################

                    $sql="SELECT DISTINCT dolaczeni.user, projects.id, projects.kod FROM projects JOIN dolaczeni ON projects.id = dolaczeni.project_id";

                    $results = mysqli_query($conn, $sql);
                    // // //  FORMULARZ WYBIERAJĄCY PROJEKT  // // //

                    if(mysqli_num_rows($results)>0){
                        echo "<form action='' method='post'>";
                        echo "<label for='projekt'>Wybierz projekt: </label>";
                        echo "<select name='projekt'>";
                        echo "<option value='0'>Pusta</option>";
                        while($row = mysqli_fetch_assoc($results)) {
                            echo "<option value='" . $row['id'] . "'>" . "Projekt " . $row['id'] . "</option>";
                        }
                        $kod = $row["kod"];
                        echo "</select><br><br>";
                        echo "<input type='submit' value='Edytuj projekt'>";
                    } else{
                        echo "<p>Brak projektów. Aby edytować utwórz nowy projekt.</p>";
                    }
                    ?>

            </div>

        </div>
        <div id="prawy">
            <?php
                if(!empty($_POST["projekt"])){
                    $id = $_POST["projekt"];
                    echo "<h1>Edytowanie projektu</h1>";
                        $sql="SELECT DISTINCT kod from projects where id = $id";
                        $results = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($results)) {
                            echo "<form action='' method='post'>";
                            echo "<textarea id='kod' name='kod' rows='20' cols='50'>";
                            echo $row["kod"];
                            echo "</textarea><br><br>";
                            echo "<input type='submit' value='Zatwierdź zmiany'>";
                        }
                    } else {
                        echo "";
                    }

                if(isset($_POST["kod"])){
                    $kod = $_POST["kod"];
                    $sql = "UPDATE projects SET kod = '$kod' WHERE id = $id";

                    if(mysqli_query($conn, $sql)){
                        echo "<p style='background-color: green;'>Pomyślnie zaktualizowano kod</p>";
                    } else {
                        echo "<p style='background-color: red;'>Nie udało się zaktualizować kodu</p>";
                    }
                }
            ?>
        </div>
    </div>

    <?php
    mysqli_close($conn)
    ?>
</body>
</html>