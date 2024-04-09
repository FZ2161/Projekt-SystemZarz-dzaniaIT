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
    <link rel="stylesheet" href="prism.css">
        
    <title>przeglad</title>
</head>
<body >
    <header data-plugin-header="line-numbers"></header>
    <h2>index</h2>
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
    if(!empty($_SESSION["zalogowanoJako"])){
        echo $_SESSION["zalogowanoJako"];
    } else {
        echo "nie zalogowano";
    }
    ?>

    <!-- Kod HTML, który chcesz podświetlić -->
    
    <pre class="line-numbers" data-line="1"><code class="language-php">
        &lt;?php
        // kod php
        echo "Hello, World!";
        ?>
    </code></pre>


<script src="./prism.js"></script>
</body>
</html>
