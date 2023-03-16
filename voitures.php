<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';
    require_once './inc/car-info.php';
    require_once "./class/classVoitureManager.php";

    $voitureManager = new VoitureManager();

    echo '<h1>Voitures disponibles</h1>';
    if (isset($_GET['idVoiture'])) {
        $voiture = $voitureManager->getVoitures($_GET['idVoiture']);
        echo
            "
                <article class='grille'>
                    <h2>{$voiture['marque']} {$voiture['modele']} {$voiture['categorie']}</h2>
                    <img src='./inc/img/{$voiture['image']}' alt='{$voiture['marque']} {$voiture['modele']}'>
                    <p><strong>Passager : </strong>{$voiture['nbPassager']}</p>
                    <p><strong>Description : </strong>{$voiture['description']}</p>
                </article>
                <p class='retour'><a href='./voitures.php'>Retour à la liste des voitures</a></p>
            ";
    }

    else {
        echo'<h2>Sélectionnez une voiture pour en savoir plus</h2>
            <ul class="car_list">';
        echo $voitureManager->getVoitures();
        echo '</ul>';
    }

    require_once './inc/footer.html';
?>