CREATE TABLE encadrants (
	encadrant_id int NOT NULL
);

--
-- Index
--
ALTER TABLE encadrants
	ADD KEY encadrant_id (encadrant_id);

--
-- Contraintes
--
ALTER TABLE encadrants
	ADD CONSTRAINT fk_encadrants_1 FOREIGN KEY (encadrant_id) REFERENCES membres(id) ON DELETE CASCADE; 
