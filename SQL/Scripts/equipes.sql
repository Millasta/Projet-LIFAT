CREATE TABLE equipes (
	id int NOT NULL,
	nom_equipe varchar(25) NOT NULL,
	responsable_id int DEFAULT NULL
);

--
-- Index
--
ALTER TABLE equipes
	ADD PRIMARY KEY (id),
	ADD UNIQUE KEY nom_equipe (nom_equipe),
	ADD KEY responsable_id (responsable_id);

--
-- AUTO_INCREMENT
--
ALTER TABLE equipes
	MODIFY id int NOT NULL AUTO_INCREMENT;

--
-- Contraintes
--
ALTER TABLE equipes
	ADD CONSTRAINT fk_equipes_1 FOREIGN KEY (responsable_id) REFERENCES membres(id);
