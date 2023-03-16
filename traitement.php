<?php
    if (session_status() === PHP_SESSION_NONE)
        session_start();

    require_once './class/classInscription.php';
    require_once './class/classClient.php';
    require_once './inc/car-info.php';

    // Si le formulaire provient de la page "Inscription"
    if (isset($_POST['action']) && $_POST['action'] === 'inscription') {
        require_once './inc/header.php';

        $inscriptionObj = new Inscription($_POST);

        echo '<h1>Informations reçues !</h1>';
        $inscriptionObj->print_inscription_info();

        if (isset($_SESSION['acces'])) {
            $accesArray = unserialize($_SESSION['acces']);

            if (in_array($inscriptionObj->get_courriel(), $accesArray['courriel']))
                echo '<p class="erreur">L\'inscription a échoué, car un utilisateur avec un courriel identique est déjà enregistré.</p>';
            
            else {
                array_push($accesArray['courriel'], $inscriptionObj->get_courriel());
                array_push($accesArray['mot_passe'], $inscriptionObj->get_motPasse());
                $_SESSION['acces'] = serialize($accesArray);
            }
        }
        
        else {
            $_SESSION['acces'] = serialize(array('courriel'  => array($inscriptionObj->get_courriel()),
                                                 'mot_passe' => array($inscriptionObj->get_motPasse())));
        }
    }

    // Si le formulaire provient de la page "Se connecter"
    else if (isset($_POST['action']) && $_POST['action'] === 'connexion') {
        $accesArray = unserialize($_SESSION['acces']);
        $accesEstValide = false;

        for ($i = 0; $i < count($accesArray['courriel']); $i++) {
            if (($accesArray['courriel'][$i] === $_POST['user_email']) &&
                (password_verify($_POST['connect_pass'], $accesArray['mot_passe'][$i]))) {
                    $accesEstValide = true;
                    break;
                }
        }
        
        if ($accesEstValide) {
            $clientObj = new Client($_POST['user_email']);
            $_SESSION['utilisateur'] = serialize($clientObj);
            
            require_once './inc/header.php';
            echo '<h1>Informations reçues !</h1>
                  <h2>Bienvenue ' . $clientObj->get_courriel() . '</h2>';
        }

        else {
            header('refresh: 0; url = login.php?erreur=1');
            exit;
        }
    }

    // Si le formulaire provient de la page "Réserver une voiture"
    else if (isset($_POST['action']) && $_POST['action'] === 'reservation') {
        require_once './inc/header.php';

        $clientObj = unserialize($_SESSION['utilisateur']);
        $voitureObj = selectCarById($_POST['voiture'], CAR_INFO);

        $reservationObj = new Reservation($_POST['dateDebut'], $_POST['dateFin'], $voitureObj);
        $clientObj->add_reservation($reservationObj);

        echo '<h1>Informations reçues !</h1>
              <h2>Merci pour votre confiance ' . $clientObj->get_courriel() . ' !</h2>
              <h3>Résumé de votre toute dernière réservation</h3>';
        
        $clientObj->get_reservation($clientObj->get_nbReservations() - 1)->print_reservation_info();
        $_SESSION['utilisateur'] = serialize($clientObj);
    }

    // Si l'utilisateur a cliqué sur un des boutons "Supprimer cette réservation".
    else if (isset($_GET['action']) && $_GET['action'] === 'suppression') {
        if (isset($_GET['id'])) {
            $clientObj = unserialize($_SESSION['utilisateur']);
            $clientObj->delete_reservation($_GET['id']);
            $_SESSION['utilisateur'] = serialize($clientObj);

            header('refresh: 0; url = mes-reservations.php');
            exit;
        }

        header('refresh: 0; url = mes-reservations.php?erreur=1');
        exit;
    }
  
    // Si l'utilisateur a cliqué sur le lien "Se déconnecter".
    else if (isset($_GET['action']) && $_GET['action'] === 'fermer') {
        $_SESSION = array();
        session_destroy();

        /*
            On charge le "header" à cet emplacement pour que le lien "Se connecter" apparaisse (plutôt que
            "Se déconnecter") puisque la session a maintenant été fermée.
        */
        require_once './inc/header.php';
        echo '<h1>Vous avez été déconnecté !</h1>';
    }
  
    /*
        Si la page "traitement.php" a été appelée sans passer par les formulaires ou le lien précédemment
        énumérés, le message suivant s'affiche.
    */
    else {
        require_once './inc/header.php';
        echo '<h1>Aucune information n\'a été traitée !</h1>';
    }

    require_once './inc/footer.html';
?>