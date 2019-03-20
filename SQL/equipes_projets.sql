CREATE TABLE equipes_projets (
	id int NOT NULL AUTO_INCREMENT,
	equipe_id int NOT NULL,
	projet_id int NOT NULL
);

--
-- Index
--
ALTER TABLE equipes_projets
	ADD PRIMARY KEY(id),
	ADD KEY equipe_id (equipe_id),
	ADD KEY projet_id (projet_id);

--
-- Contraintes
--
ALTER TABLE equipes_projets
	ADD CONSTRAINT fk_equipes_projets_1 FOREIGN KEY (equipe_id) REFERENCES equipes(id) ON DELETE CASCADE,
	ADD CONSTRAINT fk_equipes_projets_2 FOREIGN KEY (projet_id) REFERENCES projets(id) ON DELETE CASCADE; 
