-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 25 nov. 2019 à 11:01
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `auto_ecole_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `bordereau`
--

CREATE TABLE `bordereau` (
  `id_bordereau` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bordereau`
--

INSERT INTO `bordereau` (`id_bordereau`, `date_depot`, `eleve`) VALUES
(5, '2019-10-01', 2),
(6, '2019-11-05', 1),
(7, '2019-11-05', 2),
(8, '2019-11-12', 1),
(9, '2019-11-12', 2),
(10, '2019-11-06', 1),
(11, '2019-11-06', 2);

-- --------------------------------------------------------

--
-- Structure de la table `bordereau_csv`
--

CREATE TABLE `bordereau_csv` (
  `id_bord_csv` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `pob` varchar(255) NOT NULL,
  `agence` varchar(255) NOT NULL,
  `date_d` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bordereau_csv`
--

INSERT INTO `bordereau_csv` (`id_bord_csv`, `nom`, `prenom`, `dob`, `pob`, `agence`, `date_d`) VALUES
(51, 'YAO', 'ISSA', '20/04/1995', 'ABIDJAN', 'COCODY\r\n', '2019-11-05'),
(52, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', '2019-11-05'),
(53, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', '2019-11-05'),
(54, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', '2019-11-05'),
(55, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', '2019-11-05'),
(56, 'YAO', 'ISSA', '20/04/1995', 'ABUDJAN', 'COCODY\r\n', '2019-11-05'),
(57, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', '2019-11-05'),
(58, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', '2019-11-05'),
(59, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', '2019-11-05'),
(60, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', '2019-11-05'),
(61, 'YAO', 'ISSA', '20/04/1995', 'ABUDJAN', 'COCODY\r\n', '2019-11-12'),
(62, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', '2019-11-12'),
(63, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', '2019-11-12'),
(64, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', '2019-11-12'),
(65, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', '2019-11-12'),
(66, '111', '2222', '3333', '4444', '555\r\n', '2019-11-12'),
(67, '22222', '33333', '04/11/3116', '555555', '666666\r\n', '2019-11-12'),
(68, '4444', '4444455', '12/10/4029', '554433', '223233\r\n', '2019-11-12'),
(69, '76554', 'uykyttr', '06/12/1914', 'fhgfhg', '65656r\r\n', '2019-11-12'),
(70, 'ytftrerdcfdt', '576576fgf', '6565', '56565', '65656556535\r\n', '2019-11-12'),
(71, 'cgfdtf', 'trrytfctretr', 'rtgfdtredc', 'fcfgdtd', 'cfrtdtddfgd\r\n', '2019-11-12'),
(72, 'YAO', 'ISSA', '20/04/1995', 'ABUDJAN', 'COCODY\r\n', '2019-10-01'),
(73, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', '2019-10-01'),
(74, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', '2019-10-01'),
(75, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', '2019-10-01'),
(76, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', '2019-10-01'),
(77, '111', '2222', '3333', '4444', '555\r\n', '2019-10-01'),
(78, '22222', '33333', '04/11/3116', '555555', '666666\r\n', '2019-10-01'),
(79, '4444', '4444455', '12/10/4029', '554433', '223233\r\n', '2019-10-01'),
(80, '76554', 'uykyttr', '06/12/1914', 'fhgfhg', '65656r\r\n', '2019-10-01'),
(81, 'ytftrerdcfdt', '576576fgf', '6565', '56565', '65656556535\r\n', '2019-10-01'),
(82, 'cgfdtf', 'trrytfctretr', 'rtgfdtredc', 'fcfgdtd', 'cfrtdtddfgd\r\n', '2019-10-01');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

CREATE TABLE `caisse` (
  `id_caisse` int(10) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `somme` float DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `compte` varchar(100) DEFAULT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE `dossier` (
  `id_dossier` int(10) NOT NULL,
  `date_depo` date DEFAULT NULL,
  `extrait` int(2) DEFAULT 0,
  `cnib` int(2) DEFAULT 0,
  `auto_parentale` int(2) DEFAULT 0,
  `quitance` int(2) DEFAULT 0,
  `ost` int(2) DEFAULT 0,
  `act_mariage` int(2) DEFAULT 0,
  `permi_provisoir` varchar(100) DEFAULT 'Aucune',
  `date_sorti` date DEFAULT NULL,
  `agence` varchar(100) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `photo` varchar(30) DEFAULT NULL,
  `eleve` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dossier`
--

INSERT INTO `dossier` (`id_dossier`, `date_depo`, `extrait`, `cnib`, `auto_parentale`, `quitance`, `ost`, `act_mariage`, `permi_provisoir`, `date_sorti`, `agence`, `commentaire`, `photo`, `eleve`) VALUES
(1, NULL, 1, 0, 0, 0, 0, 0, '', NULL, '', '', '0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(10) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sexe` varchar(15) DEFAULT NULL,
  `dor` date NOT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `categorie` varchar(30) DEFAULT NULL,
  `solde` float DEFAULT NULL,
  `forfait` varchar(100) DEFAULT NULL,
  `statut` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `nom`, `prenom`, `contact`, `profession`, `adresse`, `dob`, `sexe`, `dor`, `pob`, `categorie`, `solde`, `forfait`, `statut`) VALUES
(1, 'JEAN', 'CLAUDE', '8765434', 'etudiante', 'Secteur 22', '1998-10-02', 'masculin', '2019-10-18', 'Koumassi', 'D', 125000, 'normal', 1),
(2, 'WENA', 'WIELFRIED', '08675423', 'ElÃ¨ve', 'Secteur 22', '2019-10-03', 'masculin', '2019-10-23', 'Koumassi', 'B', 125000, 'normal', 1);

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `id_examen` int(10) NOT NULL,
  `date_examen` date DEFAULT NULL,
  `examinateur` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`id_examen`, `date_examen`, `examinateur`, `type`) VALUES
