<!DOCTYPE html>
<html lang="fr-ca">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./inc/css/style.css" />
        <title>Location de voitures</title>
    </head>

    <body>
        <main>
            <header>
                <div class="flexible">
                    <a href="./register.php">Inscription</a>

                    <?php
                        if (isset($_SESSION['utilisateur']))
                            echo '<a href="./traitement.php?action=fermer">Se déconnecter</a>';
                        
                        else
                            echo '<a href="./login.php">Se connecter</a>';
                    ?>
                </div>

                <nav>
                    <ul class="flexible">
                        <li>
                            <a href="./index.php">Accueil</a>
                        </li>
                        <li>
                            <a href="./voitures.php">Les voitures</a>
                        </li>
                        <li>
                            <a href="./reservation.php">Réserver une voiture</a>
                        </li>
                        <li>
                            <a href="./mes-reservations.php">Mes réservations</a>
                        </li>
                    </ul>
                </nav>

                <img src="./inc/img/logo.jpg" alt="Banière du site" />
            </header>