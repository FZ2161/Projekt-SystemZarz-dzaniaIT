<?php
if($_SESSION["zalogowanoJako"]=="admin")  include "admin-menu.php";
echo 
    "<ul> 
        <li> <a href='./pracownik.php'> PRACOWNIK </a> </li>
        <li> <a href='./logowanie.php'> LOGOWANIE </a> </li>
        <li> <a href='./rejestracja.php'> REJESTRACJA </a> </li>
        <li> <a href='./przeglad.php'> PRZEGLĄD </a> </li>
    </ul>";
?>