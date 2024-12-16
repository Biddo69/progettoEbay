<?php
    class categoria{
        private $id_categoria;
        private $nome;

        function __construct($id_categoria, $nome)
        {
            $this->id_categoria = $id_categoria;
            $this->nome = $nome;
        }

        function getId_categoria()
        {
            return $this->id_categoria;
        }
        function getNome()
        {
            return $this->nome;
        }
    }
?>