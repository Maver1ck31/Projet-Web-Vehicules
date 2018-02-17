-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8089
-- Généré le :  sam. 17 fév. 2018 à 15:06
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `photoLibrary`
--
CREATE DATABASE IF NOT EXISTS `photoLibrary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `photoLibrary`;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `id_message` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_img`),
  KEY `id_message` (`id_message`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_img`, `name`, `link`, `id_message`) VALUES
(1, 'rs.png', 'images/icones/rs.png', NULL),
(2, 'st.png', 'images/icones/st.png', NULL),
(3, 'mustang.png', 'images/icones/mustang.png', NULL),
(4, 'ford_performance.png', 'images/icones/ford_performance.png', NULL),
(5, 'gt.png', 'images/icones/gt.png', NULL),
(6, 'Ford GT 2017', 'images/2017-Ford-GT.jpg', NULL),
(7, 'Ford GT Grey 2017', 'images/2017-Ford-GT-Grey.jpg', NULL),
(8, 'Fiesta ST MK7', 'images/2017-ford-fiesta-st.jpg', NULL),
(9, 'Focus RS MK3', 'images/2016-ford-focus-rs.jpg', NULL),
(10, 'Mustang 2015', 'images/2015-Ford-Mustang.jpg', NULL);

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
-- Déchargement des données de la table `language`
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
-- Déchargement des données de la table `menu_access`
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
-- Déchargement des données de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `label`, `link`, `language_id`) VALUES
(1, 'Home', 'index.php', 2),
(2, 'Login', 'login.php', 2),
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
  `id_topic` int(11) NOT NULL,
  PRIMARY KEY (`id_msg`),
  KEY `id_emetteur` (`id_emetteur`),
  KEY `id_topic` (`id_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(50) NOT NULL,
  `topic_icon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_icon` (`topic_icon`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id_topic`, `topic_name`, `topic_icon`) VALUES
(1, 'Focus RS MK1 - MK2 - MK3', 9),
(2, 'Focus ST MK1 - MK2 - MK3', 10),
(3, 'Fiesta ST MK6 (ST150) - MK7 (ST182) - MK7 (ST200)', 10),
(4, 'Mustang GT and older', 11),
(5, 'Ford GT (GT40 and new generation)', 13),
(6, 'All Ford Performance cars', 12);

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
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`username`, `passwd`, `mail`, `id_usertype`, `isReported`) VALUES
('admin', '2d83c8d7e43e1f91e79d9675d4cff0c26a82ba4b', 'admin@photoLib.com', 2, 0),
('superadmin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'superadmin@photolib.com', 3, 0);

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
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `description`) VALUES
(1, 'utilisateur', 'Utilisateur de base'),
(2, 'admin', 'Administrateur'),
(3, 'superadmin', 'Super Administrateur'),
(4, 'unconnected', 'User is not connected');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_image_id_message` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_msg`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_message_id_topic` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_message_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_reponse_id_msg` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_msg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reponse_id_user` FOREIGN KEY (`id_emetteur`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `FK_topic_id_icone` FOREIGN KEY (`topic_icon`) REFERENCES `image` (`id_img`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_id_usertype` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;
