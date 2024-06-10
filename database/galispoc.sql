-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 10 juin 2024 à 14:25
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `galispoc`
--

-- --------------------------------------------------------

--
-- Structure de la table `beneficie`
--
DROP TABLE IF EXISTS `beneficie`;
DROP TABLE IF EXISTS `businessapp`;
DROP TABLE IF EXISTS `consultant`;
DROP TABLE IF EXISTS `incident`;
DROP TABLE IF EXISTS `service`;

CREATE TABLE `beneficie` (
  `matriculeBeneficie` int(20) NOT NULL,
  `nomBeneficie` varchar(255) NOT NULL,
  `prenomBeneficie` varchar(50) NOT NULL,
  `numTeleBeneficie` varchar(50) NOT NULL,
  `emailBeneficie` varchar(60) NOT NULL,
  `passwordBeneficie` varchar(200) NOT NULL,
  `dateDeNaissanceBeneficie` date NOT NULL,
  `bioBeneficie` varchar(500) DEFAULT NULL,
  `societeBeneficie` varchar(255) NOT NULL,
  `statutBeneficie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `beneficie`
--

INSERT INTO `beneficie` (`matriculeBeneficie`, `nomBeneficie`, `prenomBeneficie`, `numTeleBeneficie`, `emailBeneficie`, `passwordBeneficie`, `dateDeNaissanceBeneficie`, `bioBeneficie`, `societeBeneficie`, `statutBeneficie`) VALUES
(1, 'bourazza', 'ahmed', '066266666', 'ahmed.bourazza@alten.com', '123', '2002-04-22', 'nothing here', 'alten', 'stagiaire'),
(2, 'name', 'prenom', '06666666', 'user@alten.com', '123', '2023-07-18', 'gogoyrf', 'jeep', 'helper');

-- --------------------------------------------------------

--
-- Structure de la table `businessapp`
--

CREATE TABLE `businessapp` (
  `idBusinessApp` int(20) NOT NULL,
  `nomBusinessApp` varchar(255) NOT NULL,
  `idService#` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `businessapp`
--

INSERT INTO `businessapp` (`idBusinessApp`, `nomBusinessApp`, `idService#`) VALUES
(1, 'Linux', 7),
(2, 'Powerpoint', 1),
(3, 'Word', 1),
(4, 'Excel', 1),
(5, '7zip', 1),
(6, 'Printer', 5),
(7, 'Email', 6),
(8, 'Virtual Desktop', 1),
(9, 'Azure DevOps', 7),
(10, 'VPN Remote access', 3),
(11, 'MPA', 4);

-- --------------------------------------------------------

--
-- Structure de la table `consultant`
--

CREATE TABLE `consultant` (
  `numConsultant` int(20) NOT NULL,
  `nomConsultant` varchar(255) NOT NULL,
  `prenomConsultant` varchar(255) NOT NULL,
  `numTeleConsultant` varchar(255) NOT NULL,
  `dateDeNaissanceConsultant` date NOT NULL,
  `emailConsultant` varchar(255) NOT NULL,
  `passwordConsultant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `consultant`
--

INSERT INTO `consultant` (`numConsultant`, `nomConsultant`, `prenomConsultant`, `numTeleConsultant`, `dateDeNaissanceConsultant`, `emailConsultant`, `passwordConsultant`) VALUES
(1, 'makhloul', 'ilyas', '06666666', '2023-07-17', 'ilyas.makhloul@gmail.com', '123'),
(2, 'ziad', 'makhlouf', '0655887744', '2002-04-12', 'ziad@alten.com', '123');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `numIncident` int(50) NOT NULL,
  `urgenceIncident` varchar(255) NOT NULL,
  `titreIncident` varchar(255) NOT NULL,
  `descriptionIncident` varchar(255) NOT NULL,
  `etatIncident` varchar(255) NOT NULL,
  `dateIncident` datetime NOT NULL,
  `matriculeBeneficie#` int(20) NOT NULL,
  `numConsultant#` int(20) DEFAULT NULL,
  `idBusinessApp#` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `incident`
--

INSERT INTO `incident` (`numIncident`, `urgenceIncident`, `titreIncident`, `descriptionIncident`, `etatIncident`, `dateIncident`, `matriculeBeneficie#`, `numConsultant#`, `idBusinessApp#`) VALUES
(1, 'High', 'Powerpoint not working', 'Powerpoint not working', 'Solved', '2023-07-25 19:33:43', 1, 1, 2),
(2, 'Meduim', 'Linux not working', 'Linux not working even if i try all the ways', 'Solved', '2023-07-26 15:32:42', 1, 1, 1),
(3, 'Low', 'Computer not working', 'I try to login the Alten session but I can\'t , I receive this message : Error while login', 'Taking', '2023-07-27 12:13:19', 2, 1, 8),
(4, 'Meduim', 'Excel not working', 'i think that the excel needs to be fixed because I cant use it', 'Pending', '2023-07-27 20:46:44', 1, 1, 4),
(5, 'High', 'The printer is blocked', 'i want to use the printer but it is blocked ', 'Pending', '2023-07-27 20:50:30', 1, 2, 6),
(6, 'Low', 'Switch hors ligne', 'switch not working correctly', 'Pending', '2023-07-30 22:14:14', 1, 1, 10),
(7, 'High', 'computer problem', 'my computer is down', 'Pending', '2023-09-24 09:16:53', 1, 1, 8),
(8, 'Low', 'failed to connect to the internal wifi', 'i can\'t connect to the wifi , I don\'t know why', 'Pending', '2023-10-01 17:19:41', 1, 1, 10),
(9, 'Meduim', 'problem of connexion', 'here we must add the prolem\'s description', 'Solved', '2023-10-07 15:25:44', 1, 1, 10),
(10, 'High', 'glitch in my pc', 'i am in trouble, I can\'t solve a problem in my pc', 'Pending', '2023-10-21 16:09:19', 1, NULL, 9),
(11, 'Meduim', 'this is a problem ', 'the description of the problem goes here ', 'Solved', '2023-10-21 16:13:16', 1, 1, 1),
(12, 'Meduim', 'test', 'i try to open Powerpoint but an error message appears', 'Pending', '2023-11-14 11:36:24', 1, NULL, 2),
(13, 'High', 'testAjax', 'test', 'Pending', '2023-11-14 11:38:03', 1, NULL, 2),
(14, 'High', 'test problem', 'description here !', 'Solved', '2023-11-14 11:42:01', 1, 1, 2),
(15, 'Meduim', 'Problem', 'description here !', 'Solved', '2023-11-16 12:16:56', 1, 1, 2),
(16, 'High', 'test probem 111', 'description here !', 'Solved', '2023-11-16 12:26:54', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `idService` int(20) NOT NULL,
  `intituleService` varchar(255) NOT NULL,
  `typeService` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`idService`, `intituleService`, `typeService`) VALUES
(1, 'Productivity Tools', 'Local'),
(3, 'Network & Connectivity', 'Local'),
(4, 'Security', 'Local'),
(5, 'Printing Services', 'Local'),
(6, 'Mail Services', 'Local'),
(7, 'Private Cloud Hosting', 'Local');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `beneficie`
--
ALTER TABLE `beneficie`
  ADD PRIMARY KEY (`matriculeBeneficie`);

--
-- Index pour la table `businessapp`
--
ALTER TABLE `businessapp`
  ADD PRIMARY KEY (`idBusinessApp`),
  ADD KEY `idService#` (`idService#`);

--
-- Index pour la table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`numConsultant`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`numIncident`),
  ADD KEY `matriculeBeneficie#` (`matriculeBeneficie#`),
  ADD KEY `numConsultant#` (`numConsultant#`),
  ADD KEY `idBusinessApp#` (`idBusinessApp#`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `incident`
--
ALTER TABLE `incident`
  MODIFY `numIncident` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `businessapp`
--
ALTER TABLE `businessapp`
  ADD CONSTRAINT `businessapp_ibfk_1` FOREIGN KEY (`idService#`) REFERENCES `service` (`idService`);

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `idBusinessApp#` FOREIGN KEY (`idBusinessApp#`) REFERENCES `businessapp` (`idBusinessApp`),
  ADD CONSTRAINT `matriculeBeneficie#` FOREIGN KEY (`matriculeBeneficie#`) REFERENCES `beneficie` (`matriculeBeneficie`),
  ADD CONSTRAINT `numConsultant#` FOREIGN KEY (`numConsultant#`) REFERENCES `consultant` (`numConsultant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
