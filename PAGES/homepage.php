<?php
    if(!isset($_SESSION))
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita</title>
</head>
<body>
    Sito <br>
    <input type="text" name="cerca">
    <button>Cerca</button> <!-- magari da sostituire con altro -->

    <?php
        if(!isset($_SESSION["user"]))
        { 
    ?>
            <div id="divLogin">
                <form action="login.php" method="post">
                    <button>Accedi</button>
                </form>
            </div>
    <?php    
        }
        else
        {
    ?>
            <div id="divCarrello">
                <form action="carrello.php" method="post">
                    <button>Carrello</button>
                </form>
            </div>
            <div id="divLogout">
                <form action="../ALTRE PAGES/logout.php" method="post">
                    <button>Logout</button>
                </form>
            </div>
            <div id="divAddProdotto">
                <form action="aggiungiProdotto.php" method="post">
                    <button>Aggiungi prodotto</button>
                </form>    
            </div>
    <?php
        }
    ?>
</body>
</html>