<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_GET["id_prodotto"]))
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        $_SESSION["risposta_path"] = "../PAGES/ricerca.php";
        header("Location: ../PAGES/ricerca.php");
        exit;
    }
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();

    //bisogna controllare se è già presente nel carrello
    $carrello = getCarrelloByUtente($id_utente);
    foreach ($carrello as $prodotto) {
        if($prodotto->getId_prodotto() == $_GET["id_prodotto"])
        {
            $_SESSION["risposta"] = "Prodotto già presente nel carrello";
            header("Location: ../PAGES/homepage.php");
            exit;
        }
    }


    if(addToFile($pathFileCarrello,$id_utente.";".$_GET["id_prodotto"]))
    {
        $_SESSION["risposta"] = "Prodotto aggiunto al carrello";
        header("Location: ../PAGES/homepage.php");
        exit;
    }
    else
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        header("Location: ../PAGES/homepage.php");
        exit;
    }
    


?>