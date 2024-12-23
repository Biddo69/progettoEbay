<?php
    require_once("variabili.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finestra Modale Moderna</title>
    <style>
        /* Stile per la sovrapposizione */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Sfondo più scuro */
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* Rendi visibile la sovrapposizione */
        .overlay.show {
            visibility: visible;
            opacity: 1;
        }

        /* Stile della finestra modale */
        .modal {
            background: #2c2f33; /* Colore scuro */
            color: #ffffff; /* Testo bianco */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            text-align: left;
            max-width: 500px;
            width: 100%;
        }

        /* Stile del titolo */
        .modal h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            border-bottom: 1px solid #444; /* Linea separatrice */
            padding-bottom: 10px;
        }

        /* Stile del contenuto */
        .modal p {
            margin: 15px 0;
            font-size: 1rem;
            color: #cfcfcf; /* Testo leggermente grigio */
        }

        /* Pulsanti */
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .close-btn {
            background: #6c757d; /* Grigio scuro */
            color: white;
        }

        .close-btn:hover {
            background: #5a6268;
        }

        .understood-btn {
            background: #0d6efd; /* Blu principale */
            color: white;
        }

        .understood-btn:hover {
            background: #0b5ed7;
        }

        /* Pulsante di chiusura in alto */
        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: #ffffff;
            cursor: pointer;
        }

        .close-icon:hover {
            color: #ff5c5c;
        }
    </style>
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
            ?></p>
            <div class="modal-buttons">
                <form action="../PAGES/homepage.php" method="post">
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
