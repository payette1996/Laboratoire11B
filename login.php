<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';

    if (isset($_SESSION['acces'])) {
        echo '<h1 class="connexion">Entrez votre nom d\'utilisateur et votre mot de passe pour accéder aux fonctionnalités</h1>' .
                (isset($_GET['erreur']) ? '<p class="erreur">Courriel ou mot de passe incorrect.</p>' : '');
        
        require_once './inc/login-form.html';
    }
    
    else {
        echo '<h1>Aucun utilisateur n\'est encore inscrit</h1>
              <h2>Veuillez procéder à une première inscription pour pouvoir vous connecter ensuite</h2>';
    }

    require_once './inc/footer.html';
?>