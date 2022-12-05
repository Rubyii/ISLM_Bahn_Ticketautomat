<?php
    session_start();

    session_unset();
    session_destroy();
    session_regenerate_id();
    header('Location: ../../startseite.php'); // ZUR STARTSEITE HIER LEITEN
    exit();

?>