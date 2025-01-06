<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();


    //OGNI TANTO DA PROBLEMI, QUINDI LO TOLGO E AGGIUNGO ALTRO    
    
    /*if(!isset($_POST["categoria"],$_POST["cerca"]))
    {
        header("Location: ../PAGES/homepage.php?messaggio=Si è verificato un errore");
        exit;
    }*/

    if(isset($_SESSION["user"]))
    {
        $utente = $_SESSION["user"];
        $id_utente = $utente->getId_utente();
    }
    else
        $id_utente = -1;
    

    if(!isset($_POST["categoria"]) && !isset($_POST["cerca"]))
        $prodotti = getAllProdottiNotFromUtente($id_utente,"","");
    else if(!isset($_POST["categoria"]))
        $prodotti = getAllProdottiNotFromUtente($id_utente,$_POST["cerca"],"");
    else if(!isset($_POST["cerca"]))
        $prodotti = getAllProdottiNotFromUtente($id_utente, "",$_POST["categoria"]);
    else
        $prodotti = getAllProdottiNotFromUtente($id_utente,$_POST["cerca"],$_POST["categoria"]);    
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
        if(isset($_SESSION["risposta"]))
        {
            require_once("../ALTRE PAGES/popup.php");
            exit;
        }
        require_once("top.php");

            echo '<table>';
            foreach ($prodotti as $prodotto) {
                $immagini = getFotoById_Prodotto($prodotto->getId_prodotto());
                echo '
                    <tr>   
                        <div>
                            <td> 
                                <a href="mostraProdotto.php?id_prodotto='.$prodotto->getId_prodotto().'"> <img src="'.$immagini[0]->getPath().'" alt=""> </a>
                            </td>
                            <td>
                                <a href="mostraProdotto.php?id_prodotto='.$prodotto->getId_prodotto().'">
                                    <div>
                                        <p class="nome">'.$prodotto->getNome().'</p>
                                        <p class="descrizione">'.$prodotto->getDescrizione().'</p>
                                        <p>€ '.$prodotto->getPrezzo().'</p> 
                                    </div>
                                </a>
                            </td>';
                            if(isset($_SESSION["user"]))
                            {
                                echo '
                                  <td>
                                    <form action="../ALTRE PAGES/gestioneCarrello.php" method="post">
                                        <input type="hidden" value="'.$prodotto->getId_prodotto().'" name="id_prodotto">
                                        <button>Aggiungi al carrello</button>
                                    </form>
                                </td>

                               ';
                            }

                            echo '
                            <td>
                                <form action="compra.php" method="get">                              
                                    <input type="hidden" name="id_prodotto" value="'.$prodotto->getId_prodotto().'">
                                    <button>Compra ora</button>
                                </form>
                            </td>
                        </div>
                    </tr>';
            }
            echo '</table>';

       // }
        
   ?>

</body>
</html>