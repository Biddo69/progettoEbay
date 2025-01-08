<?php
   require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
       session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }
?>