<?php
    require_once("../ALTRE PAGES/gestioneFile.php");
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php?messaggio=Devi essere autenticato per accedere a questa pagina");
        exit;
    }
    $categorie = getAllCategorie();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - Aggiunta prodotti</title>
</head>
<body>
    <form action="../ALTRE PAGES/gestioneAggiungiProdotto.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nome: </td> <td><input type="text" name="nome" required></td>
            </tr>
            <tr>
                <td>Descrizione: </td> <td><input type="text" name="descrizione"></td>
            </tr>
            <tr>
                <td>prezzo: </td> <td><input type="number" name="prezzo" min="1" required></td>
            </tr>
            <tr>
                <td>Quantità: </td> <td><input type="number" name="quantità" min="1" value="1"></td> <!-- da vedere se funziona con il value -->
            </tr>
            <tr>
                <td>Categoria: </td>
                <td>
                <select name="categoria">
                    <?php
                        foreach ($categorie as $categoria) {
                            echo '<option value="'.$categoria->getId_categoria().'">'.$categoria->getNome().'</option>';
                        }

                    ?>
                </select>
                </td>
            </tr>
                <td>Immagini: </td><td><input type="file" name="immagini[]" accept=".png,.jpg" multiple></td>
            </tr>
        </table>
        <button>Invio</button>
    </form>
</body>
</html>