<form action="./traitement.php" method="post" class="location">
    <div class="grille">
        <label for="dateDebut">Début de location :</label>
        <input type="date" name="dateDebut" id="dateDebut" required />

        <label for="dateFin">Fin de location :</label>
        <input type="date" name="dateFin" id="dateFin" required />

        <div>
            <hr />
            <p>Sélectionnez votre voiture :</p>
        </div>
    </div>

    <?php
        require_once './inc/car-info.php';

        echo '<div class="flexible">';

        for ($i = 0; $i < sizeof(CAR_INFO); $i++) {
            $voitureObj = selectCarById(($i + 1), CAR_INFO);

            $carId = $voitureObj->get_id();
            $carImage = $voitureObj->get_image();
            $carName = $voitureObj->get_marque() . ' ' . $voitureObj->get_modele();

            echo '<div class="grille">
                    <input type="radio" name="voiture" value="' . $carId . '" id="' . $carId . '" required />
                    <label for="' . $carId . '" class="flexible">
                        <img src="./inc/img/' . $carImage . '" alt="' . $carName . '" />
                        <strong>' . $carName . '</strong>
                    </label>
                  </div>';
        }

        echo '</div>';
    ?>

    <input type="hidden" name="action" value="reservation" />
    <button type="submit">Réserver la voiture</button>
</form>