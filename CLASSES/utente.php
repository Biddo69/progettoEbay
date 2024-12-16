<?php
    class utente{
        private $id_utente;
        private $nome;
        private $cognome;
        private $mail;
        private $foto_profilo;
        private $residenza;

        function __construct($id_utente,$nome,$cognome,$mail,$foto_profilo,$residenza)
        {
            $this->id_utente = (int)$id_utente;
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->mail = $mail;
            $this->foto_profilo = $foto_profilo;
            $this->residenza = $residenza;
        }

        function toCsv()
        {
            return $this->id_utente.";".$this->nome.";".$this->cognome.";".$this->mail.";".$this->foto_profilo.";".$this->residenza;
        }

        function setId_utente($id_utente)
        {
            $this->id_utente = $id_utente;
        }

        function setNome($nome)
        {
            $this->nome = $nome;
        }
        function setCognome($cognome)
        {
            $this->cognome = $cognome;
        }
        function setmail($mail)
        {
            $this->mail = $mail;
        }
        function setFoto_profilo($foto_profilo)
        {
            $this->foto_profilo = $foto_profilo;
        }
        function setResidenza($residenza)
        {
            $this->residenza = $residenza;
        }

        function getId_utente()
        {
            return $this->id_utente;
        }

        function getNome()
        {
            return $this->nome;
        }
        function getCognome()
        {
            return $this->cognome;
        }
        function getMail()
        {
            return $this->mail;
        }
        function getFoto_profilo()
        {
            return $this->foto_profilo;
        }
        function getresidenza()
        {
            return $this->residenza;
        }

    }

?>