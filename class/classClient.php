<?php
    class Client {
        private $prenom,
                $nom,
                $courriel,
                $motPasse,
                $pays,
                $adresse,
                $ville,
                $province,
                $codePostal,
                $typeTelephone,
                $telephone,
                $paysDelivrance,
                $permis,
                $dateNaissance,
                $dateExpiration,
                $promotions,
                $modalites;

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
        public function get_prenom() { return $this->prenom; }
        public function get_nom() { return $this->nom; }
        public function get_courriel() { return $this->courriel; }
        public function get_motPasse() { return $this->motPasse; }
        public function get_pays() { return $this->pays; }
        public function get_adresse() { return $this->adresse; }
        public function get_ville() { return $this->ville; }
        public function get_province() { return $this->province; }
        public function get_codePostal() { return $this->codePostal; }
        public function get_typeTelephone() { return $this->typeTelephone; }
        public function get_telephone() { return $this->telephone; }
        public function get_paysDelivrance() { return $this->paysDelivrance; }
        public function get_permis() { return $this->permis; }
        public function get_dateNaissance() { return $this->dateNaissance; }
        public function get_dateExpiration() { return $this->dateExpiration; }
        public function get_promotions() { return $this->promotions; }
        public function get_modalites() { return $this->modalites; }

        // Mutateurs ("setters") publics
        public function set_prenom($prenom) {
            if (!is_string($prenom) || empty($prenom))
                throw new Exception('Le prénom lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->prenom = htmlspecialchars($prenom);
        }

        public function set_nom($nom) {
            if (!is_string($nom) || empty($nom))
                throw new Exception('Le nom lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->nom = htmlspecialchars($nom);
        }

        public function set_courriel($courriel) {
            if (!is_string($courriel) || empty($courriel))
                throw new Exception('Le courriel lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->courriel = htmlspecialchars($courriel);
        }

        public function set_motPasse($motPasse) {
            if (!is_string($motPasse) || empty($motPasse))
                throw new Exception('Le mot de passe lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->motPasse = password_hash($motPasse, PASSWORD_DEFAULT);
        }

        public function set_pays($pays) {
            if (!is_string($pays) || empty($pays))
                throw new Exception('Le pays lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->pays = htmlspecialchars($pays);
        }

        public function set_adresse($adresse) {
            if (!is_string($adresse) || empty($adresse))
                throw new Exception('L\'adresse lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->adresse = htmlspecialchars($adresse);
        }

        public function set_ville($ville) {
            if (!is_string($ville) || empty($ville))
                throw new Exception('La ville lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->ville = htmlspecialchars($ville);
        }

        public function set_province($province) {
            if (!is_string($province) || empty($province))
                throw new Exception('La province lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->province = htmlspecialchars($province);
        }

        public function set_codePostal($codePostal) {
            if (!is_string($codePostal) || empty($codePostal))
                throw new Exception('Le code postal lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->codePostal = htmlspecialchars($codePostal);
        }

        public function set_typeTelephone($typeTelephone) {
            if (!is_string($typeTelephone) || empty($typeTelephone))
                throw new Exception('Le type de téléphone lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->typeTelephone = $typeTelephone;
        }

        public function set_telephone($telephone) {
            if (!is_string($telephone) || empty($telephone))
                throw new Exception('Le numéro de téléphone lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->telephone = htmlspecialchars($telephone);
        }

        public function set_paysDelivrance($paysDelivrance) {
            if (!is_string($paysDelivrance) || empty($paysDelivrance))
                throw new Exception('Le pays de délivrance du permis de conduire lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->paysDelivrance = $paysDelivrance;
        }

        public function set_permis($permis) {
            if (!is_string($permis) || empty($permis))
                throw new Exception('Le numéro du permis de conduire lors de l\'inscription doit être une chaîne de caractères non vide.');

            $this->permis = htmlspecialchars($permis);
        }

        public function set_dateNaissance($dateNaissance) {
            if (!$this->validateDate($dateNaissance))
                throw new Exception('La date de naissance lors de l\'inscription doit être une chaîne de caratères au format "Y-m-d".');

            $this->dateNaissance = $dateNaissance;
        }

        public function set_dateExpiration($dateExpiration) {
            if (!$this->validateDate($dateExpiration))
                throw new Exception('La date d\'expiration du permis de conduire lors de l\'inscription doit être une chaîne de caratères au format "Y-m-d".');

            $this->dateExpiration = $dateExpiration;
        }

        public function set_promotions($promotions) {
            if ($promotions !== 'Oui')
                throw new Exception('L\'acceptation de l\'infolettre lors de l\'inscription devrait présenter la valeur "Oui".');

            $this->promotions = $promotions;
        }

        public function set_modalites($modalites) {
            if ($modalites !== 'Oui')
                throw new Exception('L\'acceptation des modalités lors de l\'inscription devrait présenter la valeur "Oui".');

            $this->modalites = $modalites;
        }

        public function print_inscription_info() {
            echo '<ul>
                    <li>Profil :
                        <ul>
                            <li><strong>Prénom :</strong> ' . $this->prenom . '</li>
                            <li><strong>Nom :</strong> ' . $this->nom . '</li>
                            <li><strong>Courriel :</strong> ' . $this->courriel . '</li>
                            <li><strong>Mot de passe hashé :</strong> ' . $this->motPasse . '</li>
                        </ul>
                    </li>
                    <li>Coordonnées :
                        <ul>
                            <li><strong>Pays :</strong> ' . $this->pays . '</li>
                            <li><strong>Adresse :</strong> ' . $this->adresse . '</li>
                            <li><strong>Ville :</strong> ' . $this->ville . '</li>
                            <li><strong>Province :</strong> ' . $this->province . '</li>
                            <li><strong>Code postal :</strong> ' . $this->codePostal . '</li>
                            <li><strong>Type de téléphone :</strong> ' . $this->typeTelephone . '</li>
                            <li><strong>Numéro de téléphone :</strong> ' . $this->telephone . '</li>
                        </ul>
                    </li>
                    <li>Informations du conducteur :
                        <ul>
                            <li><strong>Pays de délivrance :</strong> ' . $this->paysDelivrance . '</li>
                            <li><strong>Date de naissance :</strong> ' . $this->dateNaissance . '</li>
                            <li><strong>Numéro de permis :</strong> ' . $this->permis . '</li>
                            <li><strong>Date d\'expiration :</strong> ' . $this->dateExpiration . '</li>
                        </ul>
                    </li>
                    <li>Préférences :
                        <ul>
                            <li><strong>Infolettre :</strong> ' . (empty($this->promotions) ? 'Non' : $this->promotions) . '</li>
                            <li><strong>Modalités :</strong> ' . (empty($this->modalites) ? 'Non' : $this->modalites) . '</li>
                        </ul>
                    </li>
                  </ul>';
        }
    };
?>