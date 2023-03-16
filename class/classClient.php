<?php
    require_once './class/classReservation.php';

    class Client {
        private $_courriel,
                $_reservationObjArray;
        
        /*
            On ne souhaite pas pouvoir modifier le courriel d'un client une fois l'instance de la
            classe "Client" construite. C'est pourquoi le mutateur ("setter") du courriel a été
            mis privé ("private").
        */
        private function set_courriel($courriel) {
            if (!is_string($courriel) || empty($courriel))
                throw new Exception('Le courriel du client doit être une chaîne de caractères non vide.');

            $this->_courriel = $courriel;
        }

        private function is_same_reservation($reservationObj) {
            for ($i = 0; $i < $this->get_nbReservations(); $i++) {
                if (($this->get_reservation($i)->get_dateDebut() === $reservationObj->get_dateDebut()) &&
                    ($this->get_reservation($i)->get_dateFin() === $reservationObj->get_dateFin()) &&
                    ($this->get_reservation($i)->get_voiture()->get_id() === $reservationObj->get_voiture()->get_id()))
                    return true;
            }

            return false;
        }

        // Constructeur
        public function __construct($courriel) {
            $this->set_courriel($courriel);
            $this->_reservationObjArray = array();
        }

        // Accesseurs ("getters")
        public function get_courriel() { return $this->_courriel; }
        public function get_nbReservations() { return count($this->_reservationObjArray); }
        public function get_reservation($index) {
            if (($index < 0) || ($index >= $this->get_nbReservations()))
                throw new Exception('L\'index permettant d\'accéder à une des réservations du client doit être un nombre entier se retrouvant à l\'intérieur des limite du tableau des réservations.');

            return $this->_reservationObjArray[$index];
        }

        public function add_reservation($reservationObj) {
            if (!($reservationObj instanceof Reservation))
                throw new Exception('La classe "Client" doit recevoir une instance de la classe "Reservation" lors de l\'appel à son constructeur.');
      
            if (!$this->is_same_reservation($reservationObj))
                array_push($this->_reservationObjArray, $reservationObj);
        }

        public function delete_reservation($index) {
            if (($index < 0) || ($index >= $this->get_nbReservations()))
                throw new Exception('L\'index permettant de supprimer une réservation spécifique du client doit être un nombre entier se retrouvant à l\'intérieur des limite du tableau des réservations.');
      
            unset($this->_reservationObjArray[$index]);
	        $this->_reservationObjArray = array_values($this->_reservationObjArray);
        }

        public function print_client_info() {
            echo '<ul>
                    <li><strong>Courriel :</strong> ' . $this->_courriel . '</li>';

            for ($i = 0; $i < $this->get_nbReservations(); $i++) {
                echo '<li><strong>Informations sur la réservation #' . ($i + 1) . ' :</strong>';
                $this->get_reservation($i)->print_reservation_info();
                echo '</li>';
            }

            echo '</ul>';
        }
  };
?>