CREATE TABLE membres (
	id int NOT NULL,
	role ENUM('admin', 'user', 'secretary') NOT NULL DEFAULT 'user',
	nom varchar(25) DEFAULT NULL,
	prenom varchar(25) DEFAULT NULL,
	email varchar(60) DEFAULT NULL,
	passwd varchar(40) DEFAULT NULL,
	adresse_agent_1 varchar(80) DEFAULT NULL,
	adresse_agent_2 varchar(60) DEFAULT NULL,
	residence_admin_1 varchar(80) DEFAULT NULL,
	residence_admin_2 varchar(80) DEFAULT NULL,
	type_personnel ENUM('PU', 'PE', 'Do') DEFAULT NULL,
	intitule varchar(30) DEFAULT NULL,
	grade varchar(30) DEFAULT NULL,
	im_vehicule varchar(10) NOT NULL COMMENT 'immatriculation du véhicule principal',
	pf_vehicule int NOT NULL COMMENT 'puissance ficale du véhicule principal',
	signature_name varchar(20) NOT NULL,
	login_cas varchar(60) DEFAULT NULL,
	carte_sncf varchar(40) DEFAULT NULL,
	matricule int DEFAULT NULL,
	date_naissance DATETIME DEFAULT NULL,
	actif BOOLEAN DEFAULT TRUE,
	lieu_travail_id int DEFAULT NULL,
	nationalite varchar(20) DEFAULT NULL,
	est_francais BOOLEAN DEFAULT TRUE,
	genre char(1) DEFAULT NULL,
	hdr BOOLEAN DEFAULT NULL COMMENT 'Certification HDR',
	permanent BOOLEAN DEFAULT TRUE,
	est_porteur BOOLEAN DEFAULT FALSE,
	date_creation DATETIME DEFAULT NULL,
	date_sortie DATETIME DEFAULT NULL
) ENGINE=InnoDB;

--
-- Index
--
ALTER TABLE membres
	ADD PRIMARY KEY (id),
	ADD UNIQUE KEY email (email),
	ADD UNIQUE KEY login_cas (login_cas),
	ADD UNIQUE KEY signature_name (signature_name),
	ADD KEY lieu_travail_id (lieu_travail_id);

--
-- AUTO_INCREMENT
--
ALTER TABLE membres
	MODIFY id int NOT NULL AUTO_INCREMENT;

--
-- Contraintes
--
ALTER TABLE membres
	ADD CONSTRAINT fk_membre_1 FOREIGN KEY (lieu_travail_id) REFERENCES lieu_travails(id);


