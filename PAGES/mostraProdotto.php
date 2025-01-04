<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();

    if(!isset($_GET["id_prodotto"]))
    {
        header("Location: homepage.php?messaggio=Si è verificato un errore");
        exit;
    }   
   $prodotto = getProdottoById($_GET["id_prodotto"]);
   $immagini = getFotoById_Prodotto($_GET["id_prodotto"]);
   $venditore = getUtente($prodotto->getId_utente());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - mostra prodotto</title>
    <link rel="stylesheet" href="../STYLE/mostraProdotto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var splide = new Splide('#carousel', {
        type:'loop',
        perPage: 1,
        arrows: false, // Disabilita le frecce predefinite
    });

    // Seleziona tutte le frecce personalizzate
    document.querySelectorAll('.custom-arrow.prev').forEach(function (prevButton) {
        prevButton.addEventListener('click', function () {
            splide.go('<'); // Naviga alla slide precedente
        });
    });

    document.querySelectorAll('.custom-arrow.next').forEach(function (nextButton) {
        nextButton.addEventListener('click', function () {
            splide.go('>'); // Naviga alla slide successiva
        });
    });

    splide.mount();
});

</script>

</head>
<body>

<div id="carousel" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <?php

                // Ciclo per generare dinamicamente i <li> con le immagini
                foreach ($immagini as $immagine) {
                    echo '<li class="splide__slide">
                        <div class="divImg">
                            <img src="'.$immagine->getPath().'" alt="Descrizione immagine">
                            <button class="custom-arrow prev">‹</button>
                            <button class="custom-arrow next">›</button>
                        </div>
                    </li>';
                }
            
            ?>
        </ul>
    </div>
    
</div>
    <div id="productContainer">
        <div id="product">      
            <div>
                <?php
                    echo '
                    <div class="product-details">
                            <h2>'.$prodotto->getNome().'</h2>
                            <p class="description">'.$prodotto->getDescrizione().'</p>
                            <p class="quantity">Quantità disponibile: '.$prodotto->getQuantità().'</p>
                            <p class="price">€'.$prodotto->getPrezzo().'</p>
                    </div>';
                
                ?>
            </div>
            <form action="compra.php" method="get">
                <input type="hidden" name="id_prodotto" value="<?php echo $prodotto->getId_prodotto() ?>">
                <button>Compra ora</button>
            </form>
            <div>
                <a href="mostraUtente.php?id_utente=<?php echo $venditore->getId_utente() ?>">
                <?php
                    echo 'Prodotto venduto da '.$venditore->getNome().' '.$venditore->getCognome();
                ?>  
                </a>
            </div>
        </div>
    </div>
</body>
</html>