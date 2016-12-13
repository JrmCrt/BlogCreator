-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 13 Décembre 2016 à 11:18
-- Version du serveur :  5.6.31-0ubuntu0.15.10.1
-- Version de PHP :  5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogCreator`
--
CREATE DATABASE IF NOT EXISTS `blogCreator` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blogCreator`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `id_blog`, `id_category`, `id_author`, `title`, `chapo`, `content`, `updated_at`, `created_at`) VALUES
(2, 1, 2, 2, 'Second article', 'Not another cool article :(', 'Hola hola', '2016-12-12 17:45:22', '2016-12-12 15:29:37'),
(3, 12, 1, 2, 'Much title!', 'such chapo!', 'WOW WOW!', '2016-12-13 10:57:24', '2016-12-12 16:32:32');

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `blogs`
--

INSERT INTO `blogs` (`id`, `id_author`, `description`, `title`, `banner`, `updated_at`, `created_at`) VALUES
(1, 2, 'Not another blog', 'My blog', 'little_ball_of_fur_by_rebecca_wientzek.jpg', '2016-12-09 14:47:41', '2016-12-09 14:47:41'),
(12, 2, 'Another blog', '2nd blog', 'little_ball_of_fur_by_rebecca_wientzek.jpg', '2016-12-09 15:15:27', '2016-12-09 15:15:27'),
(13, 3, 'hmm', 'Timezone test', 'Whispy_Tails.jpg', '2016-12-09 16:17:20', '2016-12-09 16:17:20');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `creatd_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `updated_at`, `creatd_at`) VALUES
(1, 'Jeux videos', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sport', '2016-12-12 00:00:00', '2016-12-12 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `id_article`, `id_user`, `content`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 'hello', '2016-12-12 16:16:55', '2016-12-12 16:16:55'),
(2, 1, 2, 'Such article much title wow', '2016-12-12 16:18:47', '2016-12-12 16:18:47'),
(6, 3, 2, 'wow', '2016-12-12 17:01:52', '2016-12-12 17:01:52'),
(8, 2, 2, 'test', '2016-12-13 10:22:11', '2016-12-13 10:22:11'),
(9, 2, 2, 'alert test', '2016-12-13 10:22:56', '2016-12-13 10:22:56'),
(10, 2, 2, 'trying again', '2016-12-13 10:23:49', '2016-12-13 10:23:49'),
(11, 2, 2, 'hm', '2016-12-13 10:24:59', '2016-12-13 10:24:59'),
(12, 2, 2, 'nice article', '2016-12-13 10:26:03', '2016-12-13 10:26:03');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `id_user1`, `id_user2`, `accepted`, `updated_at`, `created_at`) VALUES
(11, 2, 4, NULL, '2016-12-13 10:26:29', '2016-12-13 10:26:29'),
(13, 2, 3, NULL, '2016-12-13 10:55:15', '2016-12-13 10:55:15');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `text` text NOT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `sender_deleted` tinyint(1) DEFAULT NULL,
  `recipient_deleted` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_sender`, `id_recipient`, `text`, `seen`, `sender_deleted`, `recipient_deleted`, `updated_at`, `created_at`) VALUES
(1, 2, 3, 'message', NULL, NULL, NULL, '2016-12-09 17:37:02', '2016-12-09 17:37:02'),
(2, 3, 2, 'sqdsqqs', NULL, NULL, NULL, '2016-12-11 13:15:50', '2016-12-09 21:22:11'),
(4, 4, 2, 'sup?', NULL, NULL, NULL, '2016-12-11 13:15:04', '2016-12-11 13:14:13'),
(5, 2, 4, 'sup?', NULL, NULL, NULL, '2016-12-11 13:14:31', '2016-12-11 13:14:31');

-- --------------------------------------------------------

--
-- Structure de la table `sharedArticles`
--

CREATE TABLE IF NOT EXISTS `sharedArticles` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sharedArticles`
--

INSERT INTO `sharedArticles` (`id`, `id_article`, `id_blog`, `updated_at`, `created_at`) VALUES
(3, 3, 1, '2016-12-13 11:14:40', '2016-12-13 11:14:40');

-- --------------------------------------------------------

--
-- Structure de la table `sharedBlogs`
--

CREATE TABLE IF NOT EXISTS `sharedBlogs` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_blog` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `updated_at`, `created_at`) VALUES
(2, 'Jérome Crété', 'jerome@xo7.fr', '$2y$10$abQECalpBB1EINlwxlyx6uoxk4SnU8Ln.5FIzptx5O4bCSXPr3zjW', 'jIhiLKDd8ZL9F1IR6b5Ww7FakItBb65V7cwVj78ckX2pq3OsMrHE9ghoqCIb', '2016-12-13 10:57:02', '2016-12-09 13:07:19'),
(3, 'jer', 'jerome1.crete@epitech.eu', '$2y$10$y6bdCwIhYUoc0/C5pDMnzOpGZ3Ov7Zkr9I4cgOZ/RPgdp0jq8/rjy', '5twtUzEo6rlTfsrlBviZEp3h39ZeB5DubecDORhAUGHZkpnMpKh8j1fmVB4M', '2016-12-09 13:44:21', '2016-12-09 13:43:25'),
(4, 'Olivier', 'olivier.crete@epitech.eu', '$2y$10$cKCDx3.v0OJ5BRViJceDS.aqYS.K0GA/qwfSZm.yfuJis39CxEdkW', 'NB37BJTpJ13Gq5FiJizTeiGNRvkbiPk4OJfSI3Ccrwa7SA4pXnZX1FxqMVvP', '2016-12-11 00:23:20', '2016-12-11 00:23:04');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sharedArticles`
--
ALTER TABLE `sharedArticles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sharedBlogs`
--
ALTER TABLE `sharedBlogs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `sharedArticles`
--
ALTER TABLE `sharedArticles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `sharedBlogs`
--
ALTER TABLE `sharedBlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
