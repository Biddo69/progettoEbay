<?php
    class foto{
        private $id_prodotto;
        private $path;

        function __construct($id_prodotto,$path)
        {
            $this->id_prodotto = $id_prodotto;
            $this->path = $path;
        }

        function getId_prodotto()
        {
            return $this->id_prodotto;
        }
        function getPath()
        {
            return $this->path;
        }

        function toCSV()
        {
            return $this->id_prodotto.";".$this->path;
        }
    }
?>