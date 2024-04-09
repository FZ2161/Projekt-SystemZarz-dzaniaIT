<?php 
session_start();
if(!isset($_SESSION["zalogowanoJako"])){
    $_SESSION["zalogowanoJako"] = "nie zalogowano";
}


if (isset($_GET["wyloguj"])) {
    $_SESSION["zalogowanoJako"] = "nie zalogowano";
    // Przekierowanie do tej samej strony po wylogowaniu
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
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


    <h2>user</h2>
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
    <div id="user-glowny">
        <div id="lewy">
            <h3>
                <?php
                    if(!empty($_SESSION["zalogowanoJako"])){
                        echo "Zalogowano jako: " . ucfirst($_SESSION["zalogowanoJako"]);
                    } else {
                        echo "Nie zalogowano";
                    }
                ?>
            </h3>

            <form action="" method="get">
                <label for="projekty">Dołącz do projektu:</label>
                <select name="projekty" id="projekty">
                    <option value="">----------</option>
                    <?php
                        $sql = "SELECT * FROM projects";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . "Projekt " . $row['id'] . "</option>";
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Dołącz">  <br><br>
            </form>

            <?php
                if(!empty($_GET["projekty"])){
                    $wybranyProjekt = $_GET["projekty"];
                    $user = $_SESSION["zalogowanoJako"];
                    $sql = "INSERT INTO dolaczeni (project_id, user) VALUES ('$wybranyProjekt', '$user')";

                    if(mysqli_query($conn, $sql)){
                        echo "<p style='color: green;'>Dołączono do projektu</p>";
                    } else {
                        echo "<p style='color: red;'>Nie udało się dołączyć do projektu</p>";

                    }
                }
            ?>

        </div>
        <div id="prawy">
            prawy
        </div>
    </div>

    <?php
    mysqli_close($conn)
    ?>
</body>
</html>