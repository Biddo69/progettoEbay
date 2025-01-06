<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_GET["id_utente"]))
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        header("Location: homepage.php");
        exit;
    }    
    $utente = getUtente($_GET["id_utente"]);
    $prodotti = getProdottiFromUtente($_GET["id_utente"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - utente</title>
    <link rel="stylesheet" href="../STYLE/utente.css">
</head>
<body>
    <div id="profile-container">
        <div id="profile-header">
            <img src="<?php echo $utente->getFoto_Profilo(); ?>" alt="Foto Profilo" id="profile-picture">
            <h1><?php echo $utente->getNome() . ' ' . $utente->getCognome(); ?></h1>
        </div>
        <div id="profile-details">
            <p><strong>Nome:</strong> <?php echo $utente->getNome(); ?></p>
            <p><strong>Cognome:</strong> <?php echo $utente->getCognome(); ?></p>
            <p><strong>Residenza:</strong> <?php echo $utente->getResidenza(); ?></p>
            <p><strong>Email:</strong> <?php echo $utente->getMail(); ?></p>
        </div>
    </div>

    <div id="products-container">
        <h2>Prodotti in Vendita</h2>
        <?php
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
                                    <form action="" method="post">
                                        <button>Compra ora</button>
                                    </form>
                                </td>';
                          
                       
                    
                echo '  </div>
                </tr>';
            }
            echo '</table>';
            ?>
    </div>
</body>
</html>