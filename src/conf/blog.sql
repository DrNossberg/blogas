-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 mai 2021 à 16:25
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
                              `id` int(11) NOT NULL,
                              `title` varchar(64) NOT NULL,
                              `description` text DEFAULT NULL,
                              `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `image`) VALUES
(1, 'sport', 'tout sur le sport en general', NULL),
(2, 'cinema', 'tout sur le cinema', NULL),
(3, 'music', 'toute la music que j\'aaiiiimeuh, elle vient de la, elle vient du bluuuuuuzee', NULL),
(4, 'tele', 'tout sur les programmes tele, les emissions, les series, et vos stars preferes', NULL),
(8, 'test', 'catégorie de test', NULL),
(9, 'test', 'catégorie de test', NULL),
(10, 'test', 'categorie de test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `id_post` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `title`, `body`, `id_post`, `date_creation`, `date_modification`, `user_id`) VALUES
(1, 'Un commentaire', 'bla bla bla', 1, '2021-05-17', NULL, 7);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `cat_id` int(11) DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `cat_id`, `date_creation`, `date_modification`, `user_id`, `image`) VALUES
(1, 'Un super titre pour un super article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sollicitudin justo vitae velit eleifend, in fringilla ipsum consequat. Nulla condimentum laoreet luctus. Curabitur id metus in ligula faucibus varius. Aenean sollicitudin ex sed nulla ultrices hendrerit. Donec ut tristique lacus. Proin cursus mauris sed condimentum efficitur. Suspendisse potenti. Suspendisse tincidunt dignissim est. Nunc metus justo, sagittis et efficitur et, congue sit amet dui. Fusce sit amet magna hendrerit, aliquam felis non, faucibus quam. Nulla facilisi. Cras non mi a odio mollis vestibulum sed non nunc. Curabitur sit amet tempor tortor, sed fermentum ligula.\r\n\r\nCras quis dolor et tellus vulputate luctus. Etiam egestas dui ac dignissim consequat. In nulla purus, condimentum in nisl tincidunt, posuere lacinia tortor. Phasellus dapibus aliquam elit eget pulvinar. Suspendisse rhoncus a quam at ultricies. Donec pharetra, elit id pretium facilisis, est justo ornare leo, at dignissim leo tortor molestie ligula. Nulla quis lectus ipsum. Suspendisse feugiat vitae massa nec ultrices. Donec non laoreet justo. Aliquam velit sapien, ultrices non sem scelerisque, tincidunt rhoncus ligula.\r\n\r\nNullam porta ante aliquet, pulvinar massa at, elementum nisi. Quisque congue eros ut iaculis luctus. Etiam lacus tellus, aliquam id pulvinar vel, commodo nec ex. Pellentesque at iaculis nulla. Morbi ac consectetur quam, et bibendum massa. Quisque facilisis non ante a imperdiet. Sed at dolor ut nibh feugiat dapibus dapibus nec eros. Nam ipsum leo, fermentum et tempor sed, vestibulum eu tellus. Sed hendrerit posuere ex, quis porttitor velit tristique id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus ante erat, convallis at sapien ac, varius semper orci. Aliquam eleifend eget ex non tempus.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Proin augue elit, aliquet sed nunc id, auctor malesuada ante. Aenean id lorem sed tortor maximus tempus sit amet nec sapien. Ut efficitur congue felis a posuere. Maecenas non massa volutpat diam faucibus ultrices placerat id dolor. Suspendisse sit amet interdum metus. Nullam vitae diam vel libero pretium consectetur. Cras nibh arcu, pellentesque vitae pulvinar quis, ultricies a dui. Ut cursus eget lectus non consectetur. Donec suscipit, risus non malesuada vehicula, ex sapien rhoncus lorem, a lobortis diam eros interdum mi. Quisque id pretium tortor, at mattis purus. Ut iaculis purus sit amet tortor consectetur semper. Vestibulum et risus et est venenatis tristique. Etiam sit amet eleifend urna. Sed maximus urna sit amet erat porttitor, non gravida tellus consequat.\r\n\r\nAliquam venenatis vel dui at faucibus. Curabitur laoreet sit amet risus ut congue. Morbi id tincidunt erat. Curabitur interdum tellus eget quam aliquet, non efficitur ex lobortis. Donec laoreet accumsan tortor, quis varius orci tincidunt et. Duis vitae vestibulum dui, at dictum purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ', 2, '2021-05-10', NULL, 6, NULL),
(2, 'Un deuxième article <3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin ligula eu metus finibus, eu efficitur erat ornare. Maecenas facilisis, tortor sed lacinia tempor, felis magna viverra orci, sit amet congue purus ex in nibh. Vivamus vitae tellus at nibh convallis suscipit. Etiam consectetur arcu non massa congue, eget consectetur erat maximus. Cras nisl urna, feugiat eu magna a, venenatis fringilla lectus. Nulla varius pharetra venenatis. Phasellus pharetra sapien sed lacinia volutpat. Nulla sollicitudin justo quis lorem dictum laoreet. Integer molestie, mi eget blandit auctor, eros nibh sagittis neque, in pretium quam sem ut erat. Praesent vel ultrices massa, in scelerisque nibh. Morbi vulputate finibus ex non suscipit. In non ligula neque. Donec nibh lorem, vulputate at hendrerit at, lacinia quis urna. Pellentesque placerat, est at bibendum imperdiet, velit risus euismod sapien, tempus dictum odio magna non arcu. Donec viverra lorem sit amet ipsum finibus, et tincidunt lorem tempus.\r\n\r\nFusce non massa vitae arcu sagittis ultricies. Aliquam non euismod metus. Vivamus in pellentesque augue. Cras leo sapien, consectetur a consectetur at, pulvinar id leo. Aenean id malesuada mi. Nam vehicula, quam posuere dapibus rhoncus, diam felis volutpat urna, a sagittis mi magna eget ex. Maecenas posuere ullamcorper ornare. Sed a eros at enim finibus congue eu et odio. Vivamus molestie maximus arcu vel scelerisque. Suspendisse ac magna mi. Aenean sit amet lacus vulputate, porta quam ut, semper neque. Nunc semper tincidunt nunc, sollicitudin suscipit neque.\r\n\r\nPhasellus scelerisque turpis magna, quis egestas nibh pretium vitae. Curabitur blandit quam eu velit sodales porta. Vestibulum a congue est. Proin sem libero, consectetur id auctor eu, condimentum non enim. Mauris eu tortor mi. Fusce ut turpis tellus. Duis nec feugiat nulla, maximus sagittis nisi. Phasellus nulla sapien, eleifend eu velit rhoncus, tincidunt sodales diam. Duis congue, est at congue pretium, nibh arcu vehicula massa, ac pulvinar neque velit sit amet sapien. Proin lectus libero, aliquet a dictum non, euismod non mi. Phasellus ut dui ultrices, commodo purus sit amet, pharetra tellus. Praesent pellentesque lacus neque. Mauris nisl ante, efficitur in justo et, accumsan malesuada ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id felis mollis, ultricies justo nec, aliquet ipsum.\r\n\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut consequat erat neque, vitae faucibus augue semper nec. Fusce commodo tristique lacus tincidunt faucibus. Nulla pulvinar tortor vel metus laoreet faucibus. Cras elementum dignissim ullamcorper. Aliquam a augue faucibus, porttitor sapien eget, bibendum erat. Proin ac orci quam. Suspendisse placerat metus eget tortor venenatis congue. Nulla vitae nunc non neque imperdiet hendrerit at et lacus. Donec porttitor eros vitae velit sagittis bibendum eu vitae enim.\r\n\r\nVivamus tincidunt commodo elit quis commodo. Duis cursus nulla ut blandit pharetra. Vivamus euismod, turpis nec tincidunt scelerisque, tortor dui iaculis magna, a dapibus risus risus vitae dui. Phasellus suscipit ultricies magna, et accumsan justo faucibus non. Nam augue nunc, dignissim et hendrerit vel, rutrum non ex. Nunc facilisis odio sed lorem ornare consectetur. Nulla facilisi. Suspendisse molestie nisl ac mattis mollis. Fusce vitae sollicitudin urna. Aenean posuere faucibus vestibulum. ', 1, '2021-05-12', NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `grade` int(11) NOT NULL DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_deletion` datetime DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `token` varchar(60) DEFAULT NULL,
  `token_expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `nickname`, `email`, `password`, `grade`, `date_creation`, `date_deletion`, `image`, `signature`, `token`, `token_expiry_date`) VALUES
(6, 'Donatien', 'De Montazac', 'donaThe100', 'donation.montazac@montazactorrez.com', '$2y$10$EILDuFCUuSUuvTMXY33zbuxU2fRun1SekPX58kY2xN43DAfqr55Hy', 2, '2021-05-17', NULL, NULL, NULL, NULL, '2021-05-27'),
(7, 'Fabien', 'Torrez', 'foubMoutMout', 'fabien.torrez@montazactorrez.com', '$2y$10$yoUY/h10NfpLthiBm/zCFePeorXsusT03CaCop2WWeNoJlDicP4Bi', 1, '2021-05-17', NULL, NULL, NULL, NULL, NULL),
(8, 'Antoine', 'Croute', 'superBisou', 'antoine.croute@montazactorrez.com', '$2y$10$g5CxoZJC1KRtdiuF4H.Zi.IaCkeEvpu1bru/VKHUKJ97ubiYVF35a', 1, '2021-05-17', NULL, NULL, NULL, NULL, NULL),
(9, 'Daniel', 'Croute', 'crouteBrain', 'daniel.croute@montazactorrez.com', '$2y$10$ouWP9NCofZqWHONi7BP/..VmRxh07xek8D4EOIC5capzBfMTQajFW', 1, '2021-05-17', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
