-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 15 mars 2020 à 23:16
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
  `PIECE_JOINTE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`NUM_C`, `LOGIN_EN`, `TITRE`, `PIECE_JOINTE`) VALUES
(1, 'nihal17', 'Poineteurs en C++', '#'),
(2, 'nihal17', 'Vecteurs en Java', 'TD2.pdf'),
(3, 'nihal', 'Objects sous Python', 'TD2.pdf'),
(4, 'nihal', 'Statistics sous R', 'TD1.pdf'),
(5, 'nihal', 'Matlab et Programmation', 'TD2.pdf'),
(6, 'nihal17', 'Salam O Laykium', NULL),
(7, 'nihal17', 'By bye', NULL),
(8, 'nihal17', 'Nice nice', 'bm-airbnb.png'),
(9, 'nihal17', 'Test final', 'cahierdechargelectromag.docx'),
(10, 'nihal17', 'test Final', 'cahierdechargelectromag.docx');

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
('nihal17', '1234', 'benihal@gmail.com', 'Nihal', 'Benarbiya', '0000-00-00', 'oujda', '0000-00-00');

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
('abced', 'efghk', 'abcderf@gmail.com', 'abcdefg', 'khfyth', '0000-00-00', 'oujda', 'DAI', 2020),
('lala', 'lili', 'lalalili@gmail.com', 'lalala', 'lilili', '0000-00-00', 'oujda', 'DAI', 2020),
('nini', 'ben', 'niniben@gmail.com', 'nini', 'ben', '0000-00-00', 'oujda', 'DAI', 2020);

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
(1, 1, 'Relation des cours', 'TD1.pdf'),
(2, 1, 'Donnes des cours', 'TD1.pdf'),
(3, 1, 'firsttd ', 'TD1.pdf'),
(4, 2, 'secondtd ', 'TD1.pdf'),
(5, 3, 'thirdtd ', 'TD1.pdf'),
(6, 4, 'fourthtd ', 'TD1.pdf'),
(7, 5, 'fifthtd ', 'TD1.pdf'),
(8, 3, 'firsttd ', 'TD1.pdf'),
(9, 4, 'secondtd ', 'TD1.pdf'),
(10, 5, 'thirdtd ', 'TD1.pdf'),
(11, 2, 'fourthtd ', 'TD1.pdf'),
(12, 1, 'fifthtd ', 'TD1.pdf'),
(13, 6, 'Okay c td', 'cahierdechargelectromag.docx');

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
(1, 1, 'prmiler', 'TD1.pdf'),
(2, 2, 'deuxieme', 'TD1.pdf'),
(3, 3, 'troisieme', 'TD1.pdf'),
(4, 4, 'quatrieme', 'TD1.pdf'),
(5, 5, 'cinquieme', 'TD1.pdf'),
(6, 2, 'sixieme', 'TD1.pdf'),
(7, 4, 'septieme', 'TD1.pdf'),
(8, 2, 'prmier', 'TD1.pdf'),
(9, 3, 'deuxieme', 'TD1.pdf'),
(10, 1, 'troisieme', 'TD1.pdf'),
(11, 5, 'quatrieme', 'TD1.pdf'),
(12, 3, 'cinquieme', 'TD1.pdf'),
(13, 1, 'sixieme', 'TD1.pdf'),
(14, 5, 'septieme', 'TD1.pdf'),
(15, 1, 'Relation des arbres', 'ArbreBinaireRecherche.java'),
(16, 2, 'Relation des arbres', 'bm-airbnb.png'),
(17, 6, 'Ok c TP', 'RAPPORTELECTROMAGMP.docx');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`NUM_C`);

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
  ADD PRIMARY KEY (`NUM_TP`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `NUM_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `td`
--
ALTER TABLE `td`
  MODIFY `NUM_TD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tp`
--
ALTER TABLE `tp`
  MODIFY `NUM_TP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `td`
--
ALTER TABLE `td`
  ADD CONSTRAINT `FK_TD_CONTIENT_COURS` FOREIGN KEY (`NUM_C`) REFERENCES `cours` (`NUM_C`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
