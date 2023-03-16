<?php
    require_once './class/classVoiture.php';

    class Reservation {
        private $_dateDebut,
                $_dateFin,
                $_voitureObj;
    
        /*
            Cette fonction ne sert qu'à valider le format des dates reçues et ne devrait donc pas être
            utilisée depuis l'extérieur de la classe (d'où le fait qu'elle est privée).
        */
        private function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);

            return ($d && ($d->format($format) == $date));
        }

        // Cette fonction ne sert qu'au constructeur (d'où le fait qu'elle est privée).
        private function set_voiture($voitureObj) {
            if (!($voitureObj instanceof Voiture))
                throw new Exception('La classe "Reservation" doit recevoir une instance de la classe "Voiture" lors de l\'appel à son constructeur.');

            $this->_voitureObj = $voitureObj;
        }

        // Constructeur
        public function __construct($dateDebut, $dateFin, $voitureObj) {
            /*
                Tous les paramètres d'entrées de ce constructeur sont obligatoires, car une réservation ne peut pas
                être créée sans une date de début, une date de fin et et une voiture. Il faudra éventuellement vérifier
                que le les dates de début et de fin d'une réservation sont cohérentes, par exemple :

                $dateDebut < $dateFin -> La date de début de la réservation doit arriver avant la date de fin.

                Cette vérification n'est pas faite dans le code actuel, car elle pourait très bien être faite avant
                une insertion en base de données (mais nous n'avons pas encore de base de données).
            */
            $this->set_dateDebut($dateDebut);
            $this->set_dateFin($dateFin);
            $this->set_voiture($voitureObj);
        }

        // Accesseurs ("getters")
        public function get_dateDebut() { return $this->_dateDebut; }
        public function get_dateFin() { return $this->_dateFin; }
        public function get_voiture() { return $this->_voitureObj; }

        // Mutateurs ("setters") publics
        public function set_dateDebut($dateDebut) {
            if (!$this->validateDate($dateDebut))
                throw new Exception('La date de début d\'une réservation doit être une chaîne de caratères au format "Y-m-d".');

            $this->_dateDebut = $dateDebut;
        }

        public function set_dateFin($dateFin) {
            if (!$this->validateDate($dateFin))
                throw new Exception('La date de fin d\'une réservation doit être une chaîne de caratères au format "Y-m-d".');

            $this->_dateFin = $dateFin;
        }
        
        public function print_reservation_info() {
            echo '<ul>
                    <li><strong>Date de début :</strong> ' . $this->_dateDebut . '</li>
                    <li><strong>Date de fin :</strong> ' . $this->_dateFin . '</li>
                    <li><strong>Informations sur la voiture :</strong>';
                $this->_voitureObj->print_voiture_info();
            echo '  </li>
                  </ul>';
        }
    };
?>