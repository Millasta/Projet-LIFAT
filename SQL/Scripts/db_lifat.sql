
CREATE TABLE IF NOT EXISTS financements (
	id INTEGER NOT NULL AUTO_INCREMENT,
    	international	BOOLEAN,
	nationalite_financement	varchar(60),
	financement_prive	BOOLEAN,
    	financement	varchar(60),
	PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS projets (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	titre	varchar(20),
	description	varchar(80),
	type	ENUM('type1','type2','type3','type4'),
	budget	INTEGER,
	date_debut	date,
	date_fin	date,
        financement_id INTEGER,
	PRIMARY KEY(id),
    	FOREIGN KEY(financement_id) REFERENCES financements(id)
)ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS motifs (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	nom_motif	varchar(60),
	est_dans_liste	BOOLEAN,
	PRIMARY KEY(id)
)ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS lieus (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	nom_lieu	varchar(60),
	est_dans_liste	BOOLEAN,
	PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS missions (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	complement_motif	varchar(40),
	date_depart	DATETIME,
	date_retour	DATETIME,
	sans_frais	BOOLEAN,
	etat	ENUM('soumis', 'vaide'),
	nb_nuites	INTEGER,
	nb_repas	INTEGER,
	billet_agence	BOOLEAN,
	commentaire_transport	TEXT,
	projet_id	INTEGER,
	lieu_id	INTEGER,
	motif_id	INTEGER,
	PRIMARY KEY(id),
	FOREIGN KEY(projet_id) REFERENCES projets(id),
	FOREIGN KEY(lieu_id) REFERENCES lieus(id),
	FOREIGN KEY(motif_id) REFERENCES motifs(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS transports (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	type_transport	ENUM('train', 'avion','vehicule_personnel','vehicule_service'),
	im_vehicule	varchar(10),
	pf_vehicule	INTEGER,
	PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS missions_transports (
	mission_id	INTEGER,
	transport_id	INTEGER,
	PRIMARY KEY(mission_id, transport_id),
  	FOREIGN KEY(mission_id) REFERENCES missions(id),
    	FOREIGN KEY(transport_id) REFERENCES transports(id)
) ENGINE=InnoDB;


