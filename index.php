<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';

    echo '<h1>Bienvenue sur ce site de location de voitures</h1>
          <h2>Nos voitures vous mèneront là où vous le souhaitez avec style !</h2>';

    require_once './inc/footer.html';
?>