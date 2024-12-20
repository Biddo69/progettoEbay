<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_POST["categoria"],$_POST["cerca"]))
    {
        header("Location: ../PAGES/homepage.php?messaggio=Si è verificato un errore");
        exit;
    }
    //controlla la categoria   
    if(isset($_SESSION["user"]))
    {
        $utente = $_SESSION["user"];
        $id_utente = $utente->getId_utente();
    }
    else
        $id_utente = -1;
    
    $prodotti = getAllProdottiNotFromUtente($id_utente,$_POST["cerca"],$_POST["categoria"]);
    
    //salvo il risultato nella sessione, vado all'altra pagina che poi stamperà i risultati e dopo cancellerà la variabile di sessione
    $_SESSION["prodotti"] = $prodotti;
    header("Location: ../PAGES/homepage.php");
    exit;
    //echo $_POST["categoria"];
?>