-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 29 mai 2019 à 17:25
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lifat_db`
--

--
-- Déchargement des données de la table `budgets_annuels`
--

INSERT INTO `budgets_annuels` (`projet_id`, `annee`, `budget`) VALUES
(1, 2016, 10000),
(1, 2017, 15000),
(1, 2018, 20000),
(1, 2019, 25000),
(2, 2017, 40000),
(2, 2018, 50000),
(2, 2019, 60000),
(3, 2017, 15000),
(3, 2018, 20000),
(3, 2019, 25000),
(4, 2016, 10000),
(4, 2017, 15000),
(4, 2018, 20000),
(4, 2019, 25000);

--
-- Déchargement des données de la table `dirigeants`
--

INSERT INTO `dirigeants` (`dirigeant_id`) VALUES
(6),
(10);

--
-- Déchargement des données de la table `dirigeants_theses`
--

INSERT INTO `dirigeants_theses` (`dirigeant_id`, `these_id`, `taux`) VALUES
(6, 1, 27),
(6, 3, 100),
(6, 6, 55),
(10, 1, 73),
(10, 2, 100),
(10, 4, 100),
(10, 5, 100),
(10, 6, 45);

--
-- Déchargement des données de la table `encadrants`
--

INSERT INTO `encadrants` (`encadrant_id`) VALUES
(3),
(4),
(6);

--
-- Déchargement des données de la table `encadrants_theses`
--

INSERT INTO `encadrants_theses` (`encadrant_id`, `these_id`, `taux`) VALUES
(3, 1, 54),
(3, 2, 22),
(3, 3, 100),
(4, 1, 46),
(4, 2, 47),
(4, 4, 100),
(4, 5, 25),
(6, 2, 31),
(6, 5, 75),
(6, 6, 100);

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id`, `nom_equipe`, `responsable_id`) VALUES
(1, 'equipe1', 2),
(2, 'equipe2', 3),
(3, 'equipe3', 11),
(4, 'equipe4', 16),
(5, 'equipe5', 17),
(6, 'equipe6', 18),
(7, 'equipe7', 19);

--
-- Déchargement des données de la table `equipes_projets`
--

INSERT INTO `equipes_projets` (`equipe_id`, `projet_id`) VALUES
(1, 2),
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 4),
(7, 3);

--
-- Déchargement des données de la table `equipes_responsables`
--

INSERT INTO `equipes_responsables` (`equipe_id`, `responsable_id`) VALUES
(1, 2),
(2, 3),
(3, 11),
(4, 2),
(5, 3),
(6, 11),
(7, 2);

--
-- Déchargement des données de la table `financements`
--

INSERT INTO `financements` (`id`, `international`, `nationalite_financement`, `financement_prive`, `financement`) VALUES
(1, 0, 'Français', 0, '50000 euros'),
(2, 1, 'Allemand', 1, '250000 euros'),
(3, 1, 'Espagnol', 1, '275000 euros'),
(4, 0, 'Français', 0, '120000 euros');

--
-- Déchargement des données de la table `lieus`
--

INSERT INTO `lieus` (`id`, `nom_lieu`, `est_dans_liste`) VALUES
(1, 'Tours', 1),
(2, 'Paris', 1),
(3, 'Angers', 1),
(4, 'Rennes', 1),
(5, 'Lille', 1),
(6, 'Orleans', 1),
(7, 'Bordeaux', 1),
(8, 'Londres', 1),
(9, 'Berlin', 1),
(10, 'BArcelone', 1);

--
-- Déchargement des données de la table `lieu_travails`
--

