-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 11 mai 2021 à 13:14
-- Version du serveur :  8.0.23-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `cat_id` int DEFAULT '1',
  `date_creation` date NOT NULL,
  `date_modification` date DEFAULT NULL,
  `user_id` int NOT NULL,
  `image` BLOB DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `titre`, `body`, `cat_id`, `date`) VALUES
(1, 'go sluc, go', 'tout est dans le titre', 1, '2014-11-20'),
(2, 'Concert : nolwenn live', 'c\'est d\'la balle, Ca vaut bien Mick Jagger et Iggy Stooges réunis.\r\nAngus Young doit l\'ecouter en boucle...', 3, '2014-11-20'),
(3, 'Titanic', 'c\'est l\'histoire d\'un gros bateau qui croise un glaçon', 2, '2014-11-20');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `posts` (
    `id` int NOT NULL AUTO_INCREMENT,
    `title` varchar(64) NOT NULL,
    `body` text NOT NULL,
    `cat_id` int DEFAULT '1',
    `date_creation` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_modification` date DEFAULT NULL,
    `user_id` int NOT NULL,
    `image` BLOB DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
    `id` int NOT NULL AUTO_INCREMENT,
    `title` varchar(64) NOT NULL,
    `description` text,
    `image` BLOB DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `comments` (
    `id` int NOT NULL AUTO_INCREMENT,
    `title` varchar(64) NOT NULL,
    `body` text NOT NULL,
    `id_post` int NOT NULL,
    `date_creation` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_modification` date DEFAULT NULL,
    `user_id` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(25) NOT NULL,
    `surname` varchar(60) NOT NULL,
    `nickname` varchar(25) NOT NULL UNIQUE,
    `email` varchar(255) NOT NULL UNIQUE,
    `password` varchar(60) NOT NULL,
    `grade` int NOT NULL DEFAULT '1',
    `date_creation` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `date_deletion` date DEFAULT NULL,
    `image` BLOB DEFAULT NULL,
    `signature` text DEFAULT NULL,
    `token` varchar(60) DEFAULT NULL ,
    `token_expiry_date` date DEFAULT NULL
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `titre`, `description`) VALUES
(1, 'sport', 'tout sur le sport en general'),
(2, 'cinema', 'tout sur le cinema'),
(3, 'music', 'toute la music que j\'aaiiiimeuh, elle vient de la, elle vient du bluuuuuuzee'),
(4, 'tele', 'tout sur les programmes tele, les emissions, les series, et vos stars preferes'),
(8, 'test', 'catégorie de test'),
(9, 'test', 'catégorie de test'),
(10, 'test', 'categorie de test');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
