<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
       if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - Aggiunta prodotti</title>
    <link rel="stylesheet" href="../STYLE/aggiungiProdotto.css">
</head>
<body>
<?php
        if(isset($_SESSION["risposta"]))
        {   
            require_once("../ALTRE PAGES/popup.php");
            exit;
        }
   ?>
    <div class="container">
        <h1>Aggiungi un prodotto</h1>
        <form action="../ALTRE PAGES/gestioneAggiungiProdotto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="descrizione">Descrizione:</label>
                <input type="text" name="descrizione" id="descrizione">
            </div>
            <div class="form-group">
                <label for="prezzo">Prezzo:</label>
                <input type="number" name="prezzo" id="prezzo" min="1" required>
            </div>
            <div class="form-group">
                <label for="quantità">Quantità:</label>
                <input type="number" name="quantità" id="quantità" min="1" value="1">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <?php
                        $categorie = getAllCategorie();
                        foreach ($categorie as $categoria) {
                            echo '<option value="'.$categoria->getId_categoria().'">'.$categoria->getNome().'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="immagini">Immagini:</label>
                <input type="file" name="immagini[]" id="immagini" accept="image/jpeg, image/png" multiple>
            </div>
            <button type="submit">Invia</button>
        </form>
    </div>
</body>
</html>
