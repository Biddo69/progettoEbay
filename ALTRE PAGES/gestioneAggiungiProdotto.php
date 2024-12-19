<?php    

require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: ../PAGES/login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }


    //controllo se i parametri esistono
    if(!isset($_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["quantità"],$_POST["categoria"],$FILES["immagini"]))
    {
        header("Location: ../PAGES/aggiungiProdotto.php?messaggio=Si è verificato un errore");
        exit;
    }

    //controllo se sono vuoti
    if(empty($_POST["nome"]) ||empty($_POST["descrizione"]) ||empty($_POST["prezzo"]) ||empty($_POST["quantità"]))
    {
        header("Location: aggiungiProdotto.php?messaggio=Si è verificato un errore");
        exit;
    }

    //ALTRI CONTROLLI SE CI VENGONO IN MENTE
    //Formato delle stringhe, lunghezza massima titolo e descrizione (20 e 300 caratteri), numero massimo di immagini
    //salvo

    $id_prodotto = getNextID_prodotto();
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();
    $prodotto = new prodotto($id_prodotto,$_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["quantità"],$id_utente,$_POST["categoria"]);



    //salvo le immagini
    $oldPath = [];
    foreach ($_FILES["immagini"]["tmp_name"] as $value) {
        $oldPath[] = $value;
    }
    $newPath = [];
    foreach ($_FILES["immagini"]["name"] as $value) {
        $newPath[] = "../FOTO/".$value;
    }

    for ($i=0; $i < count($oldPath); $i++) { 
        move_uploaded_file($oldPath[$i],$newPath[$i]);
        $foto = new foto($id_prodotto,$newPath[$i]);
        $stringa = $foto->toCSV();
        if(!addToFile($pathFileFoto,$stringa))
        {
            echo "errore 1";
        }
    }
    $stringa = $prodotto->toCsv();
    if(!addToFile($pathFileProdotti,$stringa))
    {
        echo "errore 2";
    }
    
    
?>