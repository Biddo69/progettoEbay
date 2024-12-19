<?php
    require_once("../CLASSES/utente.php");
    require_once("../CLASSES/prodotto.php");
    require_once("../CLASSES/foto.php");
    require_once("../CLASSES/categoria.php");
    
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

    function getNextId_utente()     //DA RIVEDERE
    {
        $utenti = getAllUtenti();
        if(count($utenti) == 0)
            return 0;
        $lastUtente = $utenti[count($utenti) - 1];
        return $lastUtente->getId_utente() + 1;
        
    }

    function getNextId_prodotto()     //DA RIVEDERE
    {
        $prodotti = getAllProdotti();
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

    function addUtente($utente)
    {
        return file_put_contents("../CSV/utenti.csv",$utente."\r\n",FILE_APPEND);
    }
?>