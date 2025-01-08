<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    $categorie = getAllCategorie();

    //controllo se ho effettauto una ricerca
    if(isset($_SESSION["prodotti"]))
    {
        $prodotti = $_SESSION["prodotti"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita</title>
    <link rel="stylesheet" href="../STYLE/homepage.css">
    <link rel="stylesheet" href="../STYLE/top.css">

</head>
<body>
    <a href="homepage.php"><h1>Ebax</h1></a>  <br>
      
    <?php
        if(!isset($_SESSION["user"]))
        { 

    ?>
            <div id="divLogin">
                <form action="login.php" method="post">
                    <button>Accedi</button>
                </form>
            </div>
    <?php    
        }
        else
        {
            $utente = $_SESSION["user"];
    ?>
        <div class="button-container">
            <div id="divCarrello">
                <form action="carrello.php" method="post">
                    <button>Carrello</button>
                </form>
            </div>
            
            <div id="divAddProdotto">
                <form action="aggiungiProdotto.php" method="post">
                    <button>Aggiungi prodotto</button>
                </form>    
            </div>
            <div id="divMostraProfilo">
                <form action="mostraUtente.php" method="get">
                    <input type="hidden" name="id_utente" value="<?php echo $utente->getId_utente() ?>">
                    <button>Visualizza profilo</button>
                </form>    
            </div>
            <div id="divLogout">
                <form action="../ALTRE PAGES/logout.php" method="post">
                    <button>Logout</button>
                </form>
            </div>
        </div>
         
    <?php
        }
    ?>
  
  <form action="ricerca.php" method="post">
        <input type="text" name="cerca" placeholder="Cerca un prodotto...">
        <button>Cerca</button> 
        <select name="categoria">
            <option value="">Tutte le categorie</option>
            <?php
                foreach ($categorie as $categoria) {
                    echo '<option value="'.$categoria->getId_categoria().'">'.$categoria->getNome().'</option>';
                }

            ?>
        </select>
    </form>


   
</body>
</html>