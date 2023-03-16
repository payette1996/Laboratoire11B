<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';
    require_once './inc/car-info.php';

    echo '<h1>Voitures disponibles</h1>';

    if (isset($_GET['idVoiture'])) {
        $voitureObj = selectCarById($_GET['idVoiture'], CAR_INFO);

        echo '<article class="grille">
                <h2>' . $voitureObj->get_marque() . ' ' . $voitureObj->get_modele() . ' - ' .
                    $voitureObj->get_categorie() . '</h2>
                <img src="./inc/img/' . $voitureObj->get_image() . '" alt="' . $voitureObj->get_marque() .
                    ' ' . $voitureObj->get_modele() . '" />
                <p><strong>Passager :</strong> ' . $voitureObj->get_nbPassager() . '</p>
                <p><strong>Description :</strong> ' . $voitureObj->get_description() . '</p>
              </article>
              <p class="retour"><a href="./voitures.php">Retour à la liste des voitures</a></p>';
    }

    else {
        echo '<h2>Sélectionnez une voiture pour en savoir plus</h2>
              <ul class="car_list">';

        for ($i = 0; $i < sizeof(CAR_INFO); $i++) {
            $voitureObj = selectCarById(($i + 1), CAR_INFO);

            echo '<li><a href="./voitures.php?idVoiture=' . $voitureObj->get_id() . '">' .
                    $voitureObj->get_marque() . ' ' . $voitureObj->get_modele() . '</a></li>';
        }
    
        echo '</ul>';
    }

    require_once './inc/footer.html';
?>