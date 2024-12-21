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
        /* Stile generale */
/* Stile generale */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

/* Carosello */
.carousel {
    margin: 20px auto;
    max-width: 800px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.carousel-inner img {
    object-fit: cover;
    width: 100%;
    height: 400px;
}

/* Stile pulsanti del carosello */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 10px;
}

/* Contenitore informazioni prodotto */
#product-details {
    margin: 20px auto;
    max-width: 800px;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

#product-details p {
    margin: 10px 0;
    font-size: 1.2rem;
    line-height: 1.8;
}

#product-details p:first-child {
    font-size: 2rem;
    font-weight: bold;
    color: #007BFF;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 1.2px;
}

#product-details p:nth-child(2) {
    font-size: 1.4rem;
    color: #555;
    font-style: italic;
    margin-bottom: 20px;
}

#product-details p:nth-child(3) {
    font-size: 1.6rem;
    color: #28a745;
    font-weight: bold;
    margin-top: 10px;
}

/* Media query per dispositivi mobili */
@media (max-width: 768px) {
    .carousel {
        max-width: 100%;
    }

    #product-details {
        padding: 15px;
    }

    #product-details p {
        font-size: 1rem;
    }

    #product-details p:first-child {
        font-size: 1.5rem;
    }

    #product-details p:nth-child(2) {
        font-size: 1.2rem;
    }

    #product-details p:nth-child(3) {
        font-size: 1.4rem;
    }
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
    <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <?php
            	echo 
                '<div class="carousel-item active">
                    <img src="'.$immagini[0]->getPath().'" class="d-block w-100" alt="...">
                </div>';
                
                for ($i=1; $i < count($immagini); $i++) { 
                    echo 
                    '<div class="carousel-item">
                        <img src="'.$immagini[$i]->getPath().'" class="d-block w-100" alt="...">
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
<!-- nome -->
 <div>
    <?php
        echo
        '<p>
            '.$prodotto->getNome().'
        </p>
        
        <p>
            '.$prodotto->getDescrizione().'
        </p>
        
        <p>
            '.$prodotto->getPrezzo().'
        </p>';
    
    ?>
 </div>
<!-- descrizione -->  
</body>
</html>