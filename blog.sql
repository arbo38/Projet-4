-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Mai 2017 à 14:21
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jean_forteroche_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'default');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(6) UNSIGNED NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `post_id` int(6) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `depth` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `report` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `pseudo`, `comment`, `post_id`, `parent_id`, `depth`, `report`) VALUES
(11, 'Antony', 'Un commentaire', 3, 0, 0, '0'),
(12, 'José', 'Une réponse à un commentaire', 3, 11, 1, '0'),
(13, 'José', 'Une réponse à un commentaire', 3, 11, 1, '0');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date`, `category_id`) VALUES
(3, 'Un article', '<p style="box-sizing: inherit; margin: 0em 0px 0.5em; line-height: 1.5; font-size: 1.25em; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif;">What\'s Spanish for "I know you speak English?" No! I was ashamed to be SEEN with you. I like being with you. He\'ll want to use your yacht, and I don\'t want this thing smelling like fish. Did you enjoy your meal, Mom? You drank it fast enough.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Whoa, this guy\'s straight? It\'s called \'taking advantage.\' It\'s what gets you ahead in life. I\'m a monster. Well, what do you expect, mother? Michael! I\'ve opened a door here that I regret.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Get me a vodka rocks. And a piece of toast. Not tricks, Michael, illusions. There\'s only one man I\'ve ever called a coward, and that\'s Brian Doyle Murray. No, what I\'m calling you is a television actor.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I hear the jury\'s still out on science. Really? Did nothing cancel? Not tricks, Michael, illusions. Michael!</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Guy\'s a pro. Guy\'s a pro. He\'ll want to use your yacht, and I don\'t want this thing smelling like fish. Army had half a day.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I\'m a monster. I care deeply for nature. Guy\'s a pro. I don\'t criticize you! And if you\'re worried about criticism, sometimes a diet is the best defense. I care deeply for nature.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Now, when you do this without getting punched in the chest, you\'ll have more fun. First place chick is hot, but has an attitude, doesn\'t date magicians. I\'m afraid I just blue myself. Whoa, this guy\'s straight?</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I\'m a monster. No, I did not kill Kitty. However, I am going to oblige and answer the nice officer\'s questions because I am an honest man with no secrets to hide. Well, what do you expect, mother? Whoa, this guy\'s straight?</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">No&hellip; but I\'d like to be asked! First place chick is hot, but has an attitude, doesn\'t date magicians. Marry me. First place chick is hot, but has an attitude, doesn\'t date magicians. We just call it a sausage.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I hear the jury\'s still out on science. No, I did not kill Kitty. However, I am going to oblige and answer the nice officer\'s questions because I am an honest man with no secrets to hide. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I hear the jury\'s still out on science. I hear the jury\'s still out on science. That\'s what it said on \'Ask Jeeves.\' First place chick is hot, but has an attitude, doesn\'t date magicians. There\'s so many poorly chosen words in that sentence.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Michael! He\'ll want to use your yacht, and I don\'t want this thing smelling like fish. Army had half a day. Not tricks, Michael, illusions. Army had half a day.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">No! I was ashamed to be SEEN with you. I like being with you. Guy\'s a pro. I\'m a monster. I don\'t understand the question, and I won\'t respond to it. I\'m a monster.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">Really? Did nothing cancel? Now, when you do this without getting punched in the chest, you\'ll have more fun. Guy\'s a pro. Across from where? But I bought a yearbook ad from you, doesn\'t that mean anything anymore?</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">It\'s a hug, Michael. I\'m hugging you. Marry me. Say goodbye to these, because it\'s the last time! Not tricks, Michael, illusions. Not tricks, Michael, illusions.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">No! I was ashamed to be SEEN with you. I like being with you. Not tricks, Michael, illusions. What\'s Spanish for "I know you speak English?" Oh, you\'re gonna be in a coma, all right. We just call it a sausage.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">What\'s Spanish for "I know you speak English?" Did you enjoy your meal, Mom? You drank it fast enough. Guy\'s a pro. I\'ve opened a door here that I regret.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">No, I did not kill Kitty. However, I am going to oblige and answer the nice officer\'s questions because I am an honest man with no secrets to hide. Now, when you do this without getting punched in the chest, you\'ll have more fun.</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0.5em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">We just call it a sausage. Guy\'s a pro. I\'m afraid I just blue myself. Say goodbye to these, because it\'s the last time!</p>\r\n<p style="box-sizing: inherit; margin: 0px 0px 0em; line-height: 1.5; color: rgba(0, 0, 0, 0.8); font-family: Roboto, \'Helvetica Neue\', sans-serif; font-size: 16px;">I\'m half machine. I\'m a monster. Steve Holt! Steve Holt! That\'s what it said on \'Ask Jeeves.\' Bad news. Andy Griffith turned us down. He didn\'t like his trailer.</p>', '2017-05-08 14:14:45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `subscription_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`, `subscription_date`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 'admin', '2017-05-07 13:54:51'),
(2, 'antony', '1799296195846afeef14df836a5db11994803780', 'antony@antony.com', 'user', '2017-05-08 15:29:34');

--
-- Index pour les tables exportées
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
