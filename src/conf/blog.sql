-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 09:52 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nom`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
                              `id` int(11) NOT NULL,
                              `title` varchar(64) NOT NULL,
                              `description` text DEFAULT NULL,
                              `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `image`) VALUES
(1, 'sport', 'tout sur le sport en general', NULL),
(2, 'cinema', 'tout sur le cinema', NULL),
(3, 'musique', 'toute la music que j\'aaiiiimeuh, elle vient de la, elle vient du bluuuuuuzee', NULL),
(4, 'tele', 'tout sur les programmes tele, les emissions, les series, et vos stars preferes', NULL),
(5, 'tranche de vie', 'tout sur....hé bééé une partie de la vie de quelqu\'un', NULL),
(8, 'métier du numérique', 'tout sur les différents métiers en lien avec l\'informatique', NULL),
(9, 'lecture', 'tout sur les BD, les romans et lectures de tout types', NULL),
(10, 'architecture', 'tout sur la conception et la création de bâtiments', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `id_post` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modification` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `body`, `id_post`, `date_creation`, `date_modification`, `user_id`) VALUES
(1, 'Un commentaire', 'bla bla bla', 1, '2021-05-17 00:00:00', NULL, 7),
(2, 'COmmentaire acle compte de dona', 'COmment taire ?', 1, '2021-05-21 15:16:56', NULL, 6),
(3, 'test', 'efz\r\n', 1, '2021-05-21 15:19:23', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `cat_id` int(11) DEFAULT 1,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modification` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `cat_id`, `date_creation`, `date_modification`, `user_id`, `image`) VALUES
(1, 'Le métier de développeur', 'Le métier de développeur consiste à créer, écrire, tester, documenter des sites Internet, des applications ou des logiciels. Le développeur travaille en équipe, le plus souvent avec des clients, des chefs de projet et d\'autres développeurs. Les développeurs conçoivent logiciels, interfaces graphiques ou des sites Internet.', 2, '2020-02-13 04:36:35', NULL, 6, NULL),
(2, 'Un deuxième article <3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sollicitudin ligula eu metus finibus, eu efficitur erat ornare. Maecenas facilisis, tortor sed lacinia tempor, felis magna viverra orci, sit amet congue purus ex in nibh. Vivamus vitae tellus at nibh convallis suscipit. Etiam consectetur arcu non massa congue, eget consectetur erat maximus. Cras nisl urna, feugiat eu magna a, venenatis fringilla lectus. Nulla varius pharetra venenatis. Phasellus pharetra sapien sed lacinia volutpat. Nulla sollicitudin justo quis lorem dictum laoreet. Integer molestie, mi eget blandit auctor, eros nibh sagittis neque, in pretium quam sem ut erat. Praesent vel ultrices massa, in scelerisque nibh. Morbi vulputate finibus ex non suscipit. In non ligula neque. Donec nibh lorem, vulputate at hendrerit at, lacinia quis urna. Pellentesque placerat, est at bibendum imperdiet, velit risus euismod sapien, tempus dictum odio magna non arcu. Donec viverra lorem sit amet ipsum finibus, et tincidunt lorem tempus.\r\n\r\nFusce non massa vitae arcu sagittis ultricies. Aliquam non euismod metus. Vivamus in pellentesque augue. Cras leo sapien, consectetur a consectetur at, pulvinar id leo. Aenean id malesuada mi. Nam vehicula, quam posuere dapibus rhoncus, diam felis volutpat urna, a sagittis mi magna eget ex. Maecenas posuere ullamcorper ornare. Sed a eros at enim finibus congue eu et odio. Vivamus molestie maximus arcu vel scelerisque. Suspendisse ac magna mi. Aenean sit amet lacus vulputate, porta quam ut, semper neque. Nunc semper tincidunt nunc, sollicitudin suscipit neque.\r\n\r\nPhasellus scelerisque turpis magna, quis egestas nibh pretium vitae. Curabitur blandit quam eu velit sodales porta. Vestibulum a congue est. Proin sem libero, consectetur id auctor eu, condimentum non enim. Mauris eu tortor mi. Fusce ut turpis tellus. Duis nec feugiat nulla, maximus sagittis nisi. Phasellus nulla sapien, eleifend eu velit rhoncus, tincidunt sodales diam. Duis congue, est at congue pretium, nibh arcu vehicula massa, ac pulvinar neque velit sit amet sapien. Proin lectus libero, aliquet a dictum non, euismod non mi. Phasellus ut dui ultrices, commodo purus sit amet, pharetra tellus. Praesent pellentesque lacus neque. Mauris nisl ante, efficitur in justo et, accumsan malesuada ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id felis mollis, ultricies justo nec, aliquet ipsum.\r\n\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut consequat erat neque, vitae faucibus augue semper nec. Fusce commodo tristique lacus tincidunt faucibus. Nulla pulvinar tortor vel metus laoreet faucibus. Cras elementum dignissim ullamcorper. Aliquam a augue faucibus, porttitor sapien eget, bibendum erat. Proin ac orci quam. Suspendisse placerat metus eget tortor venenatis congue. Nulla vitae nunc non neque imperdiet hendrerit at et lacus. Donec porttitor eros vitae velit sagittis bibendum eu vitae enim.\r\n\r\nVivamus tincidunt commodo elit quis commodo. Duis cursus nulla ut blandit pharetra. Vivamus euismod, turpis nec tincidunt scelerisque, tortor dui iaculis magna, a dapibus risus risus vitae dui. Phasellus suscipit ultricies magna, et accumsan justo faucibus non. Nam augue nunc, dignissim et hendrerit vel, rutrum non ex. Nunc facilisis odio sed lorem ornare consectetur. Nulla facilisi. Suspendisse molestie nisl ac mattis mollis. Fusce vitae sollicitudin urna. Aenean posuere faucibus vestibulum. ', 1, '2021-03-31 05:25:24', NULL, 7, NULL),
(12, 'Mon retour de vacances', 'Marius Rotarez, patron des convoyeurs de fonds Gruppe 6, de retour de vacances ! Je reprenant l\'entreprise en main, avec l\'aide de mon fidèle manager Angelo Brimaldi, et je vin juste de m\'enquiller une bouteille au moment ou j\'écris ces lignes', 1, '2021-02-11 20:40:00', NULL, 7, NULL),
(35, 'Le métier de développeur en école Informatique', 'Bonjour,\r\nCeci est un indice lié au fichier def.h de mon rendu.\r\n\r\n\r\n\r\nNon, il n\'est pas là par hazard. Oui, c\'est un hommage. Non je n\'ai jamais codé en algol, mais j\'aime bien la légère obfuscation que ce type d\'écriture peut produire.', 1, '1999-01-01 00:00:00', NULL, 7, NULL),
(36, 'Perry Rhodan', 'Bonjour,\r\n\r\nVoilà, je voudrais vous parler d\'une de mes dernières lectures, le premier tome d\'une série méconnue.\r\nCette série raconte l\'épopée d\'un astronaute de l\'U.S. Air Force qui part en reconnaissance sur la Lune. Il y trouve alors un vaisseau extraterrestre. Les êtres de ce vaisseau sont des Arkonides qui ont besoin d\'une aide médicale. Rhodan emmène Krest, l\'Arkonide malade, sur Terre. En contrepartie, les Arkonides donnent à Rhodan, ainsi qu\'à son ami Reginald Bull, la connaissance et la technologie acquise par ce peuple.\r\n\r\nRhodan, à son retour sur Terre, refuse d\'avantager un des blocs en présence (Chine, URSS et États-Unis – lors des premières parutions de Rhodan en 1961, on est en pleine Guerre froide) en lui remettant les technologies nouvelles révélées par les Arkonides. ', 1, '1961-11-09 00:00:00', NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `name` varchar(25) NOT NULL,
                         `surname` varchar(60) NOT NULL,
                         `nickname` varchar(25) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(60) NOT NULL,
                         `grade` int(11) NOT NULL DEFAULT 1,
                         `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
                         `date_deletion` datetime DEFAULT NULL,
                         `image` blob DEFAULT NULL,
                         `signature` text DEFAULT NULL,
                         `token` varchar(60) DEFAULT NULL,
                         `token_expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `nickname`, `email`, `password`, `grade`, `date_creation`, `date_deletion`, `image`, `signature`, `token`, `token_expiry_date`) VALUES
