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
    if(!isset($_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["quantità"],$_POST["categoria"]))
    {
        /*header("Location: ../PAGES/aggiungiProdotto.php?messaggio=Si è verificato un errore");
        exit;*/

        $_SESSION["risposta"] = "Si è verificato un errore";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    //controllo se sono vuoti
    if(empty($_POST["nome"]) ||empty($_POST["descrizione"]) ||empty($_POST["prezzo"]) ||empty($_POST["quantità"]))
    {  
        $_SESSION["risposta"] = "Si è verificato un errore";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }






    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------



    //controllo le foto
    if (!isset($_FILES["immagini"])) {
        $_SESSION["risposta"] = "Nessuna immagine selezionata.";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    if(count($_FILES["immagini"]["name"]) == 1 && $_FILES["immagini"]["name"][0] == "")
    {
        $_SESSION["risposta"] = "Nessuna immagine selezionata.";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    





    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------

    //ALTRI CONTROLLI SE CI VENGONO IN MENTE
    //Formato delle stringhe, lunghezza massima titolo e descrizione (20 e 300 caratteri), numero massimo di immagini
    if(strlen($_POST["descrizione"]) > 10)
    {
        $_SESSION["risposta"] = "Descrizione troppo lunga";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

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
        if(!addToFile(PATH_FILE_FOTO,$stringa))
        {
            $_SESSION["risposta"] = "Si è verificato un errore";
            $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
            header("Location: ../PAGES/aggiungiProdotto.php");
            exit;
        }
    }
    $stringa = $prodotto->toCsv();
    if(!addToFile(PATH_FILE_PRODOTTI,$stringa))
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    $_SESSION["risposta"] = "Prodotto inserito correttamente";
    header("Location: ../PAGES/homepage.php");
    exit;

    
    
?>