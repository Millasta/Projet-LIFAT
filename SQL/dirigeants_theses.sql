CREATE TABLE dirigeants_theses (
	dirigeant_id int NOT NULL,
	these_id int NOT NULL
);

--
-- Index
--
ALTER TABLE dirigeants_theses
	ADD PRIMARY KEY (dirigeant_id, these_id),
	ADD KEY dirigeant_id (dirigeant_id),
	ADD KEY these_id (these_id);

--
-- Contraintes
--
ALTER TABLE dirigeants_theses
	ADD CONSTRAINT fk_dirigeants_theses_1 FOREIGN KEY (dirigeant_id) REFERENCES dirigeants(dirigeant_id) ON DELETE CASCADE,
	ADD CONSTRAINT fk_dirigeants_theses_2 FOREIGN KEY (these_id) REFERENCES theses(id) ON DELETE CASCADE; 
