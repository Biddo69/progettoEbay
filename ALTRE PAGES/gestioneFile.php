<?php
    require_once("../CLASSES/utente.php");
    require_once("../CLASSES/prodotto.php");
    require_once("../CLASSES/foto.php");
    require_once("../CLASSES/categoria.php");

    $pathFileUtenti = "../CSV/utenti.csv";
    $pathFileProdotti = "../CSV/prodotti.csv";
    $pathFileCategorie = "../CSV/categorie.csv";
    $pathFileFoto = "../CSV/foto.csv";
    $pathFileCarrello = "../CSV/carrello.csv";

    
    //ritorna tutti gli utenti contenuti nel file
    function getAllUtenti()
    {
        $utenti = [];
        $contenuto = file_get_contents("../CSV/utenti.csv");
        $righe = explode("\r\n",$contenuto);
        foreach ($righe as $riga) {
            if(!empty($riga))
            {                
                $campi = explode( ";",$riga);
                $utenti[] = new utente($campi[0],$campi[1],$campi[2],$campi[3],$campi[4],$campi[5],$campi[6]);
            }
        }
        return $utenti;
    }

    //ritorna tutti i prodotti contenuti nel file
    function getAllProdotti()
    {
        $prodotti = [];
        $contenuto = file_get_contents("../CSV/prodotti.csv");
        $righe = explode("\r\n",$contenuto);
        foreach ($righe as $riga) {
            if(!empty($riga))
            {
                $campi = explode( ";",$riga);
                $prodotti[] = new prodotto($campi[0],$campi[1],$campi[2],$campi[3],$campi[4],$campi[5],$campi[6]);
            }
        }
        return $prodotti;
    }

    function getAllFoto()
    {
        $foto = [];
        $contenuto = file_get_contents("../CSV/foto.csv");
        $righe = explode("\r\n",$contenuto);
        foreach ($righe as $riga) {
            if(!empty($riga))
            {
                $campi = explode( ";",$riga);
                $foto[] = new foto($campi[0],$campi[1]);
            }
        }
        return $foto;
    }

    function getAllCategorie()
    {
        $categorie = [];
        $contenuto = file_get_contents("../CSV/categorie.csv");
        $righe = explode("\r\n",$contenuto);
        foreach ($righe as $riga) {
            if(!empty($riga))
            {
                $campi = explode( ";",$riga);
                $categorie[] = new categoria($campi[0],$campi[1]);
            }
        }
        return $categorie;
    }

    function getAllCarrello()
    {
        //da controllare se funziona
        $carrello = [];
        $contenuto = file_get_contents("../CSV/carrello.csv");
        $righe = explode("\r\n",$contenuto);
        foreach ($righe as $riga) {
            if(!empty($riga))
            {
                $campi = explode( ";",$riga);
                $vettoretmp = [$campi[0],$campi[1]];
                $carrello[] = $vettoretmp;
            }
        }
        return $carrello;
    }

    function getNextId_utente()    
    {
        $utenti = getAllUtenti();
        if(count($utenti) == 0)
            return 0;
        $lastUtente = $utenti[count($utenti) - 1];
        return $lastUtente->getId_utente() + 1;
        
    }

    function getNextId_prodotto()     
    {
        $prodotti = getAllProdotti();
        if(count($prodotti) == 0)
            return 0;
        $lastProdotto = $prodotti[count($prodotti) - 1];
        return $lastProdotto->getId_prodotto() + 1;
    }

    function getFotoById_Prodotto($id_prodotto)
    {
        $allFoto = getAllFoto();
        $foto = [];
        foreach ($allFoto as $picture) {
            if($picture->getId_prodotto() == $id_prodotto)
                $foto[] = $picture;
        }
        return $foto;
    }

    function getProdottiById_categoria($id_categoria)
    {
        $allProdotti = getAllProdotti();
        $prodotti = [];
        foreach ($allProdotti as $prodotto) {
            if($prodotto->getId_categoria() == $id_categoria)
                $prodotti[] = $prodotto;
        }
        return $prodotti;
    }
  
    function addToFile($path, $contenuto)
    {
        return file_put_contents($path,$contenuto."\r\n",FILE_APPEND);
    }

    function getAllProdottiNotFromUtente($id_utente, $contenuto, $id_categoria)
    {
        //ritorna tutti i prodotti che contengono una determinata parola, tranne quelli dell'utente da cui viene effettuata la ricerca
        $allProdotti = getAllProdotti();

        //prendo tutti i prodotti
        $prodotti = [];
        foreach ($allProdotti as $prodotto) {
            if($prodotto->getId_utente() != $id_utente)
                $prodotti[] = $prodotto;
        }

        //gli filtro per la categoria
        if($id_categoria != "")
        {
            $prodottiTmp = [];
            foreach ($prodotti as $prodotto) {
                if($prodotto->getId_categoria() == $id_categoria)
                    $prodottiTmp[] = $prodotto;
            }
            $prodotti = $prodottiTmp;
        }

        //gli filtro per il contenuto
        $finalProdotti = [];
        foreach ($prodotti as $prodotto) {
            if(str_contains($prodotto->getNome(),$contenuto) || str_contains($prodotto->getDescrizione(),$contenuto))
                $finalProdotti[] = $prodotto;
        }
        return $finalProdotti;
       
    }

    function getProdotto($id_prodotto)
    {
        $allProdotti = getAllProdotti();
        foreach ($allProdotti as $prodotto) {
            if($prodotto->getId_prodotto() == $id_prodotto)
                return $prodotto;
        }
        return null;
    }

    function getCarrelloByUtente($id_utente)
    {
        $carrello = [];
        //ritorna tutti i prodotti che un determinato utente ha messo nel carrello
        $allCarrello = getAllCarrello();
        foreach ($allCarrello as $riga) {
            if($riga[0] == $id_utente)
                $carrello[] = $riga;
        }
        return $carrello;
    }
?>