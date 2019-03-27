CREATE TABLE equipes_responsables (
	equipe_id int NOT NULL,
	responsable_id int NOT NULL
);

--
-- Index
--
ALTER TABLE equipes_responsables
	ADD PRIMARY KEY(equipe_id, responsable_id),
	ADD KEY equipe_id (equipe_id),
	ADD KEY responsable_id (responsable_id);

--
-- Contraintes
--
ALTER TABLE equipes_responsables
	ADD CONSTRAINT fk_equipes_responsables_1 FOREIGN KEY (responsable_id) REFERENCES membres(id) ON DELETE CASCADE,
	ADD CONSTRAINT fk_equipes_responsables_2 FOREIGN KEY (equipe_id) REFERENCES equipes(id) ON DELETE CASCADE; 
