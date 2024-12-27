<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_GET["id_prodotto"]))
    {
        $_SESSION["risposta"] = "Si è verificato un errore";
        header("Location: homepage.php");
        exit;
    }   
   $prodotto = getProdotto($_GET["id_prodotto"]);
   $immagini = getFotoById_Prodotto($_GET["id_prodotto"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - pagamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/css/splide.min.css">
    <link rel="stylesheet" href="../STYLE/compra.css">
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
    <?php
        if(isset($_SESSION["risposta"]))
        {
            require_once("../ALTRE PAGES/popup.php");
        }
    ?>
   
   <div id="carousel" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <?php

                // Ciclo per generare dinamicamente i <li> con le immagini
                foreach ($immagini as $immagine) {
                    echo '<li class="splide__slide"><img src="'.$immagine->getPath().'" alt="Descrizione immagine">
                    <button class="custom-arrow prev">‹</button>
                    <button class="custom-arrow next">›</button></li>';
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
            
        </div>
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
           
</body>
</html>