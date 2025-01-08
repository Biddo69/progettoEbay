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
    <link rel="stylesheet" href="../STYLE/login.css">
</head>
<body>
    <a href="homepage.php"><h1>Ebax</h1></a>  <br>

    <?php 
        if(isset($_GET["messaggio"]))
            echo "<h2>".$_GET["messaggio"]."</h2>";
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

    Non hai un'account? <a href="registrati.php"> Registrati qui</a>

</body>
</html>