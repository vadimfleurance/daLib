-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 27 Janvier 2016 à 20:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dalib`
--
CREATE DATABASE IF NOT EXISTS `dalib` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dalib`;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action'),
(14, 'Adult'),
(2, 'Adventure'),
(16, 'Animation'),
(25, 'Biography'),
(3, 'Comedy'),
(4, 'Crime'),
(10, 'Documentary'),
(15, 'Drama'),
(6, 'Family'),
(5, 'Fantasy'),
(27, 'Film-Noir'),
(24, 'Game-Show'),
(23, 'History'),
(21, 'Horror'),
(11, 'Music'),
(12, 'Musical'),
(19, 'Mystery'),
(26, 'News'),
(9, 'Reality-TV'),
(20, 'Romance'),
(17, 'Sci-Fi'),
(28, 'Short'),
(7, 'Sport'),
(13, 'Talk-Show'),
(18, 'Thriller'),
(8, 'War'),
(22, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `humans`
--

CREATE TABLE `humans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdbRef` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` smallint(5) UNSIGNED NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `imdbRef` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdbRating` float UNSIGNED NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movies__genres`
--

CREATE TABLE `movies__genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMovie` int(10) UNSIGNED NOT NULL,
  `idGenre` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movies__humans`
--

CREATE TABLE `movies__humans` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMovie` int(10) UNSIGNED NOT NULL,
  `idHuman` int(10) UNSIGNED NOT NULL,
  `role` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movies__users`
--

CREATE TABLE `movies__users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMovie` int(10) UNSIGNED NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `watched` tinyint(1) DEFAULT NULL,
  `toWatch` tinyint(1) DEFAULT NULL,
  `owned` tinyint(1) DEFAULT NULL,
  `ofInterest` tinyint(1) DEFAULT NULL,
  `wanted` tinyint(1) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordToken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sessionToken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `humans`
--
ALTER TABLE `humans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_imdb` (`imdbRef`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref_imdb` (`imdbRef`);

--
-- Index pour la table `movies__genres`
--
ALTER TABLE `movies__genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movie` (`idMovie`),
  ADD KEY `id_genre` (`idGenre`);

--
-- Index pour la table `movies__humans`
--
ALTER TABLE `movies__humans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`idMovie`),
  ADD KEY `id_humans` (`idHuman`);

--
-- Index pour la table `movies__users`
--
ALTER TABLE `movies__users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movie` (`idMovie`),
  ADD KEY `id_user` (`idUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `humans`
--
ALTER TABLE `humans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `movies__genres`
--
ALTER TABLE `movies__genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `movies__humans`
--
ALTER TABLE `movies__humans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `movies__users`
--
ALTER TABLE `movies__users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `movies__genres`
--
ALTER TABLE `movies__genres`
  ADD CONSTRAINT `movies__genres_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movies__genres_ibfk_2` FOREIGN KEY (`idGenre`) REFERENCES `genres` (`id`);

--
-- Contraintes pour la table `movies__humans`
--
ALTER TABLE `movies__humans`
  ADD CONSTRAINT `movies__humans_ibfk_1` FOREIGN KEY (`idHuman`) REFERENCES `humans` (`id`),
  ADD CONSTRAINT `movies__humans_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`);

--
-- Contraintes pour la table `movies__users`
--
ALTER TABLE `movies__users`
  ADD CONSTRAINT `movies__users_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movies__users_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
