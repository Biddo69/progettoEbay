<?php
    if(!isset($_SESSION))
        session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito compravendita - Login</title>
</head>
<body>
    <?php   //questa riga da modifare in modo migliore graficamente
        if(isset($_GET["messaggio"]))
            echo "<h1>".$_GET["messaggio"]."</h1>";
    ?>
    <form action="../ALTRE PAGES/gestioneLogin.php" method="post">
        <table>
            <tr>
                <td> mail: </td><td><input type="mail" name="mail" required> </td>
            </tr>
            <tr>
                <td> password: </td><td><input type="password" name="password" required> </td>
            </tr>
        </table>
        <button>Accedi</button>
       
    </form>

    <form action="registrati.php" method="post">
        <button>Registrati</button>
    </form>

</body>
</html>