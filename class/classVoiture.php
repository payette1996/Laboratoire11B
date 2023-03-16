<?php
    class Voiture {
        private $_id,
                $_marque,
                $_modele,
                $_categorie,
                $_nbPassager,
                $_image,
                $_description;
        
        private function set_id($id) {
            if (!is_int($id) || ($id <= 0))
                throw new Exception('L\'identifiant de la voiture doit être un nombre entier supérieur à zéro.');

            $this->_id = $id;
        }

        // Constructeur
        public function __construct(array $params = array()) {
            /*
                On s'attend à ce que le tableau associatif $params contienne les éléments suivants lorsqu'il est
                pleinement rempli :

                [ 
                    'id' => $id,
                    'marque' => $marque,
                    'modele' => $modele,
                    'categorie' => $categorie,
                    'nbPassager' => $nbPassager,
                    'image' => $image,
                    'description' => $description
                ]
            */

            foreach ($params as $k => $v) {
                $methodName = 'set_' . $k;

                if (method_exists($this, $methodName))
                    $this->$methodName($v);
            }

            /*
                On appelle les méthodes suivantes si le tableau associatif $params est pleinement rempli :
                
                $this->set_id($id);
                $this->set_marque($marque);
                $this->set_modele($modele);
                $this->set_categorie($categorie);
                $this->set_nbPassager($nbPassager);
                $this->set_image($image);
                $this->set_description($description);
            */
        }

        // Accesseurs ("getters")
        public function get_id() { return $this->_id; }
        public function get_marque() { return $this->_marque; }
        public function get_modele() { return $this->_modele; }
        public function get_categorie() { return $this->_categorie; }
        public function get_nbPassager() { return $this->_nbPassager; }
        public function get_image() { return $this->_image; }
        public function get_description() { return $this->_description; }

        // Mutateurs ("setters") publics
        public function set_marque($marque) {
            if (!is_string($marque) || empty($marque))
                throw new Exception('La marque de la voiture doit être une chaîne de caractères non vide.');

            $this->_marque = $marque;
        }

        public function set_modele($modele) {
            if (!is_string($modele) || empty($modele))
                throw new Exception('Le modèle de la voiture doit être une chaîne de caractères non vide.');

            $this->_modele = $modele;
        }

        public function set_categorie($categorie) {
            if (!is_string($categorie) || empty($categorie))
                throw new Exception('La catégorie de la voiture doit être une chaîne de caractères non vide.');

            $this->_categorie = $categorie;
        }

        public function set_nbPassager($nbPassager) {
            if (!is_int($nbPassager) || ($nbPassager <= 0))
                throw new Exception('Le nombre de passagers de la voiture doit être un nombre entier supérieur à zéro.');

            $this->_nbPassager = $nbPassager;
        }

        public function set_image($image) {
            if (!is_string($image) || empty($image))
                throw new Exception('L\'image la voiture doit être une chaîne de caractères non vide');

            $this->_image = $image;
        }

        public function set_description($description) {
            if (!is_string($description) || empty($description))
                throw new Exception('La description de la voiture doit être une chaîne de caractères non vide.');

            $this->_description = $description;
        }

        public function print_voiture_info() {
            echo '<ul>
                    <li><strong>Numéro d\'identification :</strong> ' . $this->_id . '</li>
                    <li><strong>Marque :</strong> ' . $this->_marque . '</li>
                    <li><strong>Modele :</strong> ' . $this->_modele . '</li>
                    <li><strong>Categorie :</strong> ' . $this->_categorie . '</li>
                    <li><strong>Nombre de passagers :</strong> ' . $this->_nbPassager . '</li>
                    <li><strong>Nom de l\'image :</strong> ' . $this->_image . '</li>
                    <li><strong>Description :</strong> ' . $this->_description . '</li>
                  </ul>';
        }
    };
?>