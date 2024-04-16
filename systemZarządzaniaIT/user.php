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
    <link rel="stylesheet" href="prism.css">
    <link rel="stylesheet" href="user.css">
    <title>index</title>
</head>
<body>
    <header data-plugin-header="line-numbers"></header>


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


    <h2>USER</h2>
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
                        echo "";
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
                </select><br><br>
                <input type="submit" value="Dołącz">  <br><br>
            </form>
                        
            <?php
            ######################   Dodawanie do projektu   ######################   
                if (!empty($_GET["projekty"])) {
                    $wybranyProjekt = $_GET["projekty"];
                    $user = $_SESSION["zalogowanoJako"];
                
                    // Sprawdzenie, czy użytkownik już jest dołączony do projektu
                    $check_query = "SELECT * FROM dolaczeni WHERE project_id = '$wybranyProjekt' AND user = '$user'";
                    $check_result = mysqli_query($conn, $check_query);
                
                    if (mysqli_num_rows($check_result) > 0) {
                        echo "<p style='color: red;'>Już jesteś dołączony do tego projektu</p>";
                    } else if ($_SESSION["zalogowanoJako"]=="user"){
                        // Dodanie użytkownika do projektu
                        $insert_query = "INSERT INTO dolaczeni (project_id, user) VALUES ('$wybranyProjekt', '$user')";
                
                        if (mysqli_query($conn, $insert_query)) {
                            echo "<p style='color: green;'>Dołączono do projektu</p>";
                        } else {
                            echo "<p style='color: red;'>Nie udało się dołączyć do projektu</p>";
                        }
                    }
                }
            ?>

        </div>
        <div id="prawy">
            <div class="border" id="user-gora">
                <div id="userGL">
                    <?php
                    $sql="SELECT DISTINCT dolaczeni.user, projects.id, projects.kod FROM projects JOIN dolaczeni ON projects.id = dolaczeni.project_id";

                    $results = mysqli_query($conn, $sql);
                    // // //  FORMULARZ WYBIERAJĄCY PROJEKT  // // //

                    if(mysqli_num_rows($results)>0){
                        echo "<form action='' method='post'>";
                        echo "<label for='projekt'>Wybierz projekt: </label>";
                        echo "<select name='projekt'>";
                        while($row = mysqli_fetch_assoc($results)) {
                            echo "<option value='" . $row['id'] . "'";
                            // Ustawienie domyślnej wartości w inpucie dla wyboru projektu
                            if(isset($_POST['projekt']) && $_POST['projekt'] == $row['id']) {
                                echo " selected";
                            }
                            echo ">" . ("Projekt ") . $row['id'] . "</option>";
                        }



                        $kod = $row["kod"];
                        echo "</select><br><br>";
                        echo "<input type='submit' value='Zobacz kod projektu'>";
                    } else{
                        echo "<p>Aby zobaczyć kod dołącz do projektu</p>";
                    }
                    ?>
                </div>

            </div>
            <div>
                <pre class="line-numbers" data-line="1"><code class="language-php">
                    <?php
                    ######################   Wyświetlanie kodu   ######################   
                    if(!empty($_POST["projekt"])){
                    $id = $_POST["projekt"];
                        $sql="SELECT DISTINCT kod from projects where id = $id";
                        $results = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($results)) {
                            echo $row["kod"];
                        }
                    } else {
                        echo "#####  TUTAJ ZOSTANIE WYŚWIETLONY KOD PROJEKTU  #####";
                    }
                    ?>
                </code></pre>
            </div>

            <div class="border">
                    <h3>Komentarze</h3>
                    <?php
                    ////////////////////////////////////  komentarze
                    $id = isset($_POST["projekt"]) ? $_POST["projekt"] : 0;
                    $sql="SELECT DISTINCT * FROM comments WHERE `project-id` = $id";
                    $results = mysqli_query($conn, $sql);
                    if($id>0){
                        echo "<div id='comment_form'>
                            <h4><i>Dodaj komentarz:</i></h4><br>
                            <form action='user.php' method='POST'>
                                <label> linia: </label>
                                <input type='number' name='line' id='line'>
                                <label> treść: </label>
                                <input type='text' name='value' id='value'>
                                <input type='submit' value='Dodaj komentarz'>
                            </form>
                            </div> <br>";
                    }
                    
                    if(mysqli_num_rows($results)>0){
                        while($row = mysqli_fetch_assoc($results)) {
                            $linia = $row['line'];
                        
                            echo "<div class='komentarz'> <h4>";
                            echo "komentarz do linii: $linia";
                            echo "</h4>";
                            echo "<p>";
                            echo $row["tresc"];
                            echo "</p></div>";
                            ///////////////////////////////////////////// dodać header refresh
                        }
                    } else{
                        echo "<p><i>Aby zobaczyć komentarze wyświetl kod projektu</i></p>";
                    }

                    if(!empty($_POST["line"]) && !empty($_POST["value"])){
                        $line = $_POST["line"];
                        $value = $_POST["value"];
                        $zalogowanoJako = $_SESSION["zalogowanoJako"];
                        $sql = "INSERT INTO comments (`project-id`,user,tresc,line) VALUES ('$id','$zalogowanoJako','$value','$line')";

                        if (mysqli_query($conn, $sql)) {
                            echo "<p style='color: green;'>Dodano komentarz</p>";
                            
                        } else {
                            echo "<p style='color: red;'>Nie udało się dodać komentarza</p>";
                        }

                    }

                    ?>
            </div>
        </div>
    </div>

    <?php
    mysqli_close($conn)
    ?>
    <script src="prism.js"></script>
</body>
</html>