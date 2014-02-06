-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 01 Février 2014 à 21:17
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS projet_zend;
CREATE DATABASE IF NOT EXISTS projet_zend_dev;
CREATE DATABASE IF NOT EXISTS projet_zend_recette;

use projet_zend;
--
-- Base de données: `projet_zend`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;

CREATE TABLE `configuration` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `config_file` varchar(4) NOT NULL DEFAULT 'php',
  `environment` varchar(10) NOT NULL DEFAULT 'dev',
  `used` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `configuration`
--

INSERT INTO `configuration` (`id`, `config_file`, `environment`, `used`) VALUES
(1, 'php', 'dev', 1),
(2, 'php', 'recette', 0),
(3, 'php', 'production', 0),
(4, 'ini', 'dev', 0),
(5, 'ini', 'recette', 0),
(6, 'ini', 'production', 0),
(7, 'xml', 'dev', 0),
(8, 'xml', 'recette', 0),
(10, 'xml', 'production', 0),
(11, 'yaml', 'dev', 0),
(12, 'yaml', 'recette', 0),
(13, 'yaml', 'production', 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;

CREATE TABLE `medicaments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `molecule` varchar(255) DEFAULT NULL,
  `indications` text,
  `cons_indications` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `name`, `molecule`, `indications`, `cons_indications`) VALUES
(1, 'Doliprane (production)', 'Paracétamole', 'Douleurs\r\nFièvre\r\nMaux de tête\r\nDouleurs dentaires\r\nCourbatures\r\nRègles douloureuses', 'Allergie au paracétamol\r\nMaladie grave du foie\r\nAllergie au blé'),
(2, 'Advil (production)', 'Ibuprofène', 'Affections douloureuses d''intensité légère à modérée et/ou états fébriles\r\nDysménorrhées après recherche étiologique\r\nTraitement de la crise de la migraine légère à modérée, avec ou sans aura\r\nTraitement des douleurs modérées dans l''arthrose (hanche, genou)', 'Au-delà de 24 semaines d''aménorrhée (5 mois de grossesse révolus)\r\nHypersensibilité à l''ibuprofène ou à l''un des excipients du produit\r\nAntécédents d''asthme déclenchés par la prise d''ibuprofène ou de substences d''activité proche telles que: autres AINS, acide acétylsalicylique\r\nInsuffisance hépatique, rénale, cardiaque sévère');


use projet_zend_dev;

--
-- Base de données: `projet_zend_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;

CREATE TABLE `configuration` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `config_file` varchar(4) NOT NULL DEFAULT 'php',
  `environment` varchar(10) NOT NULL DEFAULT 'dev',
  `used` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `configuration`
--

INSERT INTO `configuration` (`id`, `config_file`, `environment`, `used`) VALUES
(1, 'php', 'dev', 1),
(2, 'php', 'recette', 0),
(3, 'php', 'production', 0),
(4, 'ini', 'dev', 0),
(5, 'ini', 'recette', 0),
(6, 'ini', 'production', 0),
(7, 'xml', 'dev', 0),
(8, 'xml', 'recette', 0),
(10, 'xml', 'production', 0),
(11, 'yaml', 'dev', 0),
(12, 'yaml', 'recette', 0),
(13, 'yaml', 'production', 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;

CREATE TABLE `medicaments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `molecule` varchar(255) DEFAULT NULL,
  `indications` text,
  `cons_indications` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `name`, `molecule`, `indications`, `cons_indications`) VALUES
(1, 'Doliprane (dev)', 'Paracétamole', 'Douleurs\r\nFièvre\r\nMaux de tête\r\nDouleurs dentaires\r\nCourbatures\r\nRègles douloureuses', 'Allergie au paracétamol\r\nMaladie grave du foie\r\nAllergie au blé'),
(2, 'Advil (dev)', 'Ibuprofène', 'Affections douloureuses d''intensité légère à modérée et/ou états fébriles\r\nDysménorrhées après recherche étiologique\r\nTraitement de la crise de la migraine légère à modérée, avec ou sans aura\r\nTraitement des douleurs modérées dans l''arthrose (hanche, genou)', 'Au-delà de 24 semaines d''aménorrhée (5 mois de grossesse révolus)\r\nHypersensibilité à l''ibuprofène ou à l''un des excipients du produit\r\nAntécédents d''asthme déclenchés par la prise d''ibuprofène ou de substences d''activité proche telles que: autres AINS, acide acétylsalicylique\r\nInsuffisance hépatique, rénale, cardiaque sévère');



use projet_zend_recette;

--
-- Base de données: `projet_zend_recette`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `config_file` varchar(4) NOT NULL DEFAULT 'php',
  `environment` varchar(10) NOT NULL DEFAULT 'dev',
  `used` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `configuration`
--

INSERT INTO `configuration` (`id`, `config_file`, `environment`, `used`) VALUES
(1, 'php', 'dev', 1),
(2, 'php', 'recette', 0),
(3, 'php', 'production', 0),
(4, 'ini', 'dev', 0),
(5, 'ini', 'recette', 0),
(6, 'ini', 'production', 0),
(7, 'xml', 'dev', 0),
(8, 'xml', 'recette', 0),
(10, 'xml', 'production', 0),
(11, 'yaml', 'dev', 0),
(12, 'yaml', 'recette', 0),
(13, 'yaml', 'production', 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;

CREATE TABLE `medicaments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `molecule` varchar(255) DEFAULT NULL,
  `indications` text,
  `cons_indications` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `name`, `molecule`, `indications`, `cons_indications`) VALUES
(1, 'Doliprane (recette)', 'Paracétamole', 'Douleurs\r\nFièvre\r\nMaux de tête\r\nDouleurs dentaires\r\nCourbatures\r\nRègles douloureuses', 'Allergie au paracétamol\r\nMaladie grave du foie\r\nAllergie au blé'),
(2, 'Advil (recette)', 'Ibuprofène', 'Affections douloureuses d''intensité légère à modérée et/ou états fébriles\r\nDysménorrhées après recherche étiologique\r\nTraitement de la crise de la migraine légère à modérée, avec ou sans aura\r\nTraitement des douleurs modérées dans l''arthrose (hanche, genou)', 'Au-delà de 24 semaines d''aménorrhée (5 mois de grossesse révolus)\r\nHypersensibilité à l''ibuprofène ou à l''un des excipients du produit\r\nAntécédents d''asthme déclenchés par la prise d''ibuprofène ou de substences d''activité proche telles que: autres AINS, acide acétylsalicylique\r\nInsuffisance hépatique, rénale, cardiaque sévère');