INSERT INTO `lieu_travails` (`id`, `nom_lieu`, `est_dans_liste`) VALUES
(1, 'Polytech Tours', 1),
(2, 'LIFAT Paris', 1),
(3, 'LIFAT Blois', 1),
(5, 'LIFAT Lille', 1),
(6, 'LIFAT Angers', 1);

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `role`, `nom`, `prenom`, `email`, `passwd`, `adresse_agent_1`, `adresse_agent_2`, `residence_admin_1`, `residence_admin_2`, `type_personnel`, `intitule`, `grade`, `im_vehicule`, `pf_vehicule`, `signature_name`, `login_cas`, `carte_sncf`, `matricule`, `date_naissance`, `actif`, `lieu_travail_id`, `equipe_id`, `nationalite`, `est_francais`, `genre`, `hdr`, `permanent`, `est_porteur`, `date_creation`, `date_sortie`) VALUES
(1, 'admin', 'Admin', 'Admin', 'admin@admin.fr', '$2y$10$bzSGIbfxvGYjAh6H2f6rAuMKaAEAdYUrhrpNq/SoOmHKPnQdX58jG', '', '', '', '', '', '', '', 'AB123DC', 7, '', '', '', NULL, NULL, 1, 2, 1, '', 1, 'F', 0, 1, 0, NULL, NULL),
(2, '', 'nomUser2', 'prenomUser2', 'user2@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse2', NULL, 'residence2', NULL, 'Do', 'intitule2', 'Chef d equipe', 'imatricula', 2, '', NULL, 'carteSncf2', 101010102, '1997-06-07', 1, 1, 1, 'Français', 1, 'f', NULL, 1, 1, '2019-05-01 16:15:00', NULL),
(3, '', 'nomUser2', 'prenomUser3', 'user3@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adress3', NULL, 'residence3', NULL, 'PU', 'intitule3', 'Chef d equipe', 'imatricula', 3, '', NULL, 'carteSncf3', 101010103, '1990-10-20', 1, 2, 2, 'Français', 1, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(4, '', 'nomUser3', 'prenomUser4', 'user4@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse4', NULL, 'residence4', NULL, 'PU', 'intitule4', 'Chercheur', 'imatricula', 4, '', NULL, 'carteSncf4', 101010104, '1999-12-25', 1, 1, 1, 'Allemand', 0, 'h', NULL, 0, 0, '2019-05-01 16:15:00', NULL),
(5, '', 'nomUser4', 'prenomUser5', 'user5@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse5', NULL, 'residence5', NULL, 'PE', 'intitule5', 'Chercheur', 'imatricula', 5, '', NULL, NULL, 101010105, '1987-02-01', 1, 1, 1, 'Americain', 0, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(6, '', 'nomUser6', 'prenomUser6', 'user6@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse6', NULL, 'residence6', NULL, 'PU', 'intitule6', 'Chercheur', 'imatricula', 6, '', NULL, 'carteSncf6', 101010106, '1986-02-24', 1, 2, 2, 'Allemand', 0, 'f', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(7, '', 'nomUser7', 'prenomUser7', 'user7@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse7', NULL, 'residence7', NULL, 'PE', 'intitule7', 'Chercheur', 'imatricula', 7, '', NULL, NULL, 101010107, '1986-07-01', 1, 2, 2, 'Americain', 0, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(8, '', 'nomUser8', 'prenomUser8', 'user8@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse8', NULL, 'residence8', NULL, 'PE', 'intitule8', 'Chercheur', 'imatricula', 8, '', NULL, NULL, 101010108, '1979-03-18', 1, 2, 2, 'Français', 1, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(9, '', 'nomUser9', 'prenomUser9', 'user9@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse9', NULL, 'residence9', NULL, 'Do', 'intitule9', 'Chercheur', 'imatricula', 9, '', NULL, 'carteSncf9', 101010109, '1992-07-06', 1, 1, 3, 'Français', 1, 'f', NULL, 0, 0, '2019-05-01 16:15:00', NULL),
(10, '', 'nomUser10', 'prenomUser10', 'user10@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse10', NULL, 'residence10', NULL, 'PU', 'intitule10', 'Chercheur', 'imatricula', 10, '', NULL, 'carteSncf10', 101010110, '1992-11-24', 1, 1, 3, 'Anglais', 0, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(11, '', 'nomUser11', 'prenomUser11', 'user11@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse11', NULL, 'residence11', NULL, 'PU', 'intitule11', 'Chercheur', 'imatricula', 11, '', NULL, 'carteSncf11', 101010111, '1993-05-21', 1, 2, 2, 'Français', 1, 'f', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(12, '', 'nomUser12', 'prenomUser12', 'user12@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse12', NULL, 'residence12', NULL, 'Do', 'intitule12', 'Chercheur', 'imatricula', 12, '', NULL, 'carteSncf12', 101010112, '1994-04-16', 1, 1, 1, 'Français', 1, 'h', NULL, 0, 0, '2019-05-01 16:15:00', NULL),
(13, '', 'nomUser13', 'prenomUser13', 'user13@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse13', NULL, 'residence13', NULL, 'Do', 'intitule13', 'Chercheur', 'imatricula', 13, '', NULL, 'carteSncf13', 101010113, '1993-07-09', 1, 1, 3, 'Espagnol', 0, 'f', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(14, '', 'nomUser14', 'prenomUser14', 'user14@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse14', NULL, 'residence14', NULL, 'Do', 'intitule14', 'Chercheur', 'imatricula', 14, '', NULL, 'carteSncf14', 101010114, '1995-11-27', 1, 2, 2, 'Français', 1, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(15, '', 'nomUser15', 'prenomUser15', 'user15@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse15', NULL, 'residence15', NULL, 'Do', 'intitule15', 'Chercheur', 'imatricula', 15, '', NULL, 'carteSncf15', 101010115, '1994-06-13', 1, 1, 3, 'Anglais', 0, 'f', NULL, 0, 0, '2019-05-01 16:15:00', NULL),
(16, '', 'nomUser16', 'prenomUser16', 'user16@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse16', NULL, 'residence16', NULL, 'PU', 'intitule16', 'Chef d equipe', 'imatricula', 16, '', NULL, 'carteSncf16', 101010116, '1993-05-21', 1, 3, 4, 'Français', 1, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(17, '', 'nomUser17', 'prenomUser17', 'user17@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse17', NULL, 'residence17', NULL, 'PU', 'intitule17', 'Chef d equipe', 'imatricula', 17, '', NULL, 'carteSncf17', 101010117, '1994-04-16', 1, 2, 5, 'Français', 1, 'f', NULL, 0, 0, '2019-05-01 16:15:00', NULL),
(18, '', 'nomUser18', 'prenomUser18', 'user18@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse18', NULL, 'residence18', NULL, 'PU', 'intitule18', 'Chef d equipe', 'imatricula', 18, '', NULL, 'carteSncf18', 101010118, '1993-07-09', 1, 3, 6, 'Espagnol', 0, 'h', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(19, '', 'nomUser19', 'prenomUser19', 'user19@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse19', NULL, 'residence19', NULL, 'PU', 'intitule19', 'Chef d equipe', 'imatricula', 19, '', NULL, 'carteSncf19', 101010119, '1995-11-27', 1, 3, 7, 'Français', 1, 'f', NULL, 1, 0, '2019-05-01 16:15:00', NULL),
(20, '', 'nomUser20', 'prenomUser20', 'user20@email.fr', '$2y$10$PksbXyiUFxHocqxYr4HmlOJfGGOJqfeWmYwieXQroCL3ChQQr1zEC', 'adresse20', NULL, 'residence20', NULL, 'PU', 'intitule20', 'Chercheur', 'imatricula', 20, '', NULL, 'carteSncf20', 101010120, '1994-06-13', 1, 3, 7, 'Anglais', 0, 'h', NULL, 0, 0, '2019-05-01 16:15:00', NULL);

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`id`, `complement_motif`, `date_depart`, `date_retour`, `sans_frais`, `etat`, `nb_nuites`, `nb_repas`, `billet_agence`, `commentaire_transport`, `projet_id`, `lieu_id`, `motif_id`) VALUES
(1, 'complemntMotif1', '2019-05-01 10:55:13', '2019-05-30 13:10:25', 0, 'soumis', 29, 87, 1, 'vehicule personnel commentaires', 2, 1, 1),
(2, 'complemntMotif2', '2017-06-10 11:23:40', '2017-07-07 13:10:25', 1, '', 27, 81, 0, 'vehicule service commentaires', 1, 2, 2),
(3, 'complemntMotif3', '2016-11-24 16:50:57', '2016-12-20 13:10:25', 1, '', 26, 78, 0, 'train et avion3', 1, 3, 3),
(4, 'complemntMotif4', '2018-04-10 08:01:58', '2018-05-01 13:10:25', 0, '', 21, 63, 1, 'train et avion34', 2, 4, 1),
(5, 'complemntMotif5', '2019-03-18 06:25:57', '2019-04-03 13:10:25', 0, '', 16, 48, 0, 'vehicule personnel commentaires', 2, 5, 4),
(6, 'complemntMotif6', '2018-07-10 11:28:14', '2018-07-24 13:10:25', 1, '', 14, 42, 1, 'train et avion36', 1, 9, 1),
(7, 'complemntMotif7', '2019-10-21 04:35:11', '2019-11-30 13:10:25', 0, 'soumis', 40, 120, 1, 'train et avion37', 2, 10, 2);

--
-- Déchargement des données de la table `missions_transports`
--

INSERT INTO `missions_transports` (`mission_id`, `transport_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(3, 4),
(4, 3),
(4, 4),
(5, 1),
(6, 3),
(7, 3);

--
-- Déchargement des données de la table `motifs`
--

INSERT INTO `motifs` (`id`, `nom_motif`, `est_dans_liste`) VALUES
(1, 'motif1', 1),
(2, 'motif2', 1),
(3, 'motif3', 1),
(4, 'motif4', 1),
(5, 'motif5', 1),
(6, 'motif6', 1),
(7, 'motif7', 1),
(8, 'motif8', 1);

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `titre`, `description`, `type`, `budget`, `date_debut`, `date_fin`, `financement_id`) VALUES
(1, 'projet1', 'descriptionProjet1', 'type1', 100000, '2016-04-01', '2021-10-16', 1),
(2, 'projet2', 'descriptionProjet2', 'type3', 300000, '2017-11-03', '2022-10-16', 2),
(3, 'projet3', 'descriptionProjet3', 'type2', 400000, '2017-07-12', '2023-11-21', 3),
(4, 'projet4', 'descriptionProjet4', 'type4', 200000, '2016-05-27', '2022-10-16', 4);

--
-- Déchargement des données de la table `theses`
--

INSERT INTO `theses` (`id`, `sujet`, `type`, `date_debut`, `date_fin`, `autre_info`, `est_hdr`, `financement_id`, `auteur_id`) VALUES
(1, 'these1', 'Informatique Robotique', '2019-05-01', '2021-01-23', 'autreInfo1', 0, NULL, 9),
(2, 'these2', 'Taitement d image avance', '2017-02-24', '2018-07-23', 'autreInfo2', 1, 1, 2),
(3, 'these3', 'MicroElectronique avance', '2019-03-24', '2019-11-23', 'autreInfo3', 0, 2, 12),
(4, 'these4', 'Resolution de transfert important de donnees', '2019-06-27', '2020-03-29', 'autreInfo4', 1, 3, 2),
(5, 'these5', 'Medecine et Informatique', '2019-02-24', '2019-09-07', 'autreInfo5', 0, 4, 14),
(6, 'these6', 'Informatique au service de la planete', '2020-06-24', '2021-01-19', 'autreInfo6', 0, NULL, 15);

--
-- Déchargement des données de la table `transports`
--

INSERT INTO `transports` (`id`, `type_transport`, `im_vehicule`, `pf_vehicule`) VALUES
(1, 'vehicule_personnel', '01010101', 1),
(2, 'vehicule_service', '01010102', 2),
(3, 'train', NULL, NULL),
(4, 'avion', NULL, NULL),
(5, 'vehicule_personnel', '01010105', 3),
(6, 'vehicule_service', '01010106', 4),
(7, 'vehicule_personnel', '01010107', 5),
(8, 'vehicule_service', '01010108', 6),
(9, 'vehicule_service', '01010109', 7),
(10, 'vehicule_personnel', '01010110', 8),
(11, 'vehicule_personnel', '01010111', 9),
(12, 'vehicule_service', '01010112', 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
