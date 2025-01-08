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

   $prodotto = getProdottoById($_GET["id_prodotto"]);
   $immagini = getFotoById_Prodotto($_GET["id_prodotto"]);
    if(isset($_SESSION["user"]))
    {
        $utente = $_SESSION["user"];
        if($prodotto->getId_utente() == $utente->getId_utente())
        {
            $_SESSION["risposta"] = "Non puoi accedere a questa pagina";
            header("Location: homepage.php");
            exit;
        }

    }
    else
        $utente = new utente("","","","","","","");
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
            exit;
        }
    ?>
    <a href="homepage.php"><h1>Ebax</h1></a>  <br>

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
                            <p class="price">Prezzo: €'.$prodotto->getPrezzo().'</p>
                    </div>';
                
                ?>
            </div>
            
        </div>
    </div>      

            
    <form action="../ALTRE PAGES/gestionePagamento.php" method="post">
            <div>
                <h2>Dati utente</h2>
                Quantità <input type="number" name="quantità" min="1" max="<?php echo $prodotto->getQuantità() ?>" value="1" required> <br>
                Nome <input type="text" name="nome" value="<?php echo $utente->getNome() ?>" required> <br>
                Cognome <input type="text" name="cognome" value="<?php echo $utente->getCognome()?>" required> <br>
                Mail <input type="email" name="mail" value="<?php echo $utente->getMail()?>" required> <br>
                Città <input type="text" name="città" required> <br>
                CAP <input type="number" name="cap" required> <br>
                Indirizzo <input type="text" name="indirizzo" required> <br>
            </div>
            
            <div>
                <h2>Dati carta di credito</h2>
                Codice <input type="text" name="codice" required> <br>
                Cvv <input type="number" name="cvv" required> <br>
                Scadenza <input type="date" name="scadenza" required> <br>
            </div>

        <input type="hidden" name="id_prodotto" value="<?php echo $prodotto->getId_prodotto() ?>">
        <button>Paga</button>
    </form>
           
</body>
</html>