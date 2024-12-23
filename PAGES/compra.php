<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_GET["id_prodotto"]))
    {
        //header("Location: homepage.php?messaggio=Si è verificato un erroreee");
        //exit;
    }   
   $prodotto = getProdotto($_GET["id_prodotto"]);
   $immagini = getFotoById_Prodotto($_GET["id_prodotto"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION["risposta"]))
        {
            require_once("../ALTRE PAGES/popup.php");
        }
    ?>
<div id="productContainer">
        <div id="product">      
   
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                        echo 
                        '<div class="carousel-item active">
                            <div class="product-image">
                                <img src="'.$immagini[0]->getPath().'" class="d-block w-100" alt="...">
                                </div>
                        </div>';
                        
                        for ($i=1; $i < count($immagini); $i++) { 
                            echo 
                            '<div class="carousel-item">
                                <div class="product-image">
                                <img src="'.$immagini[$i]->getPath().'" class="d-block w-100" alt="...">
                                </div>
                            </div>';
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div>
                <?php
                    echo '
                    <div class="product-details">
                            <h2>'.$prodotto->getNome().'</h2>
                            <p class="description">'.$prodotto->getDescrizione().'</p>
                            <p class="quantity">'.$prodotto->getQuantità().'</p>
                            <p class="price">'.$prodotto->getPrezzo().'</p>
                    </div>';
                
                ?>
            </div>

            
            <form action="../ALTRE PAGES/gestionePagamento.php" method="get">
                quantità <input type="number" name="quantità" min="1" max="<?php echo $prodotto->getQuantità() ?>" value="1"> <br>

                    nome <input type="text" name="nome"> <br>
                    cognome <input type="text" name="cognome"> <br>
                    mail <input type="email" name="mail"> <br>
                    città <input type="text" name="città"> <br>
                    CAP <input type="text" name="cap"> <br>
                    indirizzo <input type="text" name="indirizzo"> <br>
                    codice <input type="text" name="codice"> <br>
                    cvv <input type="text" name="cvv"> <br>
                   scadenza <input type="text" name="scadenza"> <br>


                <input type="hidden" name="id_prodotto" value="<?php echo $prodotto->getId_prodotto() ?>">
                <button>Paga</button>
            </form>
           
        </div>
    </div>
</body>
</html>