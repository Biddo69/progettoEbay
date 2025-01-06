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

    //controllo le foto
    if (!isset($_FILES["immagini"])) {
        $_SESSION["risposta"] = "Nessuna immagine selezionata";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    if(count($_FILES["immagini"]["name"]) == 1 && $_FILES["immagini"]["name"][0] == "")
    {
        $_SESSION["risposta"] = "Nessuna immagine selezionata";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    //controllo l'estensione delle immagini
    foreach ($_FILES["immagini"]["name"] as $value) {
        $estensione = strtolower(pathinfo($value, PATHINFO_EXTENSION));
        if(!($estensione == "jpg" || $estensione == "jpeg" || $estensione == "png"))
        {
            $_SESSION["risposta"] = "Estensione delle immagini non valida";
            $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
            header("Location: ../PAGES/aggiungiProdotto.php");
            exit;
        }
    }


   //controlla la lunghezza della descrizione
    if(strlen($_POST["descrizione"]) > 150)
    {
        $_SESSION["risposta"] = "Descrizione troppo lunga";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }

    //controllo il numero di immagini caricate
    if(count($_FILES["immagini"]["name"]) > 5)
    {
        $_SESSION["risposta"] = "Non puoi caricare troppe immagini (max 5)";
        $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
        header("Location: ../PAGES/aggiungiProdotto.php");
        exit;
    }


    $id_prodotto = getNextID_prodotto();
    $utente = $_SESSION["user"];
    $id_utente = $utente->getId_utente();
    $prodotto = new prodotto($id_prodotto,$_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["quantità"],$id_utente,$_POST["categoria"]);



    //salvo le immagini
    $cont = 0;
    foreach ($_FILES["immagini"]["tmp_name"] as $value) {
        $newPath =  "../FOTO/".$prodotto->getId_prodotto()."_".$cont.".png";
        move_uploaded_file($value,$newPath);
        $foto = new foto($id_prodotto,$newPath);
        $stringa = $foto->toCSV();
        if(!addToFile(PATH_FILE_FOTO,$stringa))
        {
            $_SESSION["risposta"] = "Si è verificato un errore";
            $_SESSION["risposta_path"] = "../PAGES/aggiungiProdotto.php";
            header("Location: ../PAGES/aggiungiProdotto.php");
            exit;
        }
        $cont++;
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