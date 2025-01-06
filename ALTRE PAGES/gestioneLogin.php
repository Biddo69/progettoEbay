<?php
    require_once("gestioneFile.php");    
    if(!isset($_SESSION))
        session_start();


    //controllo se i parametri esistono    
    if(!isset($_POST["mail"],$_POST["password"]))
    {
        header("Location: ../PAGES/login.php?messaggio=si è verificato un errore");
        exit;
    }    

    //controllo se i parametri sono vuoti    
    if(empty($_POST["mail"]) || empty($_POST["password"]))
    {
        header("Location: ../PAGES/login.php?messaggio=si è verificato un errore");
        exit;
    }

    //controllo se sono giuste le credenziali
    $utenti = getAllUtenti();
    foreach ($utenti as $user) { 
        if($user->isEqual($_POST["mail"],$_POST["password"]))
        {
            $_SESSION["user"] = $user;
            header("Location: ../PAGES/homepage.php");
            exit;
        }
    }

    //se non trova corrispondenza con nessun utente
    header("Location: ../PAGES/login.php?messaggio=credenziali errate");
    exit;


?>