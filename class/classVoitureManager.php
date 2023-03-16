<?php
class VoitureManager
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = NULL)
    {
        if (!$pdo) {
            $dsn = (string) "mysql:host=127.0.0.1;dbname=dblocation";
            $this->pdo = new PDO($dsn, "root", "");
        }
        else {
            $this->pdo = $pdo;
        }
    }

    public function getVoitures(?int $id = NULL) : string|array
    {
        $sql = (string) "SELECT * FROM tblvoiture AS v
                         LEFT JOIN tblmarque AS m ON v.idMarque = m.idMarque
                         LEFT JOIN tblcategorie AS c ON v.idCategorie = c.idCategorie";

        if (!$id) {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $listVoitures = (string) "";
            foreach ($voitures as $voiture) {
                $listVoitures .= "
                    <li><a href='./voitures.php?idVoiture={$voiture['idVoiture']}'>{$voiture['marque']} {$voiture['modele']}</a></li>";
            }

            return (string) $listVoitures;
        } else {
            $sql .= "WHERE idVoiture = :idVoiture";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":idVoiture", $id);
            $stmt->execute();
            $voiture = $stmt->fetch(PDO::FETCH_ASSOC);

            return (array) $voiture;
        }
    }
}
?>