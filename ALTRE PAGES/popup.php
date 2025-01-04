<?php
    if(!isset($_SESSION))
        session_start();
    $path = "../PAGES/homepage.php";
    if(isset($_SESSION["risposta_path"]))
    {
        $path = $_SESSION["risposta_path"];
        unset($_SESSION["risposta_path"]);
    }
    if(isset($_SESSION["id_prodotto"]))
        $valore= $_SESSION["id_prodotto"];

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finestra Modale Moderna</title>
    <link rel="stylesheet" href="../STYLE/popup.css">
</head>
<body>
    <!-- Sovrapposizione -->
    <div id="modalOverlay" class="overlay">
        <div class="modal">
            <button class="close-icon" id="closeIcon">&times;</button>
            <p>
                <?php 
                    echo $_SESSION["risposta"];
                    unset($_SESSION["risposta"]);
                ?>
            </p>
            <div class="modal-buttons">
                <form action="<?php echo $path?>" method="get">
                    <?php
                        if(isset($_SESSION["id_prodotto"]))
                        {
                            echo '<input type="hidden" name="id_prodotto" value="'.$valore.'">';
                            unset($_SESSION["id_prodotto"]);
                        }
                    ?>
                    <button class="close-btn" id="closeModal">Close</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Seleziona elementi
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalButton = document.getElementById('closeModal');
        const closeIconButton = document.getElementById('closeIcon');

        // Mostra la finestra modale al caricamento della pagina
        window.addEventListener('load', () => {
            modalOverlay.classList.add('show');
        });

        // Nascondi la finestra modale quando i pulsanti vengono cliccati
        closeModalButton.addEventListener('click', () => {
            modalOverlay.classList.remove('show');
        });

        closeIconButton.addEventListener('click', () => {
            modalOverlay.classList.remove('show');
        });
    </script>
</body>
</html>
