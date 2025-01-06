<?php
    if(!isset($_SESSION))
        session_start();

    require_once("gestioneFile.php");    

    if(!isset($_POST["nome"],$_POST["cognome"],$_POST["residenza"],$_POST["mail"],$_POST["password"],$_POST["confermaPassword"]))   
    {
        header("Location: ../PAGES/registrati.php?messaggio=si è verificato un errore");
        exit;
    } 
    if(empty($_POST["nome"]) || empty($_POST["cognome"]) || empty($_POST["residenza"]) || empty($_POST["mail"]) || empty($_POST["password"]) || empty($_POST["confermaPassword"]))
    {
        header("Location: ../PAGES/registrati.php?messaggio=si è verificato un errore");
        exit;
    }

  

    if($_POST["password"] != $_POST["confermaPassword"])
    {
        header("Location: ../PAGES/registrati.php?messaggio=le password non corrispondono");
        exit;
    }

    //controllo se la mail è già in uso
    $utenti = getAllUtenti();
    foreach ($utenti as $user) {
        if($user->getMail() == $_POST["mail"])
        {
            header("Location: ../PAGES/registrati.php?messaggio=email già in uso");
            exit;
        }
    }

    //controllo la foto
    if(isset($_FILES["foto"]) && $_FILES['foto']['error'] === UPLOAD_ERR_OK)
    {
        $oldPath = $_FILES["foto"]["tmp_name"];
        $newPath = "../FOTO/".$_FILES["foto"]["name"];
        move_uploaded_file($oldPath,$newPath);
    }
    else
    {
        $newPath = "../FOTO/user.png";
    }

    //registro l'utente
    $id = getNextId_utente();
    $newUtente = new utente($id,$_POST["nome"],$_POST["cognome"],$_POST["mail"],$_POST["password"],$newPath,$_POST["residenza"]);
    $toCSV = $newUtente->toCsv();
    if(!addToFile(PATH_FILE_UTENTI,$toCSV))
    {
        header("Location: ../PAGES/registrati.php?messaggio=si è verificato un errore durante la registrazione");
        exit;
    } 
    else
    {
        $_SESSION["user"] = $newUtente;
        header("Location: ../PAGES/homepage.php");
        exit;
    }

