<?php    

require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }


    //controllo se i parametri esistono
    if(!isset($_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["quantità"],$_POST["categoria"],$_POST["immagini"]))
    {
        header("Location: aggiungiProdotto.php?messaggio=Si è verificato un errore");
        exit;
    }

    //controllo se sono vuoti
    /*if(empty($_POST["nome"]) ||empty($_POST["descrizione"]) ||empty($_POST["prezzo"]) ||empty($_POST["quantità"]) ||empty($_POST["immagini"]))
    {
        header("Location: aggiungiProdotto.php?messaggio=Si è verificato un errore");
        exit;
    }*/

    //ALTRI CONTROLLI SE CI VENGONO IN MENTE
    //Formato delle stringhe, lunghezza massima titolo e descrizione (20 e 300 caratteri), numero massimo di immagini
    //salvo

    $id_prodotto = getNextID_prodotto();
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();
?>