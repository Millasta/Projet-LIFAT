CREATE TABLE encadrants_theses (
	encadrant_id int NOT NULL,
	these_id int NOT NULL
);

--
-- Index
--
ALTER TABLE encadrants_theses
	ADD PRIMARY KEY(encadrant_id, these_id),
	ADD KEY encadrant_id (encadrant_id),
	ADD KEY these_id (these_id);

--
-- Contraintes
--
ALTER TABLE encadrants_theses
	ADD CONSTRAINT fk_encadrants_theses_1 FOREIGN KEY (encadrant_id) REFERENCES encadrants(encadrant_id) ON DELETE CASCADE,
	ADD CONSTRAINT fk_encadrants_theses_2 FOREIGN KEY (these_id) REFERENCES theses(id) ON DELETE CASCADE; 
