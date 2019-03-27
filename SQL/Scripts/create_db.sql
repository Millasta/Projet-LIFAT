
DROP DATABASE IF EXISTS lifat_db;
CREATE DATABASE IF NOT EXISTS lifat_db;

USE lifat_db;

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
