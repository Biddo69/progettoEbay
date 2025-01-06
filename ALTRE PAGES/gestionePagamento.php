<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_POST["quantità"],$_POST["nome"],$_POST["cognome"],$_POST["mail"],$_POST["città"],$_POST["cap"],$_POST["indirizzo"],$_POST["codice"],$_POST["cvv"],$_POST["scadenza"]))
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/homepage.php");
        exit;
    }
    if(empty($_POST["quantità"]) || empty($_POST["nome"]) || empty($_POST["cognome"]) || empty($_POST["mail"]) || empty($_POST["città"]) || empty($_POST["cap"]) || empty($_POST["indirizzo"]) || empty($_POST["codice"]) || empty($_POST["cvv"]) || empty($_POST["scadenza"]))
    {
        $_SESSION["risposta"] = "Mancano alcuni dati per completare il pagamento";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }

    $prodotto =getProdottoById($_POST["id_prodotto"]);

        //controllo se la quantità è corretta
    if($_POST["quantità"] > $prodotto->getQuantità())
    {
        $_SESSION["risposta"] = "Errore nell'inserimento dei dati (quantità)";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }


    //controllo se nel codice della carta di credito sono presenti delle lettere, controllo anche nel cvv anche se è già input type number
    if(preg_match('/[a-zA-Z]/', $_POST["codice"]) || preg_match('/[a-zA-Z]/', $_POST["cvv"]))
    {
        $_SESSION["risposta"] = "Errore nell'inserimento dei dati";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }

    $oggi = new DateTime('today');
    $dataCarta = DateTime::createFromFormat('Y-m-d', $_POST["scadenza"]);
    if($dataCarta < $oggi)
    {
        $_SESSION["risposta"] = "Si è verificato un errore con la scadenza della carta di credito";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }
    
    //controllo la lunghezza del cvv e del codice
    if((!$_POST["cvv"] >= 100 && $_POST["cvv"] < 1000))
    {
        $_SESSION["risposta"] = "Si è verificato problema con il cvv della carta di credito";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }
    if(strlen($_POST["codice"]) != 16)
    {
        $_SESSION["risposta"] = "Si è verificato problema con il codice della carta di credito";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }

    //controllo il cap
    if(!($_POST["cap"] >= 10000 && $_POST["cap"] < 100000))
    {
        $_SESSION["risposta"] = "CAP non valido";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_POST["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_POST["id_prodotto"]);
        exit;
    }


    //diminuisco la quantità e nel caso lo elimino
    $prodotti = getAllProdotti();
    for ($i=0; $i < count($prodotti); $i++) { 
        if($prodotti[$i]->getId_prodotto() == $_POST["id_prodotto"])
        {
            $id_prodotto = $prodotti[$i]->getId_prodotto();
            $carrello = getAllCarrello();

            $nuovaQuantità = $prodotti[$i]->getQuantità() - $_POST["quantità"];
            if($nuovaQuantità > 0)
            {
                $prodotti[$i]->setQuantità($nuovaQuantità);
            }
            else    	//se non è più presente
            {
                //controllo il carrello
                for ($j=0; $j < count($carrello); $j++) { 
                    if($carrello[$j][1] == $_POST["id_prodotto"])
                        array_splice($carrello,$j,1);
                }
                //elimino il prodotto dal file
                array_splice($prodotti,$i,1); 
                deleteFotoById_prodotto($id_prodotto);
            }

            //se è registrato tolgo dal carrello il prodotto che ha acquistato
            if(isset($_SESSION["user"]))
            {
                $utente = $_SESSION["user"];
                $id_utente = $utente->getId_utente();
                for ($j=0; $j < count($carrello); $j++) { 
                    if($carrello[$j][0] == $id_utente && $carrello[$j][1] == $id_prodotto)
                        array_splice($carrello,$j,1);
                }
            }
            scriviTuttiProdotti($prodotti);
            scriviCarrello($carrello);
        
            break;
        }
    }
    $_SESSION["risposta"] = "Prodotto comprato con successo";
    header("Location: ../PAGES/homepage.php");
    exit;

        

?>