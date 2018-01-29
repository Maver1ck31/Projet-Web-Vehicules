-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 29 Janvier 2018 à 20:54
-- Version du serveur :  5.6.28
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `photoLibrary`
--
CREATE DATABASE IF NOT EXISTS `photoLibrary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `photoLibrary`;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_msg` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_msg` text,
  `date_msg` datetime DEFAULT NULL,
  `id_emetteur` varchar(25) NOT NULL,
  PRIMARY KEY (`id_msg`),
  KEY `id_emetteur` (`id_emetteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_rep` text,
  `date_rep` datetime DEFAULT NULL,
  `id_emetteur` varchar(25) NOT NULL,
  `id_message` int(11) NOT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `id_emetteur` (`id_emetteur`),
  KEY `id_message` (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(25) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `id_usertype` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `id_usertype` (`id_usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`username`, `passwd`, `mail`, `id_usertype`) VALUES
('admin', '2d83c8d7e43e1f91e79d9675d4cff0c26a82ba4b', 'admin@photoLib.com', 2),
('ThibaudV', '7505d64a54e061b7acd54ccd58b49dc43500b635', 'thibaudV@photoLib.com', 1),
('Will', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', 'moi@moi.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id_usertype` int(11) NOT NULL AUTO_INCREMENT,
  `lib_usertype` varchar(45) DEFAULT NULL,
  `description` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur de ligue'),
(3, 'superadmin', 'Administrateur de toutes les ligues');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_reponse_id_msg` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_msg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reponse_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_id_usertype` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;
