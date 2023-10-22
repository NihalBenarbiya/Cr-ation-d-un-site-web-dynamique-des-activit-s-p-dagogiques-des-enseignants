-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 17 avr. 2020 à 21:56
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monpfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `NUM_C` int(11) NOT NULL,
  `LOGIN_EN` varchar(50) NOT NULL,
  `TITRE` varchar(50) DEFAULT NULL,
  `PIECE_JOINTE` varchar(50) DEFAULT NULL,
  `nbtelech` int(11) DEFAULT 0,
  `nbvisiteur` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`NUM_C`, `LOGIN_EN`, `TITRE`, `PIECE_JOINTE`, `nbtelech`, `nbvisiteur`) VALUES
(1, 'abbadi', 'Logique,ensemble et applications', 'logique_ensembles_applications.pdf', 4, 4),
(2, 'abbadi', 'Calcul matriciel', 'Alg.1_calcul_matriciel.pdf', 1, 0),
(4, 'abbadi', 'Matlab', 'Matlab_TP1.pdf', 0, 0),
(5, 'abbadi', 'Limite et continuite', 'LimitesContTS1.doc', 0, 0),
(6, 'abbadi', 'developpement limite', 'LimitesContTS1.doc', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `LOGIN_EN` varchar(50) NOT NULL,
  `MOT_DE_PASS_EN` varchar(50) DEFAULT NULL,
  `EMAIL_EN` varchar(50) DEFAULT NULL,
  `NOM_EN` varchar(50) DEFAULT NULL,
  `PRENOM_EN` varchar(50) DEFAULT NULL,
  `DATE_NAISSANCE_EN` date DEFAULT NULL,
  `LIEU_NAISSANCE_EN` varchar(50) DEFAULT NULL,
  `DATE_EMBAUCHEMENT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`LOGIN_EN`, `MOT_DE_PASS_EN`, `EMAIL_EN`, `NOM_EN`, `PRENOM_EN`, `DATE_NAISSANCE_EN`, `LIEU_NAISSANCE_EN`, `DATE_EMBAUCHEMENT`) VALUES
('abbadi', 'math', 'abzabbadi@gmail.com', 'ABBADI', 'Abdelaziz', '1970-03-25', 'oujda', '2020-04-16'),
('serghini', '7483', 'aserghini@gmail.com', 'A', 'Serghini', '1966-03-25', 'oujda', '2020-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `LOGIN` varchar(50) NOT NULL,
  `MOT_DE_PASS` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `LIEU_NAISSANCE` varchar(50) DEFAULT NULL,
  `SPECIALITE` varchar(50) DEFAULT NULL,
  `ANNE_UNIVERSITAIRE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`LOGIN`, `MOT_DE_PASS`, `EMAIL`, `NOM`, `PRENOM`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `SPECIALITE`, `ANNE_UNIVERSITAIRE`) VALUES
('Ali', 'lili', 'Ali@gmail.com', 'ABDEL', 'Ali', '2001-02-01', 'oujda', 'DAI', 2020),
('amina', '4567', 'aminafrizi@gmail.com', 'FRIZI', 'Amina', '2000-05-09', 'oujda', 'DAI', 2020),
('farah', '4567', 'farahammouch@gmail.com', 'AMMOUCH', 'Farah', '2000-06-20', 'oujda', 'DAI', 2020),
('fatima', 'fati', 'fatima@gmail.com', 'BOUAB', 'fatima', '2001-02-01', 'oujda', 'FCF', 2020),
('kaoutar', 'kaoukaou', 'mimounikaoutar@gmail.com', 'MIMOUNI', 'kaouthar', '2000-05-01', 'oujda', 'ASR', 2020),
('nihal', '1234', 'nihalbenarbiya@gmail.com', 'BENARBIYA', 'Nihal', '2001-02-17', 'oujda', 'DAI', 2020),
('siham', '4567', 'aliben@gmail.com', 'BENARI', 'Siham', '2000-09-12', 'Nador', 'DAI', 2020);

-- --------------------------------------------------------

--
-- Structure de la table `td`
--

CREATE TABLE `td` (
  `NUM_TD` int(11) NOT NULL,
  `NUM_C` int(11) NOT NULL,
  `TITRE` varchar(50) DEFAULT NULL,
  `PIECE` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `td`
--

INSERT INTO `td` (`NUM_TD`, `NUM_C`, `TITRE`, `PIECE`) VALUES
(1, 1, 'TD1', 'td1(1).pdf'),
(2, 1, 'TD2', 'TD2.pdf'),
(3, 2, 'TD1', 'TD1(3).pdf'),
(4, 5, 'TD1', 'hyperbo.docx');

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

CREATE TABLE `tp` (
  `NUM_TP` int(11) NOT NULL,
  `NUM_C` int(11) NOT NULL,
  `TITRE` char(50) DEFAULT NULL,
  `PIECE` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`NUM_TP`, `NUM_C`, `TITRE`, `PIECE`) VALUES
(3, 4, 'TP1:MATLAB', 'matlab.pdf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`NUM_C`),
  ADD KEY `FK_cours_gestion_enseignant` (`LOGIN_EN`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`LOGIN_EN`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`LOGIN`);

--
-- Index pour la table `td`
--
ALTER TABLE `td`
  ADD PRIMARY KEY (`NUM_TD`),
  ADD KEY `FK_TD_CONTIENT_COURS` (`NUM_C`);

--
-- Index pour la table `tp`
--
ALTER TABLE `tp`
  ADD PRIMARY KEY (`NUM_TP`),
  ADD KEY `FK_TP_CONTIENT_COURS` (`NUM_C`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `NUM_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `td`
--
ALTER TABLE `td`
  MODIFY `NUM_TD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tp`
--
ALTER TABLE `tp`
  MODIFY `NUM_TP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_cours_gestion_enseignant` FOREIGN KEY (`LOGIN_EN`) REFERENCES `enseignant` (`LOGIN_EN`);

--
-- Contraintes pour la table `td`
--
ALTER TABLE `td`
  ADD CONSTRAINT `FK_TD_CONTIENT_COURS` FOREIGN KEY (`NUM_C`) REFERENCES `cours` (`NUM_C`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tp`
--
ALTER TABLE `tp`
  ADD CONSTRAINT `FK_TP_CONTIENT_COURS` FOREIGN KEY (`NUM_C`) REFERENCES `cours` (`NUM_C`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
