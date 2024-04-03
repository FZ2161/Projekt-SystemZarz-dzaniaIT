<?php 
session_start();
if(!isset($_SESSION["zalogowanoJako"])){
    $_SESSION["zalogowanoJako"] = "nie zalogowano";
}
?>

<?php
if($_SESSION["zalogowanoJako"]=="admin")  include "admin-menu.php";
echo 
    "<ul> 
        <li> <a href='./index.php'> INDEX </a> </li>
        <li> <a href='./logowanie.php'> LOGOWANIE </a> </li>
        <li> <a href='./rejestracja.php'> REJESTRACJA </a> </li>
        <li> <a href='./przeglad.php'> PRZEGLĄD </a> </li>
    </ul>";
?>