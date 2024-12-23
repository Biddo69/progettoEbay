<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_GET["id_prodotto"]))
    {
        header("Location: homepage.php?messaggio=Si è verificato un errore");
        exit;
    }   
   $prodotto = getProdotto($_GET["id_prodotto"]);
   $immagini = getFotoById_Prodotto($_GET["id_prodotto"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.product {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.product-image img {
    max-width: 250px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-details {
    flex: 1;
}

.product-details h2 {
    margin: 0;
    font-size: 1.5em;
    color: #222;
}

.product-details .description {
    margin: 10px 0;
    font-size: 1em;
    color: #555;
}

.product-details .quantity {
    font-size: 0.9em;
    color: #777;
}

.product-details .price {
    font-size: 1.2em;
    font-weight: bold;
    color: #e63946;
    margin-top: 5px;
}



    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - mostra prodotto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<!-- immagini -->
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
            <form action="compra.php" method="get">
                <input type="hidden" name="id_prodotto" value="<?php echo $prodotto->getId_prodotto() ?>">
                <button>Compra ora</button>
            </form>

        </div>
    </div>
<!-- descrizione -->  
</body>
</html>