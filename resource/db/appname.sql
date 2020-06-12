-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 12 juin 2020 à 09:12
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
-- Base de données :  `tajjet`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `ID_activity` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Distance` float NOT NULL,
  `ID_town` int(11) NOT NULL,
  `ID_category` int(11) NOT NULL,
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
  `URL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ReadingTime` time NOT NULL,
  `ID_news` int(11) NOT NULL,
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
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `ID_Genre` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
  `RecordDate` date NOT NULL,
  `Weight` float NOT NULL,
  `Calories` float NOT NULL,
  `Sleep` time NOT NULL,
  `ID_user` int(11) NOT NULL,
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
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Consumable` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `muscle`
--

DROP TABLE IF EXISTS `muscle`;
CREATE TABLE IF NOT EXISTS `muscle` (
  `ID_muscle` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_muscle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `ID_news` int(11) NOT NULL AUTO_INCREMENT,
  `Summary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ID_theme` int(11) NOT NULL,
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
  `Picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PreparationTime` time NOT NULL,
  `CookingTime` time NOT NULL,
  `Steps` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Calories` float NOT NULL,
  PRIMARY KEY (`ID_recipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `renewal`
--

DROP TABLE IF EXISTS `renewal`;
CREATE TABLE IF NOT EXISTS `renewal` (
  `ID_renewal` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ID_frequency` int(11) NOT NULL,
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
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_sky`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `ID_sport` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Calories` float NOT NULL,
  PRIMARY KEY (`ID_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `ID_theme` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `town`
--

DROP TABLE IF EXISTS `town`;
CREATE TABLE IF NOT EXISTS `town` (
  `ID_town` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MinTemp` float NOT NULL,
  `MaxTemp` float NOT NULL,
  `FeltTemp` float NOT NULL,
  `Humidity` float NOT NULL,
  `Pressure` float NOT NULL,
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
  `Title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Synopsis` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Begin` time NOT NULL,
  `End` time NOT NULL,
  PRIMARY KEY (`ID_TVprogram`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `Height` float NOT NULL,
  `town_id_town` int(11) NOT NULL,
  PRIMARY KEY (`ID_user`),
  KEY `FK_User_town_id_town` (`town_id_town`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `FK_Town_ID_sky` FOREIGN KEY (`ID_sky`) REFERENCES `sky` (`ID_sky`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
