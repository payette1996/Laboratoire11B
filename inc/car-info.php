<?php
    /*
        Ce fichier sert simplement à simuler une base de données de voitures (toutes les informations se
        trouvant dans une seule table) en attendant d'avoir une véritble base de données.
    */
       
    require_once './class/classVoiture.php';

    /*
        À défaut d'avoir une base de données, les informations des voitures sont encondées dans le tableau
        ci-dessous.
    */
    const CAR_INFO = array(
                            array(
                                    'id' => 1,
                                    'marque' => 'Chevrolet',
                                    'modele' => 'Spark',
                                    'categorie' => 'Économique',
                                    'nbPassager' => 5,
                                    'image' => 'spark.jpg',
                                    'description' => 'Louez un véhicule économique pour conduire dans les zones urbaines denses et achalandées aux espaces de stationnement serrés. Les véhicules de location de catégorie économique sont habituellement ceux qui consomment le moins de carburant.'
                                 ),
                            array(
                                    'id' => 2,
                                    'marque' => 'Kia',
                                    'modele' => 'Forte',
                                    'categorie' => 'Intermédiaire',
                                    'nbPassager' => 5,
                                    'image' => 'forte.jpg',
                                    'description' => 'Louer un véhicule intermédiaire est utile lorsqu’on a besoin d\'un peu plus d\'espace pour les passagers et le rangement que les véhicules plus petits.'
                                 ),
                            array(
                                    'id' => 3,
                                    'marque' => 'BMW',
                                    'modele' => '3',
                                    'categorie' => 'Élite pleine grandeur',
                                    'nbPassager' => 5,
                                    'image' => 'bmw3.jpg',
                                    'description' => 'Louer un véhicule élite pleine grandeur pour faire une entrée remarquée à coup sur.'
                                 ),
                            array(
                                    'id' => 4,
                                    'marque' => 'Nissan',
                                    'modele' => 'Qashqai',
                                    'categorie' => 'VUS compact',
                                    'nbPassager' => 5,
                                    'image' => 'qashqai.jpg',
                                    'description' => 'Louez un VUS compact et profitez de tarifs bas tous les jours. Un VUS compact offre tout l\'espace nécessaire pour cinq passagers tout en étant compact pour les zones à circulation dense.'
                                 ),
                            array(
                                    'id' => 5,
                                    'marque' => 'Ford',
                                    'modele' => 'Escape',
                                    'categorie' => 'VUS intermédiaire 4RM',
                                    'nbPassager' => 5,
                                    'image' => 'escape.jpg',
                                    'description' => 'Louez un VUS intermédiaire et profitez de tarifs bas tous les jours. Un VUS intermédiaire offre tout l\'espace nécessaire pour cinq passagers tout en étant assez compact pour les zones à circulation dense.'
                                 ),
                            array(
                                    'id' => 6,
                                    'marque' => 'Jeep',
                                    'modele' => 'Wrangler',
                                    'categorie' => 'Jeep',
                                    'nbPassager' => 5,
                                    'image' => 'wrangler.jpg',
                                    'description' => 'Louer un Jeep Wrangler et profitez de la liberté qu\'apporte ce type de véhicule !'
                                 )
                          );

    function selectCarById($id, $dbArray) {
        $k = array_keys($dbArray);

        for ($i = 0; $i < sizeof($k); $i++) {
            if ($id == $dbArray[$k[$i]]['id'])
                return new Voiture($dbArray[$k[$i]]);
        }

        /*
            Si on se rend jusqu'ici, c'est qu'on n'a pas quitté la fonction dans la boucle for ci-dessus.
            Ce faisant, aucune voiture n'a été trouvée pour l'ID fourni en paramètre d'entrée et il faut
            donc lever une erreur à cet effet.
        */
        throw new Exception('Aucune voiture ne correspond à votre requête.');
    }
?>