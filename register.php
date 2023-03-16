<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';

    echo '<h1>Création de votre compte</h1>';

    require_once './inc/register-form.html';
    require_once './inc/footer.html';
?>