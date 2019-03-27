CREATE TABLE theses (
	id int NOT NULL,
	sujet varchar(20) NOT NULL,
	type varchar(20) DEFAULT NULL,
	date_debut DATE DEFAULT NULL,
	date_fin DATE DEFAULT NULL,
	signature varchar(20) DEFAULT NULL,
	auteur_id int DEFAULT NULL
);

--
-- Index
--
ALTER TABLE theses
	ADD PRIMARY KEY (id),
	ADD KEY auteur_id (auteur_id);

--
-- AUTO_INCREMENT
--
ALTER TABLE theses
	MODIFY id int NOT NULL AUTO_INCREMENT;

--
-- Contraintes
--
-- Suppression de la thèse en cas de suppression de l'auteur
ALTER TABLE theses
	ADD CONSTRAINT fk_theses_1 FOREIGN KEY (auteur_id) REFERENCES membres(id) ON DELETE CASCADE; 