(1, '2019-10-22', '', 'code'),
(2, '2019-11-09', '', 'crenau');

-- --------------------------------------------------------

--
-- Structure de la table `examen_eleve`
--

CREATE TABLE `examen_eleve` (
  `id_examen_eleve` int(10) NOT NULL,
  `eleve` int(10) NOT NULL,
  `examen` int(10) NOT NULL,
  `resultat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen_eleve`
--

INSERT INTO `examen_eleve` (`id_examen_eleve`, `eleve`, `examen`, `resultat`) VALUES
(1, 1, 2, 'admis');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(10) NOT NULL,
  `numero` varchar(200) DEFAULT NULL,
  `date_paiement` date NOT NULL,
  `somme` float DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `eleve` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `numero`, `date_paiement`, `somme`, `type`, `eleve`) VALUES
(5, 'TJA-1', '2019-10-04', 100000, 'frais de scolaritÃ©', 2),
(6, 'RXL-2', '2019-10-10', 1000, 'frais de scolritÃ©', 2),
(7, 'XJU-3', '2019-11-16', 10000, '1e versement', 1),
(8, 'GJM-4', '2019-11-13', 100000, 'frais de scolaritÃ©', 1),
(9, 'DES-5', '2019-11-14', 15000, '3e versement', 1);

-- --------------------------------------------------------

--
-- Structure de la table `program`
--

