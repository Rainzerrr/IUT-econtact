-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 mai 2023 à 21:57
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `econtact`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `contact` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transmitter` int NOT NULL,
  `receiver` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8mb3_bin NOT NULL,
  `lastname` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `firstname` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `age` int NOT NULL,
  `city` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `lastname`, `firstname`, `password`, `email`, `age`, `city`, `roles`) VALUES
(26, 'Rainzer', 'Ainouche', 'Rayan', '$2y$13$dp.rccykfmvXN2JsHLyj4uSrxyMeipJEq9Xm.//0DJGbQy1al1NJ2', 'rayan.ainouche2003@gmail.com', 19, 'Paris', '[\"ROLE_USER\"]'),
(27, 'Danielss', 'Dans', 'Daniel', '$2y$13$82kf/zvQYtJBcOl9ZBOzK.TViZ7ZjJrv7.kkCcSSD6Meqnv1sTRxC', 'daniel@gmail.com', 20, 'Marseille', '[\"ROLE_USER\"]'),
(28, 'marie76', 'Elmosa', 'Marie', '$2y$13$x8z7zut/.mauoglUDAqksezlTTvpeI9MdxGI3tUdyp5MU34lpV0p2', 'marie@gmail.com', 16, 'Toulouse', '[\"ROLE_USER\"]'),
(29, 'Nicox', 'Morisou', 'Nicolas', '$2y$13$lwlIsfJbSyflL5FTYk95fuSDISceY51PYRRLyOFGZ/eD16EdtyKPO', 'nicolas@gmail.com', 22, 'Paris', '[\"ROLE_USER\"]'),
(30, 'Germanixos', 'Cajou', 'Germain', '$2y$13$J9/2rMcA3kttlQiM.eo6rOvY4oFVYFAIaiw3cdlAZXTW1wbgbcCV2', 'germain@gmail.com', 30, 'Saint-germain', '[\"ROLE_USER\"]'),
(32, 'Admin', 'Admin', 'Admin', '$2y$13$O7A/SLFE4d0stoYcXXhPRefV91LK1RPWU65IYeKqe/iz.fC4gYph6', 'admin@gmail.com', 0, 'Paris', '[\"ROLE_USER\", \"ROLE_ADMIN\"]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
