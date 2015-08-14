-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 14 Août 2015 à 14:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `skynet`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `idCompte` int(11) NOT NULL AUTO_INCREMENT,
  `nomUser` text NOT NULL,
  `motDePasse` text NOT NULL,
  `mail` text NOT NULL,
  `dateCreation` date NOT NULL,
  `dateDerniereConnexion` date NOT NULL,
  `heureDerniereConnexion` time NOT NULL,
  PRIMARY KEY (`idCompte`),
  UNIQUE KEY `idCompte` (`idCompte`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `nomUser`, `motDePasse`, `mail`, `dateCreation`, `dateDerniereConnexion`, `heureDerniereConnexion`) VALUES
(1, 'Strogg312', 'azerty', 'azerty', '2015-08-02', '2015-08-02', '17:50:00');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `idConversation` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `nbMessages` int(11) NOT NULL,
  `nbParticipants` int(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `heureCreation` time NOT NULL,
  `proprietaire` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `motDePasse` text NOT NULL,
  PRIMARY KEY (`idConversation`),
  KEY `proprio` (`proprietaire`),
  KEY `typeConv` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`idConversation`, `titre`, `nbMessages`, `nbParticipants`, `dateCreation`, `heureCreation`, `proprietaire`, `type`, `motDePasse`) VALUES
(1, 'Doom', 0, 0, '2015-08-02', '17:53:00', 1, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `messagedoom`
--

CREATE TABLE IF NOT EXISTS `messagedoom` (
  `idMessage` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `pseudo` int(11) NOT NULL,
  `datePost` date NOT NULL,
  `heurePost` time NOT NULL,
  `conversation` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`),
  KEY `conversation` (`conversation`),
  KEY `pseudo` (`pseudo`),
  KEY `conversation_2` (`conversation`),
  KEY `pseudo_2` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participantdoom`
--

CREATE TABLE IF NOT EXISTS `participantdoom` (
  `idParticipant` int(11) NOT NULL,
  `pseudo` int(11) NOT NULL,
  `connected` tinyint(1) NOT NULL,
  `dateDerniereConnexion` date NOT NULL,
  `heureDerniereConnexion` time NOT NULL,
  `dateDernierMessage` date DEFAULT NULL,
  `heureDernierMessage` time DEFAULT NULL,
  `conversation` int(11) NOT NULL,
  PRIMARY KEY (`idParticipant`),
  KEY `conversation` (`conversation`),
  KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pseudo`
--

CREATE TABLE IF NOT EXISTS `pseudo` (
  `idPseudo` int(11) NOT NULL AUTO_INCREMENT,
  `nomPseudo` text NOT NULL,
  `titre` int(11) NOT NULL,
  `nbMessage` int(11) NOT NULL,
  `linkedAccount` int(11) NOT NULL,
  PRIMARY KEY (`idPseudo`),
  KEY `titreAccorde` (`titre`),
  KEY `linkedAccount` (`linkedAccount`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pseudo`
--

INSERT INTO `pseudo` (`idPseudo`, `nomPseudo`, `titre`, `nbMessage`, `linkedAccount`) VALUES
(1, 'Stroggy', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `titre`
--

CREATE TABLE IF NOT EXISTS `titre` (
  `idTitre` int(11) NOT NULL AUTO_INCREMENT,
  `nomTitre` text NOT NULL,
  `nbPostMin` int(11) NOT NULL,
  PRIMARY KEY (`idTitre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `titre`
--

INSERT INTO `titre` (`idTitre`, `nomTitre`, `nbPostMin`) VALUES
(1, 'Newbie', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `nomType` text NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`idType`, `nomType`) VALUES
(1, 'OpenBar'),
(2, 'Private');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `proprio` FOREIGN KEY (`proprietaire`) REFERENCES `compte` (`idCompte`),
  ADD CONSTRAINT `typeConv` FOREIGN KEY (`type`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `messagedoom`
--
ALTER TABLE `messagedoom`
  ADD CONSTRAINT `messageConv` FOREIGN KEY (`conversation`) REFERENCES `conversation` (`idConversation`),
  ADD CONSTRAINT `messageOwner` FOREIGN KEY (`pseudo`) REFERENCES `pseudo` (`idPseudo`);

--
-- Contraintes pour la table `pseudo`
--
ALTER TABLE `pseudo`
  ADD CONSTRAINT `linkAccount` FOREIGN KEY (`linkedAccount`) REFERENCES `compte` (`idCompte`),
  ADD CONSTRAINT `titreAccorde` FOREIGN KEY (`titre`) REFERENCES `titre` (`idTitre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
