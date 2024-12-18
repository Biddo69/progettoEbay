<?php
    if(!isset($_SESSION))
        session_start();
    session_unset();
    header("Location: ../PAGES/homepage.php");
    exit;
?>