<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_GET["id_prodotto"]))
    {
        header("Location: ../PAGES/ricerca.php?messaggio=Si è verificato un erroree");
        exit;
    }
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();

    //bisogna controllare se è già presente nel carrello
    if(addToFile($pathFileCarrello,$id_utente.";".$_GET["id_prodotto"]))
    {
        header("Location: ../PAGES/ricerca.php?messaggop=prodotto aggiunto al carrello");
        exit;
    }
    else
    {
        header("Location: ../PAGES/ricerca.php?messaggio=Si è verificato un errore");
        exit;
    }


?>