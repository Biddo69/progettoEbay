<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }
    $utente = $_SESSION["user"];
    $carrello = getCarrelloByUtente($utente->getId_utente());
    $prezzo = getCostoCarrello($utente->getId_utente());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - carrello</title>
    <link rel="stylesheet" href="../STYLE/carrello.css">
</head>
<body>
    <table>
        <?php
            foreach ($carrello as $prodotto) {
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
                           
                            echo '<td>
                                <form action="compra.php" method="post">
                                    <input type="hidden" name="id_prodotto" value="'.$prodotto->getId_prodotto().'">
                                    <button>Compra ora</button>
                                </form>
                            </td>';
                    
                echo '  </div>
                </tr>';
            }
            echo "Prezzo: ".$prezzo;

        ?>
    </table>
</body>
</html>