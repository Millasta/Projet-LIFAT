CREATE DATABASE IF NOT EXISTS lifat_db;

USE lifat_db;

DROP TABLE IF EXISTS equipes_projets.sql;
DROP TABLE IF EXISTS equipes_responsables;
DROP TABLE IF EXISTS encadrants_theses;
DROP TABLE IF EXISTS dirigeants_theses;
DROP TABLE IF EXISTS theses;
DROP TABLE IF EXISTS equipes;
DROP TABLE IF EXISTS dirigeants;
DROP TABLE IF EXISTS encadrants;
DROP TABLE IF EXISTS membres;
DROP TABLE IF EXISTS lieu_travails;

source lieu_travails.sql;
source membres.sql;
source encadrants.sql;
source dirigeants.sql;
source equipes.sql;
source theses.sql;
source dirigeants_theses.sql;
source encadrants_theses.sql;
source equipes_responsables.sql;
source db_lifat.sql;
source equipes_projets.sql;

COMMIT;
