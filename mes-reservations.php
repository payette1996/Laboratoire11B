<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './inc/header.php';
    require_once './class/classClient.php';

    if (isset($_SESSION['utilisateur'])) {
        $clientObj = unserialize($_SESSION['utilisateur']);
        $nbReservations = $clientObj->get_nbReservations();

        if ($nbReservations) {
            echo '<h1>Vos réservations</h1>' .
                    (isset($_GET['erreur']) ? '<p class="erreur">La suppression demandée n\'a pas été effectuée.</p>' : '');

            for ($i = 0; $i < $nbReservations; $i++) {
                $reservationObj = $clientObj->get_reservation($i);
                $voitureObj = $reservationObj->get_voiture();

                echo '<ul>
                        <li><strong>Date de début :</strong> ' . $reservationObj->get_dateDebut() . '</li>
                        <li><strong>Date de fin :</strong> ' . $reservationObj->get_dateFin() . '</li>
                        <li><strong>Voiture sélectionnée :</strong> ' . $voitureObj->get_marque() .
                            ' ' . $voitureObj->get_modele(). '</li>
                      </ul>
                      <img src="./inc/img/' . $voitureObj->get_image() . '" alt="' . $voitureObj->get_marque() .
                            ' ' . $voitureObj->get_modele() . '" />
                      <a href="./traitement.php?action=suppression&id=' . $i . '" class="suppression">Supprimer cette réservation</a>';
            }
        }

        else
            echo '<h1>Vous n\'avez encore aucune réservation. Veuillez S.V.P. en faire une</h1>';
    }

    else
        echo '<h1>Veuillez vous connecter pour visualiser le contenu de cette page</h1>';

    require_once './inc/footer.html';
?>