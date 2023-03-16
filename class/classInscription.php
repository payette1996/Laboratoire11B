<?php
    class Inscription {
        private $_prenom,
                $_nom,
                $_courriel,
                $_motPasse,
                $_pays,
                $_adresse,
                $_ville,
                $_province,
                $_codePostal,
                $_typeTelephone,
                $_telephone,
                $_paysDelivrance,
                $_permis,
                $_dateNaissance,
                $_dateExpiration,
                $_promotions,
                $_modalites;

        /*
            Cette fonction ne sert qu'à valider le format des dates reçues et ne devrait donc pas être
            utilisée depuis l'extérieur de la classe (d'où le fait qu'elle est privée).
        */
        private function validateDate($date, $format = 'Y-m-d') {
            $d = DateTime::createFromFormat($format, $date);

            return ($d && ($d->format($format) == $date));
        }

        // Constructeur
        public function __construct(array $params = array()) {
            /*
                On s'attend à ce que le tableau associatif $params contienne les éléments suivants lorsqu'il
                est pleinement rempli :

                [ 
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'courriel' => $courriel,
                    'motPasse' => $motPasse,
                    'pays' => $pays,
                    'adresse' => $adresse,
                    'ville' => $ville,
                    'province' => $province
                    'codePostal' => $codePostal
                    'typeTelephone' => $typeTelephone,
                    'telephone' => $telephone,
                    'paysDelivrance' => $paysDelivrance,
                    'permis' => $permis,
                    'dateNaissance' => $dateNaissance,
                    'dateExpiration' => $dateExpiration,
                    'promotions' => $promotions,
                    'modalites' => $modalites
                ]
            */

            foreach ($params as $k => $v) {
                $methodName = 'set_' . $k;

                if (method_exists($this, $methodName))
                    $this->$methodName($v);
            }

            /*
                On appelle les méthodes suivantes si le tableau associatif $params est pleinement rempli :
                
                $this->set_prenom($prenom);
                $this->set_nom($nom);
                $this->set_courriel($courriel);
                $this->set_motPasse($motPasse);
                $this->set_pays($pays);
                $this->set_adresse($adresse);
                $this->set_ville($ville);
                $this->set_province($province);
                $this->set_codePostal($codePostal);
                $this->set_typeTelephone($typeTelephone);
                $this->set_telephone($telephone);
                $this->set_paysDelivrance($paysDelivrance);
                $this->set_permis($permis);
                $this->set_dateNaissance($dateNaissance);
                $this->set_dateExpiration($dateExpiration);
                $this->set_promotions($promotions);
                $this->set_modalites($modalites);
            */
        }

        // Accesseurs ("getters")
        public function get_prenom() { return $this->_prenom; }
        public function get_nom() { return $this->_nom; }
        public function get_courriel() { return $this->_courriel; }
        public function get_motPasse() { return $this->_motPasse; }
        public function get_pays() { return $this->_pays; }
        public function get_adresse() { return $this->_adresse; }
        public function get_ville() { return $this->_ville; }
        public function get_province() { return $this->_province; }
        public function get_codePostal() { return $this->_codePostal; }
        public function get_typeTelephone() { return $this->_typeTelephone; }
        public function get_telephone() { return $this->_telephone; }
        public function get_paysDelivrance() { return $this->_paysDelivrance; }
        public function get_permis() { return $this->_permis; }
        public function get_dateNaissance() { return $this->_dateNaissance; }
        public function get_dateExpiration() { return $this->_dateExpiration; }
        public function get_promotions() { return $this->_promotions; }
        public function get_modalites() { return $this->_modalites; }

        // Mutateurs ("setters") publics
        public function set_prenom($prenom) {
            if (!is_string($prenom) || empty($prenom))
                throw new Exception('Le prénom lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_prenom = htmlspecialchars($prenom);
        }

        public function set_nom($nom) {
            if (!is_string($nom) || empty($nom))
                throw new Exception('Le nom lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_nom = htmlspecialchars($nom);
        }

        public function set_courriel($courriel) {
            if (!is_string($courriel) || empty($courriel))
                throw new Exception('Le courriel lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_courriel = htmlspecialchars($courriel);
        }

        public function set_motPasse($motPasse) {
            if (!is_string($motPasse) || empty($motPasse))
                throw new Exception('Le mot de passe lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_motPasse = password_hash($motPasse, PASSWORD_DEFAULT);
        }

        public function set_pays($pays) {
            if (!is_string($pays) || empty($pays))
                throw new Exception('Le pays lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_pays = htmlspecialchars($pays);
        }

        public function set_adresse($adresse) {
            if (!is_string($adresse) || empty($adresse))
                throw new Exception('L\'adresse lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_adresse = htmlspecialchars($adresse);
        }

        public function set_ville($ville) {
            if (!is_string($ville) || empty($ville))
                throw new Exception('La ville lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_ville = htmlspecialchars($ville);
        }

        public function set_province($province) {
            if (!is_string($province) || empty($province))
                throw new Exception('La province lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_province = htmlspecialchars($province);
        }

        public function set_codePostal($codePostal) {
            if (!is_string($codePostal) || empty($codePostal))
                throw new Exception('Le code postal lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_codePostal = htmlspecialchars($codePostal);
        }

        public function set_typeTelephone($typeTelephone) {
            if (!is_string($typeTelephone) || empty($typeTelephone))
                throw new Exception('Le type de téléphone lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_typeTelephone = $typeTelephone;
        }

        public function set_telephone($telephone) {
            if (!is_string($telephone) || empty($telephone))
                throw new Exception('Le numéro de téléphone lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_telephone = htmlspecialchars($telephone);
        }

        public function set_paysDelivrance($paysDelivrance) {
            if (!is_string($paysDelivrance) || empty($paysDelivrance))
                throw new Exception('Le pays de délivrance du permis de conduire lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_paysDelivrance = $paysDelivrance;
        }

        public function set_permis($permis) {
            if (!is_string($permis) || empty($permis))
                throw new Exception('Le numéro du permis de conduire lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->_permis = htmlspecialchars($permis);
        }

        public function set_dateNaissance($dateNaissance) {
            if (!$this->validateDate($dateNaissance))
                throw new Exception('La date de naissance lors de l\'inscription doit être une chaîne de caratères au format "Y-m-d".');

            $this->_dateNaissance = $dateNaissance;
        }

        public function set_dateExpiration($dateExpiration) {
            if (!$this->validateDate($dateExpiration))
                throw new Exception('La date d\'expiration du permis de conduire lors de l\'inscription doit être une chaîne de caratères au format "Y-m-d".');

            $this->_dateExpiration = $dateExpiration;
        }

        public function set_promotions($promotions) {
            if ($promotions !== 'Oui')
                throw new Exception('L\'acceptation de l\'infolettre lors de l\'inscription devrait présenter la valeur "Oui".');

            $this->_promotions = $promotions;
        }

        public function set_modalites($modalites) {
            if ($modalites !== 'Oui')
                throw new Exception('L\'acceptation des modalités lors de l\'inscription devrait présenter la valeur "Oui".');

            $this->_modalites = $modalites;
        }

        public function print_inscription_info() {
            echo '<ul>
                    <li>Profil :
                        <ul>
                            <li><strong>Prénom :</strong> ' . $this->_prenom . '</li>
                            <li><strong>Nom :</strong> ' . $this->_nom . '</li>
                            <li><strong>Courriel :</strong> ' . $this->_courriel . '</li>
                            <li><strong>Mot de passe hashé :</strong> ' . $this->_motPasse . '</li>
                        </ul>
                    </li>
                    <li>Coordonnées :
                        <ul>
                            <li><strong>Pays :</strong> ' . $this->_pays . '</li>
                            <li><strong>Adresse :</strong> ' . $this->_adresse . '</li>
                            <li><strong>Ville :</strong> ' . $this->_ville . '</li>
                            <li><strong>Province :</strong> ' . $this->_province . '</li>
                            <li><strong>Code postal :</strong> ' . $this->_codePostal . '</li>
                            <li><strong>Type de téléphone :</strong> ' . $this->_typeTelephone . '</li>
                            <li><strong>Numéro de téléphone :</strong> ' . $this->_telephone . '</li>
                        </ul>
                    </li>
                    <li>Informations du conducteur :
                        <ul>
                            <li><strong>Pays de délivrance :</strong> ' . $this->_paysDelivrance . '</li>
                            <li><strong>Date de naissance :</strong> ' . $this->_dateNaissance . '</li>
                            <li><strong>Numéro de permis :</strong> ' . $this->_permis . '</li>
                            <li><strong>Date d\'expiration :</strong> ' . $this->_dateExpiration . '</li>
                        </ul>
                    </li>
                    <li>Préférences :
                        <ul>
                            <li><strong>Infolettre :</strong> ' . (empty($this->_promotions) ? 'Non' : $this->_promotions) . '</li>
                            <li><strong>Modalités :</strong> ' . (empty($this->_modalites) ? 'Non' : $this->_modalites) . '</li>
                        </ul>
                    </li>
                  </ul>';
        }
    };
?>