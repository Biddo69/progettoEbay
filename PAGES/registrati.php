<?php
    if(!isset($_SESSION))
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - Registrati</title>
</head>
<body>
    <?php   //questa riga da modifare in modo migliore graficamente
        if(isset($_GET["messaggio"]))
            echo "<h1>".$_GET["messaggio"]."</h1>";
    ?>
    <form action="../ALTRE PAGES/gestioneRegistrazione.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nome:</td><td><input type="text" name="nome" required></td>
            </tr>
            <tr>
                <td>Cognome:</td><td><input type="text" name="cognome" required></td>
            </tr>
            <tr>
                <td>Residenza:</td><td><input type="text" name="residenza" required></td>
            </tr>
            <tr>
                <td>Mail:</td><td><input type="email" name="mail" required></td>
            </tr>
            <tr>
                <td>Password:</td><td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Conferma password:</td><td><input type="password" name="confermaPassword" required></td>
            </tr>
            <tr>
                <td>Foto profilo:</td><td><input type="file" name="foto"></td>
            </tr>
        </table>
        <button>Invia</button>
    </form>
</body>
</html>