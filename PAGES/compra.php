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
            <div>
                <h2>Dati utente</h2>
                Quantità <input type="number" name="quantità" min="1" max="<?php echo $prodotto->getQuantità() ?>"> <br>
                Nome <input type="text" name="nome"> <br>
                Cognome <input type="text" name="cognome"> <br>
                Mail <input type="email" name="mail"> <br>
                Città <input type="text" name="città"> <br>
                CAP <input type="text" name="cap"> <br>
                Indirizzo <input type="text" name="indirizzo"> <br>
            </div>
            
            <div>
                <h2>Dati carta di credito</h2>
                Codice <input type="text" name="codice"> <br>
                Cvv <input type="number" name="cvv"> <br>
                Scadenza <input type="date" name="scadenza"> <br>
            </div>

        <input type="hidden" name="id_prodotto" value="<?php echo $prodotto->getId_prodotto() ?>">
        <button>Paga</button>
    </form>
           
</body>
</html>