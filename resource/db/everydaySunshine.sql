-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 21 juin 2020 à 22:38
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `everydaysunshine`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `ID_article` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Summary` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Pays` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `URL` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ReadingTime` time NOT NULL,
  PRIMARY KEY (`ID_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `channel`
--

DROP TABLE IF EXISTS `channel`;
CREATE TABLE IF NOT EXISTS `channel` (
  `ID_channel` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `frequency`
--

DROP TABLE IF EXISTS `frequency`;
CREATE TABLE IF NOT EXISTS `frequency` (
  `ID_frequency` int(11) NOT NULL AUTO_INCREMENT,
  `NumberOfDays` float NOT NULL,
  `NextDate` datetime NOT NULL,
  PRIMARY KEY (`ID_frequency`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `frequency`
--

INSERT INTO `frequency` (`ID_frequency`, `NumberOfDays`, `NextDate`) VALUES
(1, 1, '2020-06-22 00:00:00'),
(2, 0.12, '2020-06-22 00:00:00'),
(3, 1, '2020-06-22 01:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `health`
--

DROP TABLE IF EXISTS `health`;
CREATE TABLE IF NOT EXISTS `health` (
  `ID_health` int(11) NOT NULL AUTO_INCREMENT,
  `RecordDate` date NOT NULL,
  `Weight` float DEFAULT NULL,
  `Calories` float DEFAULT NULL,
  `Sleep` time DEFAULT NULL,
  `ID_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_health`),
  KEY `FK_Health_ID_user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `muscle`
--

DROP TABLE IF EXISTS `muscle`;
CREATE TABLE IF NOT EXISTS `muscle` (
  `ID_muscle` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_muscle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `ID_sport` int(11) NOT NULL,
  PRIMARY KEY (`ID_user`,`ID_sport`),
  KEY `FK_Program_ID_sport` (`ID_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `ID_recipe` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `NbPerson` int(11) NOT NULL,
  `PreparationTime` time NOT NULL,
  `CookingTime` time NOT NULL,
  `TotalTime` time NOT NULL,
  `Score` float NOT NULL,
  `Price` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Difficulty` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Steps` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Ingredients` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Calories` float NOT NULL,
  `ID_type` int(11) NOT NULL,
  PRIMARY KEY (`ID_recipe`),
  KEY `FK_Recipe_ID_type` (`ID_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `renewal`
--

DROP TABLE IF EXISTS `renewal`;
CREATE TABLE IF NOT EXISTS `renewal` (
  `ID_renewal` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleName` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ID_frequency` int(11) NOT NULL,
  PRIMARY KEY (`ID_renewal`),
  KEY `FK_Renewal_ID_frequency` (`ID_frequency`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `renewal`
--

INSERT INTO `renewal` (`ID_renewal`, `ModuleName`, `ID_frequency`) VALUES
(1, 'meteo', 1),
(2, 'tv', 3),
(3, 'news', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sky`
--

DROP TABLE IF EXISTS `sky`;
CREATE TABLE IF NOT EXISTS `sky` (
  `ID_sky` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_sky`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `ID_sport` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Calories` float NOT NULL,
  PRIMARY KEY (`ID_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `town`
--

DROP TABLE IF EXISTS `town`;
CREATE TABLE IF NOT EXISTS `town` (
  `ID_town` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_town`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tvprogram`
--

DROP TABLE IF EXISTS `tvprogram`;
CREATE TABLE IF NOT EXISTS `tvprogram` (
  `ID_TVprogram` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Synopsis` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Begin` time NOT NULL,
  `Genre` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ID_channel` int(11) NOT NULL,
  PRIMARY KEY (`ID_TVprogram`),
  KEY `FK_TVprogram_ID_channel` (`ID_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `ID_type` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`ID_type`, `Label`) VALUES
(1, 'entree'),
(2, 'plat principal'),
(3, 'dessert');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `BirthDate` date DEFAULT NULL,
  `Height` float DEFAULT NULL,
  `Sex` tinyint(1) DEFAULT NULL,
  `ID_town` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_user`),
  KEY `FK_User_ID_town` (`ID_town`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `weather`
--

DROP TABLE IF EXISTS `weather`;
CREATE TABLE IF NOT EXISTS `weather` (
  `ID_weather` int(11) NOT NULL AUTO_INCREMENT,
  `Forecast` datetime NOT NULL,
  `Temp` float NOT NULL,
  `FeltTemp` float NOT NULL,
  `Humidity` float NOT NULL,
  `Pressure` float NOT NULL,
  `ID_sky` int(11) NOT NULL,
  `ID_town` int(11) NOT NULL,
  PRIMARY KEY (`ID_weather`),
  KEY `FK_Weather_ID_sky` (`ID_sky`),
  KEY `FK_Weather_ID_town` (`ID_town`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE IF NOT EXISTS `work` (
  `ID_muscle` int(11) NOT NULL AUTO_INCREMENT,
  `ID_sport` int(11) NOT NULL,
  PRIMARY KEY (`ID_muscle`,`ID_sport`),
  KEY `FK_Work_ID_sport` (`ID_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `health`
--
ALTER TABLE `health`
  ADD CONSTRAINT `FK_Health_ID_user` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `FK_Program_ID_sport` FOREIGN KEY (`ID_sport`) REFERENCES `sport` (`ID_sport`),
  ADD CONSTRAINT `FK_Program_ID_user` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `FK_Recipe_ID_type` FOREIGN KEY (`ID_type`) REFERENCES `type` (`ID_type`);

--
-- Contraintes pour la table `renewal`
--
ALTER TABLE `renewal`
  ADD CONSTRAINT `FK_Renewal_ID_frequency` FOREIGN KEY (`ID_frequency`) REFERENCES `frequency` (`ID_frequency`);

--
-- Contraintes pour la table `tvprogram`
--
ALTER TABLE `tvprogram`
  ADD CONSTRAINT `FK_TVprogram_ID_channel` FOREIGN KEY (`ID_channel`) REFERENCES `channel` (`ID_channel`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_ID_town` FOREIGN KEY (`ID_town`) REFERENCES `town` (`ID_town`);

--
-- Contraintes pour la table `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `FK_Weather_ID_sky` FOREIGN KEY (`ID_sky`) REFERENCES `sky` (`ID_sky`),
  ADD CONSTRAINT `FK_Weather_ID_town` FOREIGN KEY (`ID_town`) REFERENCES `town` (`ID_town`);

--
-- Contraintes pour la table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `FK_Work_ID_muscle` FOREIGN KEY (`ID_muscle`) REFERENCES `muscle` (`ID_muscle`),
  ADD CONSTRAINT `FK_Work_ID_sport` FOREIGN KEY (`ID_sport`) REFERENCES `sport` (`ID_sport`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
