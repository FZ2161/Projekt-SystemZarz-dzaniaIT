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
    <!-- hilight.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"></script>
        
    <title>przeglad</title>
</head>
<body>
    <h2>index</h2>
    <?php include "menu.php"; ?>
    
    <?php
    if(!empty($_SESSION["zalogowanoJako"])){
        echo $_SESSION["zalogowanoJako"];
    } else {
        echo "nie zalogowano";
    }
    ?>

    <!-- Kod HTML, który chcesz podświetlić -->
    <pre>
        <code id="code" class="xml">
            &lt;p&gt;
                Hello World!
            &lt;/p&gt;
            
        </code>
    </pre>

    <script>
        // Highlight
        document.addEventListener("DOMContentLoaded", function(event) {
            // pobranie elementu z kodem
            const codeElement = document.getElementById('code');
            // podswietlenie
            hljs.highlightElement(codeElement);
        });
    </script>
</body>
</html>
