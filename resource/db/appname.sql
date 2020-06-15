-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 juin 2020 à 16:05
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
-- Base de données :  `appname`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `ID_activity` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Distance` float NOT NULL,
  `ID_town` int(11) NOT NULL,
  `ID_category` int(11) NOT NULL,
  PRIMARY KEY (`ID_activity`),
  KEY `FK_Activity_ID_town` (`ID_town`),
  KEY `FK_Activity_ID_category` (`ID_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `ID_article` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ReadingTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ID_news` int(11) NOT NULL,
  PRIMARY KEY (`ID_article`),
  KEY `FK_Article_ID_news` (`ID_news`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID_category` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_category`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `have`
--

DROP TABLE IF EXISTS `have`;
CREATE TABLE IF NOT EXISTS `have` (
  `ID_item` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `Quantity` float NOT NULL,
  PRIMARY KEY (`ID_item`,`ID_user`),
  KEY `FK_Have_ID_user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
-- Structure de la table `include`
--

DROP TABLE IF EXISTS `include`;
CREATE TABLE IF NOT EXISTS `include` (
  `ID_recipe` int(11) NOT NULL AUTO_INCREMENT,
  `ID_item` int(11) NOT NULL,
  `Quantity` float NOT NULL,
  PRIMARY KEY (`ID_recipe`,`ID_item`),
  KEY `FK_Include_ID_item` (`ID_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID_item` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_item`)
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
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `ID_news` int(11) NOT NULL AUTO_INCREMENT,
  `Summary` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  PRIMARY KEY (`ID_news`)
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
  `Name_Recipe` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `PreparationTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CookingTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `TotalTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Score_Recipe` float NOT NULL,
  `Price` float NOT NULL,
  `Difficulty` float NOT NULL,
  `Steps` text CHARACTER SET latin1 COLLATE latin1_general_ci,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  `MinTemp` float NOT NULL,
  `MaxTemp` float NOT NULL,
  `FeltTemp` float NOT NULL,
  `Humidity` float NOT NULL,
  `Pressure` float NOT NULL,
  `ID_sky` int(11) NOT NULL,
  PRIMARY KEY (`ID_town`),
  KEY `FK_Town_ID_sky` (`ID_sky`)
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
  `Begin` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `End` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Height` float DEFAULT NULL,
  `town_id_town` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_user`),
  KEY `FK_User_town_id_town` (`town_id_town`)
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
-- Contraintes pour la table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `FK_Activity_ID_category` FOREIGN KEY (`ID_category`) REFERENCES `category` (`ID_category`),
  ADD CONSTRAINT `FK_Activity_ID_town` FOREIGN KEY (`ID_town`) REFERENCES `town` (`ID_town`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_Article_ID_news` FOREIGN KEY (`ID_news`) REFERENCES `news` (`ID_news`);

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_Have_ID_item` FOREIGN KEY (`ID_item`) REFERENCES `ingredient` (`ID_item`),
  ADD CONSTRAINT `FK_Have_ID_user` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `health`
--
ALTER TABLE `health`
  ADD CONSTRAINT `FK_Health_ID_user` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `include`
--
ALTER TABLE `include`
  ADD CONSTRAINT `FK_Include_ID_item` FOREIGN KEY (`ID_item`) REFERENCES `ingredient` (`ID_item`),
  ADD CONSTRAINT `FK_Include_ID_recipe` FOREIGN KEY (`ID_recipe`) REFERENCES `recipe` (`ID_recipe`);

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
-- Contraintes pour la table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `FK_Town_ID_sky` FOREIGN KEY (`ID_sky`) REFERENCES `sky` (`ID_sky`);

--
-- Contraintes pour la table `tvprogram`
--
ALTER TABLE `tvprogram`
  ADD CONSTRAINT `FK_TVprogram_ID_channel` FOREIGN KEY (`ID_channel`) REFERENCES `channel` (`ID_channel`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_town_id_town` FOREIGN KEY (`town_id_town`) REFERENCES `town` (`ID_town`);

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
