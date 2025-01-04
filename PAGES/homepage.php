<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    $categorie = getAllCategorie();

    if(isset($_SESSION["user"]))
        $utente = $_SESSION["user"];
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
   <?php
        if(isset($_SESSION["risposta"]))
            require_once("../ALTRE PAGES/popup.php");
        require_once("top.php");
   ?>
  

 
    <?php
        $id_utente = -1;
        if(isset($utente))
            $id_utente = $utente->getId_utente();
        $prodotti = getLast5Prodotti($id_utente); 
        if(count($prodotti) > 0)
        {
            echo ' <h3>Ultimi prodotti messi in vendita</h3>';
            for ($i=count($prodotti) - 1; $i >=0; $i--) { 
                echo '<table>';
                $immagini = getFotoById_Prodotto($prodotti[$i]->getId_prodotto());
                echo '<tr>
                        <div>
                            <td> 
                                <a href="mostraProdotto.php?id_prodotto='.$prodotti[$i]->getId_prodotto().'"> <img src="'.$immagini[0]->getPath().'" alt=""> </a>
                            </td>
                            <td>
                                <a href="mostraProdotto.php?id_prodotto='.$prodotti[$i]->getId_prodotto().'">
                                    <div>
                                        <p class="nome">'.$prodotti[$i]->getNome().'</p>
                                        <p class="descrizione">'.$prodotti[$i]->getDescrizione().'</p>
                                        <p>€ '.$prodotti[$i]->getPrezzo().'</p>     
                                    </div>
                                </a>
                            </td>';
                            if(isset($_SESSION["user"]))
                            {
                                echo '
                                  <td>
                                    <form action="../ALTRE PAGES/gestioneCarrello.php" method="get" class="formBottoni">
                                        <input type="hidden" value="'.$prodotti[$i]->getId_prodotto().'" name="id_prodotto">
                                        <button>Aggiungi al carrello</button>
    
                                    </form>
                                </td>';
                                }
                                echo '<td>
                                    <form action="compra.php" method="get" class="formBottoni">
                                        <input type="hidden" name="id_prodotto" value="'.$prodotti[$i]->getId_prodotto().'">
                                        <button>Compra ora</button>
                                    </form>
                                </td>
                    
                 </div>
                </tr>';
        }
       
        }        
    ?>
    </table>
</body>
</html>