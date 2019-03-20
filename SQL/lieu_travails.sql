CREATE TABLE lieu_travails (
	id int NOT NULL,
	nom_lieu varchar(60) NOT NULL,
	est_dans_liste BOOLEAN DEFAULT TRUE
);

--
-- Index
--
ALTER TABLE lieu_travails
	ADD PRIMARY KEY (id),
	ADD UNIQUE KEY nom_lieu (nom_lieu);

--
-- AUTO_INCREMENT
--
ALTER TABLE lieu_travails
	MODIFY id int NOT NULL AUTO_INCREMENT;

--
-- Contraintes
--
