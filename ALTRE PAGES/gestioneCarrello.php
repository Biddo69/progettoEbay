<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    } 
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();  

    if(isset($_POST["eliminaProdotto"]))
    {
        //ottengo tutto il carrello
        //controllo se è uguale l'id dell'utente e del prodotto
        //salvo quello che mi interessa
        //riscrivo il file
        $carrello = getAllCarrello();
        $nuovoCarrello = [];
        foreach ($carrello as $riga) {
            if(!($riga[0] == $id_utente && $riga[1] == $_POST["eliminaProdotto"]))
                $nuovoCarrello[] = $riga;
        }
        scriviCarrello($nuovoCarrello);
        $_SESSION["risposta"] = "Prodotto rimosso dal carrello";
        $_SESSION["risposta_path"] = "../PAGES/carrello.php";
        header("Location: ../PAGES/carrello.php");
        exit;
    }    

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


    if(addToFile(PATH_FILE_CARRELLO,$id_utente.";".$_GET["id_prodotto"]))
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