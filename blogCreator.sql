-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 15 Décembre 2016 à 14:29
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `id_blog`, `id_category`, `id_author`, `title`, `chapo`, `content`, `updated_at`, `created_at`) VALUES
(2, 1, 2, 2, 'Second article', 'Not another cool article :(', 'Hola hola', '2016-12-12 17:45:22', '2016-12-12 15:29:37'),
(3, 12, 1, 2, 'Much title!', 'such chapo!', 'WOW WOW!', '2016-12-13 10:57:24', '2016-12-12 16:32:32'),
(10, 12, 3, 2, 'Cate', 'Not your usual cat', 'image transfer test', '2016-12-14 10:24:38', '2016-12-14 10:24:38'),
(11, 13, 3, 3, 'Article', 'Hat', ':|', '2016-12-14 11:23:06', '2016-12-14 11:23:06'),
(12, 14, 1, 4, 'oli''s first article', 'okay!', ':s', '2016-12-15 14:14:22', '2015-12-14 11:48:24'),
(13, 13, 3, 3, 'Article', 'Hat', ':| other article', '2016-12-14 15:23:06', '2016-12-14 15:23:06'),
(23, 1, 1, 2, 'test', 'mime type', 'qsd', '2016-12-14 16:05:16', '2016-12-14 16:05:16'),
(24, 1, 1, 2, 'file', 'download file', 'try it out', '2016-12-14 16:19:21', '2016-12-14 16:19:21'),
(32, 1, 1, 2, 'notif', 'dsq', 'notfi folllower', '2016-12-15 14:13:05', '2016-12-15 14:13:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `blogs`
--

INSERT INTO `blogs` (`id`, `id_author`, `description`, `title`, `banner`, `updated_at`, `created_at`) VALUES
(1, 2, 'Not another blog', 'My blog', 'Lockscreen_by_EstebanMitnick.jpg', '2016-12-14 15:55:34', '2016-12-09 14:47:41'),
(12, 2, 'Another blog', '2nd blog', 'little_ball_of_fur_by_rebecca_wientzek.jpg', '2016-12-09 15:15:27', '2016-12-09 15:15:27'),
(13, 3, 'hmm', 'Timezone test', 'Whispy_Tails.jpg', '2016-12-09 16:17:20', '2016-12-09 16:17:20'),
(14, 4, 'meh', 'oli''s blog', 'helios_by_sigi_sagi.jpg', '2016-12-14 11:47:55', '2016-12-14 11:47:55');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Jeux videos', '2016-12-13 17:50:51', '0000-00-00 00:00:00'),
(2, 'Sport', '2016-12-12 00:00:00', '2016-12-12 00:00:00'),
(3, 'Nature', '2016-12-13 17:42:57', '2016-12-13 17:42:57'),
(5, 'Science', '2016-12-13 17:47:19', '2016-12-13 17:47:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `id_article`, `id_user`, `content`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 'hello', '2016-12-12 16:16:55', '2016-12-12 16:16:55'),
(2, 1, 2, 'Such article much title wow', '2016-12-12 16:18:47', '2016-12-12 16:18:47'),
(6, 3, 2, 'wow', '2016-12-12 17:01:52', '2016-12-12 17:01:52'),
(8, 2, 2, 'test', '2016-12-13 10:22:11', '2016-12-13 10:22:11'),
(9, 2, 2, 'alert test', '2016-12-13 10:22:56', '2016-12-13 10:22:56'),
(11, 2, 2, 'hm', '2016-12-13 10:24:59', '2016-12-13 10:24:59'),
(12, 2, 2, 'nice article', '2016-12-13 10:26:03', '2016-12-13 10:26:03'),
(13, 5, 2, '3 test', '2016-12-13 16:16:57', '2016-12-13 16:16:57'),
(14, 3, 2, 'shared article comment test', '2016-12-13 16:17:08', '2016-12-13 16:17:08'),
(15, 10, 2, 'Much images !', '2016-12-14 11:01:00', '2016-12-14 11:01:00'),
(16, 3, 2, 'comment from wall', '2016-12-14 11:16:08', '2016-12-14 11:16:08'),
(17, 5, 2, 'comment from article page', '2016-12-15 10:52:44', '2016-12-15 10:52:44'),
(18, 24, 4, 'comment notif test', '2016-12-15 12:11:33', '2016-12-15 12:11:33'),
(19, 12, 2, 'shitty article', '2016-12-15 12:13:09', '2016-12-15 12:13:09'),
(20, 24, 2, 'comment on own article', '2016-12-15 12:36:18', '2016-12-15 12:36:18'),
(21, 24, 2, 'test notif on own article', '2016-12-15 13:49:20', '2016-12-15 13:49:20'),
(22, 12, 2, 'notif comment on other people''s article', '2016-12-15 13:50:04', '2016-12-15 13:50:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `id_user1`, `id_user2`, `accepted`, `updated_at`, `created_at`) VALUES
(13, 2, 3, NULL, '2016-12-13 10:55:15', '2016-12-13 10:55:15'),
(19, 4, 3, NULL, '2016-12-15 11:38:55', '2016-12-15 11:38:55'),
(21, 4, 2, NULL, '2016-12-15 11:48:52', '2016-12-15 11:48:52');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `image` text NOT NULL,
  `mime` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `id_article`, `image`, `mime`, `updated_at`, `created_at`) VALUES
(2, 10, 'little_ball_of_fur_by_rebecca_wientzek.jpg', 'image/png', '2016-12-14 10:24:39', '2016-12-14 10:24:39'),
(3, 3, 'Sandstone.jpg', 'image/png', '2016-12-14 10:49:59', '2016-12-14 10:49:59'),
(5, 11, 'kronach_leuchtet_2014_by_brian_fox.jpg', 'image/png', '2016-12-14 11:23:06', '2016-12-14 11:23:06'),
(6, 12, 'FootFall.png', 'image/png', '2016-12-14 11:48:24', '2016-12-14 11:48:24'),
(7, 2, 'Terraform-green.jpg', 'image/png', '2016-12-14 16:00:19', '2016-12-14 16:00:19'),
(8, 23, 'FootFall.png', 'image/png', '2016-12-14 16:05:16', '2016-12-14 16:05:16'),
(9, 23, 'Flowerbed.jpg', 'image/png', '2016-12-14 16:05:16', '2016-12-14 16:05:16'),
(11, 24, 'Sandstone.jpg', 'image/jpeg', '2016-12-14 16:21:16', '2016-12-14 16:21:16'),
(12, 24, 'test-angularjs.pdf', 'application/pdf', '2016-12-14 16:22:42', '2016-12-14 16:22:42'),
(13, 32, 'light_trails_by_giridhar_mahadevan.jpg', 'image/jpeg', '2016-12-15 14:13:05', '2016-12-15 14:13:05'),
(14, 12, 'This video is private..png', 'image/png', '2016-12-15 14:14:27', '2016-12-15 14:14:27');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_sender`, `id_recipient`, `text`, `seen`, `sender_deleted`, `recipient_deleted`, `updated_at`, `created_at`) VALUES
(1, 2, 3, 'message', 1, NULL, NULL, '2016-12-14 11:35:28', '2016-12-09 17:37:02'),
(2, 3, 2, 'sqdsqqs', 1, NULL, 1, '2016-12-14 11:40:07', '2016-12-09 21:22:11'),
(4, 4, 2, 'sup?', 1, NULL, 1, '2016-12-14 11:40:13', '2016-12-11 13:14:13'),
(5, 2, 4, 'sup?', 1, NULL, NULL, '2016-12-15 11:42:20', '2016-12-11 13:14:31'),
(6, 3, 2, 's''up?', 1, NULL, NULL, '2016-12-14 11:27:25', '2016-12-14 11:23:24'),
(7, 3, 2, 'message unseen test', 1, NULL, 1, '2016-12-15 14:22:25', '2016-12-14 11:35:37'),
(8, 2, 4, 'check your notifs :D', 1, NULL, 1, '2016-12-15 11:42:24', '2016-12-15 11:41:52'),
(9, 2, 4, 'check your notifs :D', 1, NULL, NULL, '2016-12-15 11:42:19', '2016-12-15 11:42:05');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url` text NOT NULL,
  `content` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `url`, `content`, `icon`, `seen`, `created_at`, `updated_at`) VALUES
(4, 4, '/friend/list', 'Jérome Crété added you as friend', 'user', 1, '2016-12-15 11:34:55', '2016-12-15 11:38:44'),
(5, 3, '/friend/list', 'Olivier added you as friend', 'user', 1, '2016-12-15 11:38:55', '2016-12-15 11:39:39'),
(6, 4, '/friend/list', 'Jérome Crété added you as friend', 'user', 1, '2016-12-15 11:41:44', '2016-12-15 11:48:30'),
(7, 4, '/message/list', 'New message from Jérome Crété', 'envelope', 1, '2016-12-15 11:42:05', '2016-12-15 11:48:30'),
(8, 2, '/friend/list', 'Olivier added you as friend', 'user', 1, '2016-12-15 11:48:52', '2016-12-15 11:51:49'),
(9, 4, '/profile/2', 'Jérome Crété is now following your blog oli''s blog', 'share', 1, '2016-12-15 12:08:12', '2016-12-15 13:50:24'),
(10, 4, 'blog/14/read/12', 'Jérome Crété commented on your article oli''s first article', 'comment', 1, '2016-12-15 12:13:09', '2016-12-15 13:50:24'),
(12, 2, 'blog/14', 'Olivier shared your article file on their blog oli''s blog', 'retweet', 1, '2016-12-15 12:21:46', '2016-12-15 12:24:51'),
(13, 2, '14', 'Olivier shared your article file on their blog oli''s blog', 'retweet', 1, '2016-12-15 12:22:39', '2016-12-15 12:35:21'),
(14, 2, 'blog/1/read/24', 'Jérome Crété commented on your article file', 'comment', 1, '2016-12-15 12:36:18', '2016-12-15 12:36:27'),
(15, 4, 'blog/14/read/12', 'Jérome Crété commented on your article oli''s first article', 'comment', 1, '2016-12-15 13:50:04', '2016-12-15 13:50:24'),
(16, 4, 'blog/1/read/31', 'New article on blog My blog', 'file-text-o', 1, '2016-12-15 14:12:29', '2016-12-15 14:13:23'),
(17, 3, 'blog/1/read/31', 'New article on blog My blog', 'file-text-o', NULL, '2016-12-15 14:12:29', '2016-12-15 14:12:29'),
(18, 4, 'blog/1/read/32', 'New article on blog My blog', 'file-text-o', 1, '2016-12-15 14:13:05', '2016-12-15 14:13:23'),
(19, 3, 'blog/1/read/32', 'New article on blog My blog', 'file-text-o', NULL, '2016-12-15 14:13:05', '2016-12-15 14:13:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sharedArticles`
--

INSERT INTO `sharedArticles` (`id`, `id_article`, `id_blog`, `updated_at`, `created_at`) VALUES
(3, 3, 1, '2016-12-13 11:14:40', '2016-12-13 11:14:40'),
(4, 12, 1, '2016-12-14 13:26:50', '2016-12-14 13:26:50'),
(5, 12, 12, '2016-12-14 13:31:59', '2016-12-14 13:31:59'),
(6, 13, 12, '2016-12-14 15:56:39', '2016-12-14 15:56:39'),
(7, 24, 14, '2016-12-15 12:20:58', '2016-12-15 12:20:58'),
(8, 24, 14, '2016-12-15 12:21:46', '2016-12-15 12:21:46'),
(9, 24, 14, '2016-12-15 12:22:39', '2016-12-15 12:22:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sharedBlogs`
--

INSERT INTO `sharedBlogs` (`id`, `id_user`, `id_blog`, `created_at`, `updated_at`) VALUES
(22, 4, 1, '2016-12-14 11:55:55', '2016-12-14 11:55:55'),
(26, 2, 14, '2016-12-15 12:08:11', '2016-12-15 12:08:11');

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
(2, 'Jérome Crété', 'jerome@xo7.fr', '$2y$10$abQECalpBB1EINlwxlyx6uoxk4SnU8Ln.5FIzptx5O4bCSXPr3zjW', '5l21FzAlpm11CPSGri50nhrlVxkK05j2J37u41JkKGGNFa5F6Rv9JoINwMmd', '2016-12-15 14:18:02', '2016-12-09 13:07:19'),
(3, 'jer', 'jerome1.crete@epitech.eu', '$2y$10$y6bdCwIhYUoc0/C5pDMnzOpGZ3Ov7Zkr9I4cgOZ/RPgdp0jq8/rjy', 'eGqDFYaeEzaFIQLtvAKqLfh83VegSk6GhUQ1a5b0blVgebLCxdbDb873tm0g', '2016-12-15 14:20:45', '2016-12-09 13:43:25'),
(4, 'Olivier', 'olivier.crete@epitech.eu', '$2y$10$cKCDx3.v0OJ5BRViJceDS.aqYS.K0GA/qwfSZm.yfuJis39CxEdkW', 'hkstTwwSg1MFGu1HsCr00YWqB0wiYp9rXsl3xczzdPYDn1LlJcOxDY6gjz3P', '2016-12-15 14:15:40', '2016-12-11 00:23:04');

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
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `sharedArticles`
--
ALTER TABLE `sharedArticles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `sharedBlogs`
--
ALTER TABLE `sharedBlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;