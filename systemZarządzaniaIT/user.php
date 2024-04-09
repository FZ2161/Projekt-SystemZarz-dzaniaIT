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
    <h2>user</h2>
    <div id="menu">
        <?php 
            if($_SESSION["zalogowanoJako"] == "admin") {
                include "admin-menu.php";
            } else if ($_SESSION["zalogowanoJako"] == "user" || $_SESSION["zalogowanoJako"] == "pracownik"){
                include "menu.php";
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
                    <option value="1">Projekt 1</option>
                    <option value="2">Projekt 2</option>
                    <option value="3">Projekt 3</option>
                </select>
                <input type="submit" value="Dołącz">
            </form>

        </div>
        <div id="prawy">
            prawy
        </div>
    </div>

    
</body>
</html>