(6, 'Donatien', 'De Montazac', 'donaThe100', 'donation.montazac@montazactorrez.com', '$2y$10$EILDuFCUuSUuvTMXY33zbuxU2fRun1SekPX58kY2xN43DAfqr55Hy', 2, '2021-05-17 00:00:00', NULL, NULL, NULL, NULL, '2021-05-28'),
(7, 'Fabien', 'Torrez', 'foubMoutMout', 'fabien.torrez@montazactorrez.com', '$2y$10$yoUY/h10NfpLthiBm/zCFePeorXsusT03CaCop2WWeNoJlDicP4Bi', 1, '2021-05-17 00:00:00', NULL, NULL, NULL, NULL, '2021-05-28'),
(8, 'Antoine', 'Croute', 'superBisou', 'antoine.croute@montazactorrez.com', '$2y$10$g5CxoZJC1KRtdiuF4H.Zi.IaCkeEvpu1bru/VKHUKJ97ubiYVF35a', 1, '2021-05-17 00:00:00', NULL, NULL, NULL, NULL, NULL),
(9, 'Daniel', 'Croute', 'crouteBrain', 'daniel.croute@montazactorrez.com', '$2y$10$ouWP9NCofZqWHONi7BP/..VmRxh07xek8D4EOIC5capzBfMTQajFW', 1, '2021-05-17 00:00:00', NULL, NULL, NULL, NULL, NULL),
(11, 'Karl-Herbert', 'Scheer', 'SheerCold', 'KarlHerbert@yahoo.dr', '$2y$10$p3Ab3pVlRdOCviUaQE05BuoR2Ln7GFREGbFzpW2uN3BpSt9BOgAIm', 1, '2021-05-21 20:50:55', NULL, NULL, NULL, NULL, NULL),
(12, 'Marius', 'Rotarez', 'Zerator', 'MariusRotarez@GroupSix.com', '$2y$10$p3Ab3pVlRdOCviUaQE05BuoR2Ln7GFREGbFzpW2uN3BpSt9BOgAIm', 1, '2021-05-21 20:50:55', NULL, NULL, 'PDG de Groupe6, convoyeur de fond', NULL, NULL),
(13, 'Stephen', 'Bournes', 'SRB', 'StephenBournes@Dell.com', '$2y$10$p3Ab3pVlRdOCviUaQE05BuoR2Ln7GFREGbFzpW2uN3BpSt9BOgAIm', 1, '2021-05-21 20:50:55', NULL, NULL, 'Developer & Computer scientist for DELL USA', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