CREATE TABLE `program` (
  `id_program` int(10) NOT NULL,
  `eleve` int(10) NOT NULL,
  `examen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `program`
--

INSERT INTO `program` (`id_program`, `eleve`, `examen`) VALUES
(1, 1, 1),
(3, 1, 1),
(4, 1, 2),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `programation`
--

CREATE TABLE `programation` (
  `id_programation` int(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `agence` varchar(100) DEFAULT NULL,
  `examen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `programation`
--

INSERT INTO `programation` (`id_programation`, `nom`, `prenom`, `dob`, `pob`, `agence`, `examen`) VALUES
(1, 'YAO', 'ISSA', '20/04/1995', 'ABUDJAN', 'COCODY\r\n', 1),
(2, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', 1),
(3, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', 1),
(4, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', 1),
(6, 'YAO', 'ISSA', '20/04/1995', 'ABIDJAN', 'COCODY\r\n', 1),
(7, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', 1),
(8, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', 1),
(9, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', 1),
(10, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', 1),
(22, 'YAO', 'ISSA', '20/04/1995', 'ABUDJAN', 'COCODY\r\n', 2),
(23, 'ALI', 'MADI', '30/03/2018', 'OUAGA', 'TOGO\r\n', 2),
(24, 'ZANNE', 'ISSOUF', '10/02/1999', 'DABA', 'MALI\r\n', 2),
(25, 'OUEDRAOGO', 'SOULE', '10/06/1685', 'PO', 'TAMPOUY\r\n', 2),
(26, 'SEMDE', 'AROUNA', '17/10/2010', 'MALI', 'KADIOGO\r\n', 2),
(27, '111', '2222', '3333', '4444', '555\r\n', 2),
(28, '22222', '33333', '04/11/3116', '555555', '666666\r\n', 2),
(29, '4444', '4444455', '12/10/4029', '554433', '223233\r\n', 2),
(30, '76554', 'uykyttr', '06/12/1914', 'fhgfhg', '65656r\r\n', 2),
(31, 'ytftrerdcfdt', '576576fgf', '6565', '56565', '65656556535\r\n', 2),
(32, 'cgfdtf', 'trrytfctretr', 'rtgfdtredc', 'fcfgdtd', 'cfrtdtddfgd\r\n', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nom_user` varchar(100) DEFAULT NULL,
  `prenom_user` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fonction` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `username`, `password`, `fonction`) VALUES
(13, 'admin', 'admin', 'admin', 'zcorp', 'administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD PRIMARY KEY (`id_bordereau`),
  ADD KEY `eleve` (`eleve`);

--
-- Index pour la table `bordereau_csv`
--
ALTER TABLE `bordereau_csv`
  ADD PRIMARY KEY (`id_bord_csv`);

--
-- Index pour la table `caisse`
--
ALTER TABLE `caisse`
  ADD PRIMARY KEY (`id_caisse`);

--
-- Index pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id_dossier`),
  ADD KEY `eleve` (`eleve`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`);

--
-- Index pour la table `examen_eleve`
--
ALTER TABLE `examen_eleve`
  ADD PRIMARY KEY (`id_examen_eleve`),
  ADD KEY `eleve` (`eleve`),
  ADD KEY `examen` (`examen`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `eleve` (`eleve`);

--
-- Index pour la table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`),
  ADD KEY `eleve` (`eleve`),
  ADD KEY `examen` (`examen`);

--
-- Index pour la table `programation`
--
ALTER TABLE `programation`
  ADD PRIMARY KEY (`id_programation`),
  ADD KEY `examen` (`examen`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bordereau`
--
ALTER TABLE `bordereau`
  MODIFY `id_bordereau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `bordereau_csv`
--
ALTER TABLE `bordereau_csv`
  MODIFY `id_bord_csv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `caisse`
--
ALTER TABLE `caisse`
  MODIFY `id_caisse` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id_dossier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `examen_eleve`
--
ALTER TABLE `examen_eleve`
  MODIFY `id_examen_eleve` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `programation`
--
ALTER TABLE `programation`
  MODIFY `id_programation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD CONSTRAINT `bordereau_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`id_eleve`);

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`id_eleve`);

--
-- Contraintes pour la table `examen_eleve`
--
ALTER TABLE `examen_eleve`
  ADD CONSTRAINT `examen_eleve_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`id_eleve`),
  ADD CONSTRAINT `examen_eleve_ibfk_2` FOREIGN KEY (`examen`) REFERENCES `examen` (`id_examen`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`id_eleve`);

--
-- Contraintes pour la table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`id_eleve`),
  ADD CONSTRAINT `program_ibfk_2` FOREIGN KEY (`examen`) REFERENCES `examen` (`id_examen`);

--
-- Contraintes pour la table `programation`
--
ALTER TABLE `programation`
  ADD CONSTRAINT `fk_PE` FOREIGN KEY (`examen`) REFERENCES `examen` (`id_examen`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
