<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';

    if (isset($_SESSION['utilisateur'])) {
        echo '<h1>Réservez votre voiture</h1>';
        require_once './inc/car-form.php';
    }
    
    else
        echo '<h1>Veuillez vous connecter pour visualiser le contenu de cette page</h1>';

    require_once './inc/footer.html';
?>