###############################################################
# Création de la base de données pour la location de voitures #
###############################################################
CREATE DATABASE IF NOT EXISTS dbLocation
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE dbLocation;

###############################################################
# Ajout des tables dans la base de données précédemment créée #
###############################################################
CREATE TABLE IF NOT EXISTS tblClient (
	idClient INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	prenom VARCHAR(255) NOT NULL,
	nom VARCHAR(255) NOT NULL,
	courriel VARCHAR(255) NOT NULL,
	mdp VARCHAR(255) NOT NULL,
	idAdresse INT(11) UNSIGNED NOT NULL,
	idTypeTel INT(11) UNSIGNED NOT NULL,
	tel VARCHAR(25),
	idPaysDelivrance INT(11) UNSIGNED NOT NULL,
	noPermis VARCHAR(25),
	dateNaissance DATE,
	dateExp DATE,
	infolettre BIT(1),
	modalite BIT(1),
	dateCreation DATE NOT NULL,
	CONSTRAINT UN_courriel_mdp_tblClient UNIQUE (courriel, mdp),
	CONSTRAINT UN_noPermis_tblClient UNIQUE (noPermis)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblReservation (
	idReservation INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idClient INT(11) UNSIGNED NOT NULL,
	idVoiture INT(11) UNSIGNED NOT NULL,
	dateDebut DATE NOT NULL,
	dateFin DATE NOT NULL,
	CONSTRAINT CK_dateDebutFin_tblReservation CHECK (dateDebut <= dateFin)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblVoiture (
	idVoiture INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idMarque INT(11) UNSIGNED NOT NULL,
	modele VARCHAR(255) NOT NULL,
	idCategorie INT(11) UNSIGNED NOT NULL,
	nbPassager TINYINT(255) UNSIGNED,
	image VARCHAR(255),
	description TEXT
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblAdresse (
	idAdresse INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	noPorte VARCHAR(15),
	rue VARCHAR(255),
	ville VARCHAR(255),
	province VARCHAR(255),
	codePostal VARCHAR(7),
	idPays INT(11) UNSIGNED NOT NULL
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblMarque (
	idMarque INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	marque VARCHAR(255) NOT NULL,
	CONSTRAINT UN_marque_tblMarque UNIQUE (marque)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblCategorie (
	idCategorie INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categorie VARCHAR(255) NOT NULL,
	CONSTRAINT UN_categorie_tblCategorie UNIQUE (categorie)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblTypeTel (
	idTypeTel INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	typeTel VARCHAR(255) NOT NULL,
	CONSTRAINT UN_typeTel_tblTypeTel UNIQUE (typeTel)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblPays (
	idPays INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	pays VARCHAR(255) NOT NULL,
	CONSTRAINT UN_pays_tblPays UNIQUE (pays)
) ENGINE=INNODB;

#################################################################
# Ajout des clés étrangères pour les tables précédemment créées #
#################################################################
ALTER TABLE tblClient
	ADD CONSTRAINT FK_idAdresse_tblClient_tblAdresse FOREIGN KEY (idAdresse) REFERENCES tblAdresse (idAdresse),
	ADD CONSTRAINT FK_idTypeTel_tblClient_tblTypeTel FOREIGN KEY (idTypeTel) REFERENCES tblTypeTel (idTypeTel),
	ADD CONSTRAINT FK_idPaysDelivrance_tblClient_tblPays FOREIGN KEY (idPaysDelivrance) REFERENCES tblPays (idPays);
	
ALTER TABLE tblReservation
	ADD	CONSTRAINT FK_idClient_tblReservation_tblClient FOREIGN KEY (idClient) REFERENCES tblClient (idClient),
	ADD CONSTRAINT FK_idVoiture_tblReservation_tblVoiture FOREIGN KEY (idVoiture) REFERENCES tblVoiture (idVoiture);

ALTER TABLE tblVoiture
	ADD	CONSTRAINT FK_idMarque_tblVoiture_tblMarque FOREIGN KEY (idMarque) REFERENCES tblMarque (idMarque),
	ADD	CONSTRAINT FK_idCategorie_tblVoiture_tblCategorie FOREIGN KEY (idCategorie) REFERENCES tblCategorie (idCategorie);

ALTER TABLE tblAdresse
	ADD	CONSTRAINT FK_idPays_tblAdresse_tblPays FOREIGN KEY (idPays) REFERENCES tblPays (idPays);

############################################################################################################
# Insertion des marques, des catégories, des voitures, des types de téléphones des pays et des succursales #
############################################################################################################
INSERT INTO tblMarque (marque)
	VALUES ('Chevrolet'),
		   ('Kia'),
		   ('BMW'),
		   ('Nissan'),
		   ('Ford'),
		   ('Jeep');

INSERT INTO tblCategorie (categorie)
	VALUES ('Économique'),
		   ('Intermédiaire'),
		   ('Élite pleine grandeur'),
		   ('VUS compact'),
		   ('VUS intermédiaire 4RM'),
		   ('Jeep');
	   
INSERT INTO tblVoiture (idMarque, modele, idCategorie, nbPassager, image, description)
	VALUES (1, 'Spark', 1, 5, 'spark.jpg', 'Louez un véhicule économique pour conduire dans les zones urbaines denses et achalandées aux espaces de stationnement serrés. Les véhicules de location de catégorie économique sont habituellement ceux qui consomment le moins de carburant.'),
		   (2, 'Forte', 2, 5, 'forte.jpg', 'Louer un véhicule intermédiaire est utile lorsqu’on a besoin d’un peu plus d’espace pour les passagers et le rangement que les véhicules plus petits.'),
		   (3, '3', 3, 5, 'bmw3.jpg', 'Louez un véhicule élite pleine grandeur pour faire une entrée remarquée à coup sur.'),
		   (4, 'Qashqai', 4, 5, 'qashqai.jpg', 'Louez un VUS compact et profitez de tarifs bas tous les jours. Un VUS compact offre tout l’espace nécessaire pour cinq passagers tout en étant compact pour les zones à circulation dense.'),
		   (5, 'Escape', 5, 5, 'escape.jpg', 'Louez un VUS intermédiaire et profitez de tarifs bas tous les jours. Un VUS intermédiaire offre tout l’espace nécessaire pour cinq passagers tout en étant assez compact pour les zones à circulation dense.'),
		   (6, 'Wrangler', 6, 5, 'wrangler.jpg', 'Louez un Jeep Wrangler et profitez de la liberté qu’apporte ce type de véhicule !');

INSERT INTO tblTypeTel (typeTel)
	VALUES ('Maison'),
		   ('Bureau'),
		   ('Mobile'),
		   ('Autre');

INSERT INTO tblPays (pays)
	VALUES ('Canada'),
		   ('États-Unis'),
		   ('France');