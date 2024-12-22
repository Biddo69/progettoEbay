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
    <link rel="stylesheet" href="../STYLE/ricerca.css">
</head>
<body>
  

   <?php
        require_once("top.php");
        //controllo se ho fatto una ricerca, in questo caso stampo i risultati della ricerca
        //altrimenti mostro altri prodotti
        if(isset($prodotti))
        {
            echo '<table>';
            foreach ($prodotti as $prodotto) {
                $immagini = getFotoById_Prodotto($prodotto->getId_prodotto());
                echo '<tr>
                   
                        <div>
                            <td> 
                                <a href="mostraProdotto.php?id_prodotto='.$prodotto->getId_prodotto().'"> <img src="'.$immagini[0]->getPath().'" alt=""> </a>
                            </td>
                            <td>
                                <a href="mostraProdotto.php?id_prodotto='.$prodotto->getId_prodotto().'">

                                    <div>

                                        <p>'.$prodotto->getNome().'</p>
                                        <p>'.$prodotto->getDescrizione().'</p>
                                        <p>€ '.$prodotto->getPrezzo().'</p>
                                    
                                    </div>
                                </a>
                            </td>';
                            if(isset($_SESSION["user"]))
                            {
                                echo '
                                  <td>
                                    <form action="../ALTRE PAGES/gestioneCarrello.php method="get">
                                        <input type="hidden" value="'.$prodotto->getId_prodotto().'" name="id_prodotto">
                                        <button>Aggiungi al carrello</button>

                                    </form>
                                </td>

                                <td>
                                    <form action="" method="post">
                                        <button>Compra ora</button>
                                    </form>
                                </td>';
                            }
                          
                       
                    
                echo '  </div>
                </tr>';
            }
            
            echo '</table>';
           

   
            //unset($_SESSION["prodotti"]);
        }
        
   ?>
</body>
</html>