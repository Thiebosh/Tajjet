-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 05 juin 2020 à 16:12
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
  `Label` varchar(255) DEFAULT NULL,
  `Distance` float DEFAULT NULL,
  `ID_town` int(11) DEFAULT NULL,
  `ID_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_activity`),
  KEY `FK_Activity_ID_town` (`ID_town`),
  KEY `FK_Activity_ID_category` (`ID_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `ID_article` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(255) DEFAULT NULL,
  `ReadingTime` time DEFAULT NULL,
  `ID_news` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_article`),
  KEY `FK_Article_ID_news` (`ID_news`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorize`
--

DROP TABLE IF EXISTS `categorize`;
CREATE TABLE IF NOT EXISTS `categorize` (
  `ID_TVprogram` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Genre` int(11) NOT NULL,
  PRIMARY KEY (`ID_TVprogram`,`ID_Genre`),
  KEY `FK_Categorize_ID_Genre` (`ID_Genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID_category` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `frequency`
--

DROP TABLE IF EXISTS `frequency`;
CREATE TABLE IF NOT EXISTS `frequency` (
  `ID_frequency` int(11) NOT NULL AUTO_INCREMENT,
  `NumberOfDays` float DEFAULT NULL,
  `NextDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_frequency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `ID_Genre` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `have`
--

DROP TABLE IF EXISTS `have`;
CREATE TABLE IF NOT EXISTS `have` (
  `ID_item` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_item`,`ID_user`),
  KEY `FK_Have_ID_user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `health`
--

DROP TABLE IF EXISTS `health`;
CREATE TABLE IF NOT EXISTS `health` (
  `ID_health` int(11) NOT NULL AUTO_INCREMENT,
  `RecordDate` date DEFAULT NULL,
  `Weight` float DEFAULT NULL,
  `Calories` float DEFAULT NULL,
  `Sleep` time DEFAULT NULL,
  `ID_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_health`),
  KEY `FK_Health_ID_user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `include`
--

DROP TABLE IF EXISTS `include`;
CREATE TABLE IF NOT EXISTS `include` (
  `ID_recipe` int(11) NOT NULL AUTO_INCREMENT,
  `ID_item` int(11) NOT NULL,
  PRIMARY KEY (`ID_recipe`,`ID_item`),
  KEY `FK_Use_ID_item` (`ID_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `ID_item` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  `Consumable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `muscle`
--

DROP TABLE IF EXISTS `muscle`;
CREATE TABLE IF NOT EXISTS `muscle` (
  `ID_muscle` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_muscle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `ID_news` int(11) NOT NULL AUTO_INCREMENT,
  `Summary` text,
  `ID_theme` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_news`),
  KEY `FK_News_ID_theme` (`ID_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `ID_recipe` int(11) NOT NULL AUTO_INCREMENT,
  `Picture` varchar(255) DEFAULT NULL,
  `PreparationTime` time DEFAULT NULL,
  `CookingTime` time DEFAULT NULL,
  `Steps` text,
  `Calories` float DEFAULT NULL,
  PRIMARY KEY (`ID_recipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `renewal`
--

DROP TABLE IF EXISTS `renewal`;
CREATE TABLE IF NOT EXISTS `renewal` (
  `ID_renewal` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleName` varchar(255) DEFAULT NULL,
  `ID_frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_renewal`),
  KEY `FK_Renewal_ID_frequency` (`ID_frequency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sky`
--

DROP TABLE IF EXISTS `sky`;
CREATE TABLE IF NOT EXISTS `sky` (
  `ID_sky` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_sky`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `ID_sport` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Calories` float DEFAULT NULL,
  PRIMARY KEY (`ID_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `ID_theme` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `town`
--

DROP TABLE IF EXISTS `town`;
CREATE TABLE IF NOT EXISTS `town` (
  `ID_town` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) DEFAULT NULL,
  `MinTemp` float DEFAULT NULL,
  `MaxTemp` float DEFAULT NULL,
  `FeltTemp` float DEFAULT NULL,
  `Humidity` float DEFAULT NULL,
  `Pressure` float DEFAULT NULL,
  `ID_sky` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_town`),
  KEY `FK_Town_ID_sky` (`ID_sky`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tvprogram`
--

DROP TABLE IF EXISTS `tvprogram`;
CREATE TABLE IF NOT EXISTS `tvprogram` (
  `ID_TVprogram` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Synopsis` text,
  `Begin` time DEFAULT NULL,
  `End` time DEFAULT NULL,
  PRIMARY KEY (`ID_TVprogram`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Height` float DEFAULT NULL,
  `ID_town` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_user`),
  KEY `FK_User_ID_town` (`ID_town`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Contraintes pour la table `categorize`
--
ALTER TABLE `categorize`
  ADD CONSTRAINT `FK_Categorize_ID_Genre` FOREIGN KEY (`ID_Genre`) REFERENCES `genre` (`ID_Genre`),
  ADD CONSTRAINT `FK_Categorize_ID_TVprogram` FOREIGN KEY (`ID_TVprogram`) REFERENCES `tvprogram` (`ID_TVprogram`);

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_Have_ID_item` FOREIGN KEY (`ID_item`) REFERENCES `item` (`ID_item`),
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
  ADD CONSTRAINT `FK_Use_ID_item` FOREIGN KEY (`ID_item`) REFERENCES `item` (`ID_item`),
  ADD CONSTRAINT `FK_Use_ID_recipe` FOREIGN KEY (`ID_recipe`) REFERENCES `recipe` (`ID_recipe`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_News_ID_theme` FOREIGN KEY (`ID_theme`) REFERENCES `theme` (`ID_theme`);

--
-- Contraintes pour la table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `FK_Program_ID_sport` FOREIGN KEY (`ID_sport`) REFERENCES `sport` (`ID_sport`),
  ADD CONSTRAINT `FK_Program_ID_user` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);

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
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_ID_town` FOREIGN KEY (`ID_town`) REFERENCES `town` (`ID_town`);

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
