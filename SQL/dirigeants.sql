CREATE TABLE dirigeants (
	dirigeant_id int NOT NULL
);

--
-- Index
--
ALTER TABLE dirigeants
	ADD KEY dirigeant_id (dirigeant_id);

--
-- Contraintes
--
ALTER TABLE dirigeants
	ADD CONSTRAINT fk_dirigeants_1 FOREIGN KEY (dirigeant_id) REFERENCES membres(id) ON DELETE CASCADE; 
