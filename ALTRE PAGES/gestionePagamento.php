<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_GET["quantità"],$_GET["nome"],$_GET["cognome"],$_GET["mail"],$_GET["città"],$_GET["cap"],$_GET["indirizzo"],$_GET["codice"],$_GET["cvv"],$_GET["scadenza"]))
    {
        $_SESSION["risposta"] = "Mancano alcuni dati per completare il pagamento";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_GET["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_GET["id_prodotto"]);
        exit;
    }
    if(empty($_GET["quantità"]) || empty($_GET["nome"]) || empty($_GET["cognome"]) || empty($_GET["mail"]) || empty($_GET["città"]) || empty($_GET["cap"]) || empty($_GET["indirizzo"]) || empty($_GET["codice"]) || empty($_GET["cvv"]) || empty($_GET["scadenza"]))
    {
        $_SESSION["risposta"] = "Mancano alcuni dati per completare il pagamentoo";
        $_SESSION["risposta_path"] = "../PAGES/compra.php";
        $_SESSION["id_prodotto"] = $_GET["id_prodotto"];
        header("Location: ../PAGES/compra.php?id_prodotto=".$_GET["id_prodotto"]);
        exit;
    }

    //controlli vari


    //diminuisco la quantità e nel caso lo elimino
    $prodotti = getAllProdotti();
    for ($i=0; $i < count($prodotti); $i++) { 
        if($prodotti[$i]->getId_prodotto() == $_GET["id_prodotto"])
        {
            $id_prodotto = $prodotti[$i]->getId_prodotto();
            $carrello = getAllCarrello();

            $nuovaQuantità = $prodotti[$i]->getQuantità() - $_GET["quantità"];
            if($nuovaQuantità > 0)
            {
                $prodotti[$i]->setQuantità($nuovaQuantità);
            }
            else    	//se non è più presente
            {
                //controllo il carrello
                for ($i=0; $i < count($carrello); $i++) { 
                    if($carrello[$i][1] == $_GET["id_prodotto"])
                        array_splice($carrello,$i,1);
                }
                //elimino il prodotto dal file
                array_splice($prodotti,$i,1); 
                deleteFotoById_prodotto($id_prodotto);

            }


            //devo controllare se l'utente è registrato
            //se è registrato tolgo il prodotto che ha acquistato
            if(isset($_SESSION["user"]))
            {
                $utente = $_SESSION["user"];
                $id_utente = $utente->getId_utente();
                for ($i=0; $i < count($carrello); $i++) { 
                    if($carrello[$i][0] == $id_utente)
                        array_splice($carrello,$i,1);
                }
            }
            scriviTuttiProdotti($prodotti);
            scriviCarrello($carrello);
        
            
        }
    }
    $_SESSION["risposta"] = "Prodotto comprato con successo";
    header("Location: ../PAGES/homepage.php");
    exit;

    //gestione carrello
        
        //ottengo tutto il contenuto del carrello
        //controllo ogni riga
            //vedo se l'id del prodotto di una riga è uguale a $_GET["id_prodotto"]
                //in questo caso controllo la quantità e la modifico o lo elimino

?>