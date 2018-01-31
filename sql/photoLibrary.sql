-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 31 Janvier 2018 à 14:41
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
-- Structure de la table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `language`
--

INSERT INTO `language` (`id`, `label`) VALUES
(1, 'French'),
(2, 'English');

-- --------------------------------------------------------

--
-- Structure de la table `menu_access`
--

CREATE TABLE IF NOT EXISTS `menu_access` (
  `id_menu` int(11) NOT NULL,
  `id_usertype` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`,`id_usertype`),
  KEY `FK_access_usertype` (`id_usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `menu_access`
--

INSERT INTO `menu_access` (`id_menu`, `id_usertype`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(1, 2),
(2, 2),
(3, 2),
(5, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(1, 4),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `label`, `link`, `language_id`) VALUES
(1, 'Home', 'index.php', 2),
(2, 'Connexion', 'login.php', 2),
(3, 'Photos', 'photos.php', 2),
(4, 'Members Management', 'member_management.php', 2),
(5, 'Forum', 'forum_home.php', 2);

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
  `isReported` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `id_usertype` (`id_usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`username`, `passwd`, `mail`, `id_usertype`, `isReported`) VALUES
('admin', '2d83c8d7e43e1f91e79d9675d4cff0c26a82ba4b', 'admin@photoLib.com', 2, 0),
('superadmin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'superadmin@photolib.com', 3, 0),
('test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.fr', 1, 1),
('ThibaudV', '7505d64a54e061b7acd54ccd58b49dc43500b635', 'thibaudV@photoLib.com', 1, 0),
('Will', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', 'moi@moi.fr', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id_usertype` int(11) NOT NULL AUTO_INCREMENT,
  `lib_usertype` varchar(45) DEFAULT NULL,
  `description` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur'),
(3, 'superadmin', 'Super Administrateur'),
(4, 'unconnect', 'User is not connected');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `menu_access`
--
ALTER TABLE `menu_access`
  ADD CONSTRAINT `FK_access_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_access_usertype` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;

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
