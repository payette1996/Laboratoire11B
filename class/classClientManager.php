<?php
require_once "classClient.php";

class ClientManager
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = NULL)
    {
        if ($pdo === NULL) {
            $dsn = (string) "mysql:host=127.0.0.1;dbname=dblocation";
            $this->pdo = new PDO($dsn, "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        else {
            $this->pdo = $pdo;
        }
    }

    public function addClient(Client $client) : bool
    {
        $this->pdo->beginTransaction();
        try {
            // noPorte, rue
            $regex = "/^(\d+)\s+(.+)/";
            $address = $client->get_adresse();
            preg_match($regex, $address, $matches);

            $noPorte = $matches[1];
            $rue = $matches[2];

            // tblpays
            $sql = (string) "SELECT idPays FROM tblpays WHERE pays = :pays";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":pays", $client->get_pays());
            $stmt->execute();

            $idPays = $stmt->fetchColumn();

            if (!$idPays) {
                $sql = "INSERT INTO tblpays (pays) VALUES (:pays)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(":pays", $client->get_pays());
                $stmt->execute();

                $idPays = $this->pdo->lastInsertId();
            }

            // INSERT tbladresse
            $sql = (string) "INSERT INTO tbladresse (noPorte, rue, ville, province, codePostal, idPays)
            VALUES (:noPorte, :rue, :ville, :province, :codePostal, :idPays)";
            
            $stmt = $this->pdo->prepare($sql);
            
            $data = [
            ":noPorte"    => $noPorte,
            ":rue"        => $rue,
            ":ville"      => $client->get_ville(),
            ":province"   => $client->get_province(),
            ":codePostal" => $client->get_codePostal(),
            ":idPays"     => $idPays
            ];

            foreach ($data as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();

            $idAdresse = $this->pdo->lastInsertId();

            // tbltypetel
            $sql = (string) "SELECT idTypeTel FROM tbltypetel WHERE typeTel = :typeTel";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":typeTel", $client->get_typeTelephone());
            $stmt->execute();

            $idTypeTel = $stmt->fetchColumn();

            // INSERT client
            $sql = (string) 
                "INSERT INTO tblclient (
                    prenom,
                    nom,
                    courriel,
                    mdp,
                    idAdresse,
                    idTypeTel,
                    tel,
                    idPaysDelivrance,
                    noPermis,
                    dateNaissance,
                    dateExp,
                    infolettre,
                    modalite,
                    dateCreation
                )
                VALUES (
                    :prenom,
                    :nom,
                    :courriel,
                    :mdp,
                    :idAdresse,
                    :idTypeTel,
                    :tel,
                    :idPaysDelivrance,
                    :noPermis,
                    :dateNaissance,
                    :dateExp,
                    :infolettre,
                    :modalite,
                    :dateCreation
                )";

            $stmt = $this->pdo->prepare($sql);
            
            $data = [
                ":prenom" => $client->get_prenom(),
                ":nom" => $client->get_nom(),
                ":courriel" => $client->get_courriel(),
                ":mdp" => $client->get_motPasse(),
                ":idAdresse" => $idAdresse,
                ":idTypeTel" => $idTypeTel,
                ":tel" => $client->get_telephone(),
                ":idPaysDelivrance" => $idPays,
                ":noPermis" => $client->get_permis(),
                ":dateNaissance" => $client->get_dateNaissance(),
                ":dateExp" => $client->get_dateExpiration(),
                ":infolettre" => $client->get_promotions(),
                ":modalite" => $client->get_modalites(),
                ":dateCreation" => date('Y-m-d')
            ];

            foreach ($data as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();

            $this->pdo->commit();

            return true;

        } catch (PDOException $error) {
            $this->pdo->rollback();
            throw $error;
            // return false;
        }
    }
}
?>