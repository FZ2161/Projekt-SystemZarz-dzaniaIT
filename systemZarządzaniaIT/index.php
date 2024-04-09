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
    <title>wyloguj</title>
</head>
<body>
    <h2>WYLOGUJ</h2>
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

<?php
    if(isset($_GET["wyloguj"])){
        $_SESSION["zalogowanoJako"]="nie zalogowano";
    }
    
    if(!empty($_SESSION["zalogowanoJako"])){
        echo $_SESSION["zalogowanoJako"];
    } else {
        echo "nie zalogowano";
    }
    ?>

    <form action="" method="get">
        <input style="display: none;" type="text" value="wyloguj" name="wyloguj">
        <input type="submit" value="wyloguj">
    </form>

    <?php
    // if(isset($_GET["wyloguj"])){
    //     $_SESSION["zalogowanoJako"]="nie zalogowano";
    //     echo "wylogowano";
    // }
    ?>
    
</body>
</html>