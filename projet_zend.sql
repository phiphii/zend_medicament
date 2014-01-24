-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 24 Janvier 2014 à 18:33
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `projet_zend`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

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

CREATE TABLE `medicaments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `name`) VALUES
(1, 'Doliprane (production)'),
(2, 'Advil (production)');
