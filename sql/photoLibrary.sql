-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 29 Janvier 2018 à 13:39
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `photoLibrary`
--
CREATE DATABASE IF NOT EXISTS `photoLibrary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `photoLibrary`;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) DEFAULT NULL,
  `passwd` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `id_usertype` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `FK_user_id_usertype_idx` (`id_usertype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id_usertype` int(11) NOT NULL AUTO_INCREMENT,
  `lib_usertype` varchar(45) DEFAULT NULL,
  `description` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_usertype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --
-- -- Contenu de la table `usertype`
-- --
-- 
-- INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
-- (1, 'utilisateur', 'Utilisateur de base'),
-- (2, 'admin', 'Administrateur de ligue'),
-- (3, 'superadmin', 'Administrateur de toutes les ligues');

-- ---------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_msg` INT(11) NOT NULL AUTO_INCREMENT,
  `contenu_msg` TEXT DEFAULT NULL,
  `date_msg` datetime DEFAULT NULL,
  `id_emetteur` INT(11) NOT NULL,
  PRIMARY KEY (`id_msg`),
  KEY `FK_message_id_user_idx` (`id_emetteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id_rep` INT(11) NOT NULL AUTO_INCREMENT,
  `contenu_rep` TEXT DEFAULT NULL,
  `date_rep` datetime DEFAULT NULL,
  `id_emetteur` INT(11) NOT NULL,
  `id_message` INT(11) NOT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `FK_reponse_id_user_idx` (`id_emetteur`),
  KEY `FK_reponse_id_msg_idx` (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_reponse_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_reponse_id_msg` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_msg`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_id_usertype` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`) ON DELETE NO ACTION ON UPDATE NO ACTION;
