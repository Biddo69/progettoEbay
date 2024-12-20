<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    $categorie = getAllCategorie();

    //controllo se ho effettauto una ricerca
    if(isset($_SESSION["prodotti"]))
    {
        
        $prodotti = $_SESSION["prodotti"];
        //print_r($_SESSION["prodotti"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita</title>
    <link rel="stylesheet" href="../STYLE/homepage.css">
</head>
<body>
    Sito <br>
    <form action="../ALTRE PAGES/ricerca.php" method="post">
        <input type="text" name="cerca">
        <button>Cerca</button> <!-- magari da sostituire con altro -->
        <select name="categoria">
            <option value="">Tutte le categorie</option>
            <?php
                foreach ($categorie as $categoria) {
                    echo '<option value="'.$categoria->getId_categoria().'">'.$categoria->getNome().'</option>';
                }

            ?>
        </select>
    </form>
    
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
    ?>
            <div id="divCarrello">
                <form action="carrello.php" method="post">
                    <button>Carrello</button>
                </form>
            </div>
            <div id="divLogout">
                <form action="../ALTRE PAGES/logout.php" method="post">
                    <button>Logout</button>
                </form>
            </div>
            <div id="divAddProdotto">
                <form action="aggiungiProdotto.php" method="post">
                    <button>Aggiungi prodotto</button>
                </form>    
            </div>
         
    <?php
        }
    ?>

   <?php
        //controllo se ho fatto una ricerca, in questo caso stampo i risultati della ricerca
        //altrimenti mostro altri prodotti
        if(isset($prodotti))
        {
            echo '<table>';
            foreach ($prodotti as $prodotto) {
                $immagini = getFotoById_Prodotto($prodotto->getId_utente());
                echo '<tr>
                    <div>
                        <td><img src="'.$immagini[0]->getPath().'" alt=""><td>
                        <td>
                            <div>
                                <p>'.$prodotto->getNome().'</p>
                                <p>'.$prodotto->getDescrizione().'</p>
                                <p>€'.$prodotto->getPrezzo().'</p>
                            </div>
                        </td>
                        
                    </div>
                </tr>';
            }
            
            echo '</table>';
           

   
            //unset($_SESSION["prodotti"]);
        }
        else
        {
            //stampo altri prodotti
        }
   ?>

</body>
</html>