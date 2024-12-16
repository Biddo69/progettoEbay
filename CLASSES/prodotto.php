<?php
    class prodotto{
        private $id_prodotto;
        private $nome;
        private $descrizione;
        private $prezzo;
        private $quantità;
        private $id_utente;     // foreign key
        private $id_categoria; // foreign key

        
        function __construct($id_prodotto,$nome,$descrizione,$prezzo,$quantità,$id_utente,$id_categoria)
        {
            $this->id_prodotto = (int)$id_prodotto;
            $this->nome = $nome;
            $this->descrizione = $descrizione;
            $this->prezzo = (int)$prezzo;
            $this->quantità = (int)$quantità;
            $this->id_utente = (int)$id_utente;
            $this->id_categoria = (int)$id_categoria;
        }
        function toCsv()
        {
            return $this->id_prodotto.";".$this->nome.";".$this->descrizione.";".$this->prezzo.";".$this->quantità.";".$this->id_utente.";".$this->id_categoria;
        }

        function setId_prodotto($id_prodotto)
        {
            $this->id_prodotto = (int)$id_prodotto;
        }
        function setNome($nome)
        {
            $this->nome = $nome;
        }
        function setDescrizione($descrizione)
        {
            $this->descrizione = $descrizione;
        }
        function setPrezzo($prezzo)
        {
            $this->prezzo = (int)$prezzo;
        }
        function setQuantità($quantità)
        {
            $this->quantità = (int)$quantità;
        }
        function setId_utente($id_utente)
        {
            $this->id_utente = (int)$id_utente;
        }
        function setId_categoria($id_categoria)
        {
            $this->id_categoria = (int)$id_categoria;
        }

        function getId_prodotto()
        {
            return $this->id_prodotto;
        }
        function getNome()
        {
            return $this->nome;
        }
        function getDescrizione()
        {
            return $this->descrizione;
        }
        function getPrezzo()
        {
            return $this->prezzo;
        }
        function getQuantità()
        {
            return $this->quantità;
        }
        function getId_utente()
        {
            return $this->id_utente;
        }
        function getId_categoria()
        {
            return $this->id_categoria;
        }
    }

?>